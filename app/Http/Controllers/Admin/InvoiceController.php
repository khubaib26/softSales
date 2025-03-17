<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Client;
use App\Models\Team;
use App\Models\User;
use App\Models\Invoice;
use App\Models\PaymentGateway;
use Illuminate\Support\Str;
use Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('role_or_permission:Invoice access|Invoice create|Invoice edit|Invoice delete', ['only' => ['index','show']]);
         $this->middleware('role_or_permission:Invoice create', ['only' => ['create','store']]);
         $this->middleware('role_or_permission:Invoice edit', ['only' => ['edit','update']]);
         $this->middleware('role_or_permission:Invoice delete', ['only' => ['destroy']]);
    } 
    
    public function index()
    {
        $userId = Auth::user()->id;
         
        if(Auth::user()->hasRole('admin'))
        {
            $invoices = Invoice::all();
        }else{
            //$invoices = Invoice::where('');
        } 
        return view('setting.invoice.index',['invoices'=>$invoices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::user()->id;
         
        if(Auth::user()->hasRole('admin'))
        {
            $brands = Brand::where('publish','1')->get();
            $clients = Client::all();

        }else{
            // user assing Brands
            $brands = Brand::where('publish','1')->whereHas('users', function($query) use ($userId) {
                $query->where('users.id', $userId);
            })->get();

            //user asing brands client
            $clients = Client::whereHas('brand', function($query) use ($userId) {
                $query->whereHas('users', function($query) use ($userId) {
                    $query->where('users.id', $userId);
                });
            })->get();
        }
        $merchants = PaymentGateway::where('status','1')->get();
        $users = User::where('active','1')->whereNotIn('id', [1])->get();
        
        return view('setting.invoice.new',['brands'=>$brands, 'merchants' =>$merchants, 'clients'=>$clients, 'users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $creatorid  = Auth::user()->id;
        $userRole = (Auth::user()->hasRole('admin')?'ADMIN':'USR');
        $userId = $request->user_id;
        $brandId = $request->brand_id;
        $merchantId = $request->merchant_id;
        $clientId = $request->client_id;
        $name = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $currency = $request->currency;
        $service = $request->service;
        $amount = $request->amount;
        $due_date = $request->due_date;
        $description = $request->description;

        //check client exist
        $client_exists = Client::where('email',$email)->first();
        
        //dd($client_exists); 
        if($clientId == null){
            $client = client::create([
                'name'=>$name,
                'brand_id'=> $brandId,
                'email' => $email,
                'phone' => $phone,
                'status' =>'1'
            ]);  
            $clientId = $client->id;
        }

        $invoice = Invoice::create([
            'invoice_number' => Str::random(10),
            'brand_id' => $brandId,
            'client_id' => $clientId,
            'user_id' => $userId,
            'creator_id' => $creatorid,
            'creator_role' => $userRole,
            'amount' => $amount,
            'due_date' => $due_date,
            'service' => $service,
            'sales_type' => 'Fresh',
            'status' => 'due',
            'descriptione' => $description,
            'currency' => $currency,
            'gateway_id' => $merchantId
            
        ]);
        return redirect()->back()->withSuccess('Brand created !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get_brand_user(Request $request){
        
        $brnadId = $request->BrandId;
       
        $users = User::whereHas('brands', function($query) use ($brnadId) {
            $query->where('brands.id', $brnadId);
        })->get();

        $cxmUsers = '';
        
       if(count($users) > 0){
            foreach ($users as $user) {
                $cxmUsers .= '<option>&nbsp;&nbsp;&nbsp;Select Agent</option>';
                $cxmUsers .= '<option value="' . $user->id . '">' . $user->name .' - '.$user->pseudonym.'</option>';
            }
       }else{
            $cxmUsers .= '<option value="1">No Agent Assing Create Invoice as Admin</option>';
       }
        return $cxmUsers;
    }
}
