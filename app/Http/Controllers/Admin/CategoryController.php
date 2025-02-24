<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Auth;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('role_or_permission:Category access|Category create|Category edit|Category delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Category create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Category edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Category delete', ['only' => ['destroy']]);
    }
     
    public function index()
    {
        $Category= Category::paginate(4);
        return view('setting.category.index',['categories'=>$Category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setting.category.new');
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
        ]);
        $category = Category::create([
            'name'=>$request->name,
            'publish' =>$request->publish
        ]);
        return redirect()->back()->withSuccess('Category created !!!');
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
        $category = Category::find($id);
        return view('setting.category.edit',['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // validation 
        $validated = $request->validate([
            'name'=>'required',
            'publish' => 'required',
        ]);

        $category->update($validated);
        return redirect()->back()->withSuccess('Permission updated !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->withSuccess('Section deleted !!!');
    }
}
