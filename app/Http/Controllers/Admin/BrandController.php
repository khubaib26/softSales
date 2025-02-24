<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
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
        //dd($brands);
        
        return view('setting.brand.index',['brands'=>$brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('setting.brand.new',['categories'=>$category]);
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
            'brand_url' =>'required',
            'brand_logo_url'=>'required'
        ]);

        //dd($request);

        $category = Brand::create([
            'category_id'=>$request->category_id,
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
