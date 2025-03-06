<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Team;
use App\Models\Category;
use App\Models\User;
use Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    
    function __construct()
    {
        $this->middleware('role_or_permission:Brand access|Brand create|Brand edit|Brand delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Brand create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Brand edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Brand delete', ['only' => ['destroy']]);
    } 

    public function index()
    {
       
        $brands = Brand::all();

        $users = User::where('active','1')->whereNotIn('id', [1])->get();
        
        return view('setting.brand.index',['brands'=>$brands, 'users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $teams = Team::where('publish','1')->get();
        return view('setting.brand.new',['categories'=>$category, 'teams' =>$teams]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation 
        $request->validate([
            'name'=>'required',
            'team_id'=>'required',
            'brand_url' =>'required',
            'brand_logo_url'=>'required'
        ]);

        //dd($request);

        $category = Brand::create([
            'category_id'=>$request->category_id,
            'team_id'=>$request->team_id,
            'name'=>$request->name,
            'brand_url'=>$request->brand_url,
            'logo'=>$request->brand_logo_url,
            'fav'=>$request->brand_fav_url,
            'publish' =>$request->publish
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
}
