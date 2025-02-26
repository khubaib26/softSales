<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lead;
use App\Models\Brand;
use App\Models\BrandUser;
use App\Models\LeadStatus;
use App\Models\UserCredit;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use Auth;



class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:User access|User create|User edit|User delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:User create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:User edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:User delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', '!=', '1')->latest()->get();
        $brands = Brand::where('publish', '1')->get();

        return view('setting.user.index',['users'=>$user, 'brands'=>$brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('setting.user.new',['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'name'=>'required',
            'pseudonym'=>'required',
            'email' => 'required|email|unique:users',
            'password'=>'required|confirmed'
        ]);

        $user = User::create([
            'name'=>$request->name,
            'pseudonym'=>$request->pseudonym,
            'designation'=>$request->designation,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'password'=> bcrypt($request->password),
            'hod'=>$request->hod,
            'active'=>'1'
        ]);

        $user->syncRoles($request->roles);
        
        return redirect()->back()->withSuccess('User created !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
       
        $user = User::with(['leads'])->find($id);
       
        $leadStatus =  LeadStatus::all();
        $statusData = array();
        foreach($leadStatus as $status){
            $leads = Lead::where(['status_id' => $status->id, 'user_id'=>$id])
                    ->whereYear('created_at', Carbon::now()->year) // Count month Lead
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->count();
            $lastMonthLeads = Lead::where(['status_id' => $status->id, 'user_id'=>$id])
                    ->whereYear('created_at', Carbon::now()->year) // Count month Lead
                    ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                    ->count(); 
            $growth = growth_calculation($leads,$lastMonthLeads);               
                    
            $status['leadCount'] = $leads;
            $status['growth'] = $growth;  

            array_push($statusData, $status); // current month
        }

        //Get User Assing Brands
        $brands = $user->brands;
        return view('setting.user.profile',['user'=>$user, 'statusData' => $statusData, 'brands' =>$brands]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
       $role = Role::get();
       $user->roles;
       return view('setting.user.edit',['user'=>$user,'roles' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'=>'required',
            'email' => 'required|email|unique:users,email,'.$user->id.',id',
        ]);

        if($request->password != null){
            $request->validate([
                'password' => 'required|confirmed'
            ]);
            $validated['password'] = bcrypt($request->password);
        }

        $user->update($validated);

        $user->syncRoles($request->roles);
        return redirect()->back()->withSuccess('User updated !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->withSuccess('Role deleted !!!');
    }


    public function changeUserStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->active = $request->status;
        $user->save();

        return response()->json(['success'=>'Status change successfully.']);
    }

    //create user Credits
    public function createUserCredit(Request $request){
        
        $UsedCredit = UserCredit::where('user_id',$request->user_id)->latest()->first();
        
        if(empty($UsedCredit)){
            $unUsed = $request->credits;
            $used = 0;
        }else{
            $unUsed = $UsedCredit->unused_credits + $request->credits;
            $used = $UsedCredit->used_credits;
        }

        $credit = UserCredit::create([
            'user_id'=>$request->user_id,
            'month'=>$request->month,
            'purchased_credits'=>$request->credits,
            'used_credits' =>  $used,
            'unused_credits' => $unUsed
        ]);

        return response()->json(['success'=>'Store Credit successfully.']);
       
    }

    //assing brand to user
    public function assingBrandUser(Request $request){
      
       $userId = $request->user_id;
       $brandIds = $request->brand;
       
       $user = User::find($userId);

        foreach($brandIds as $brand){  
            if ($user->brands->contains($brand)) {
                return response()->json(['error'=>'User is already assigned to this brand.']);
            } else {
                BrandUser::create([
                    'user_id' => $userId,
                    'brand_id' => $brand
                ]);
                return response()->json(['success'=>'Assigned to this brand.']);
            }    
        }
    }

    public function unassigneBrand(Request $request){

    }
}
