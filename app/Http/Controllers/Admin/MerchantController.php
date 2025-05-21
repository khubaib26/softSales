<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Merchant;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // function __construct()
    // {
    //     $this->middleware('role_or_permission:Merchant access|Merchant create|Merchant edit|Merchant delete', ['only' => ['index','show']]);
    //     $this->middleware('role_or_permission:Merchant create', ['only' => ['create','store']]);
    //     $this->middleware('role_or_permission:Merchant edit', ['only' => ['edit','update']]);
    //     $this->middleware('role_or_permission:Merchant delete', ['only' => ['destroy']]);
    // } 
    
    public function index()
    {
        $merchants = Merchant::all();
        return view('setting.merchant.index',['merchants'=>$merchants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach($request->payment_methods as $data){
            Merchant::where('id', $data)->update(['status' => '1']);
        }

        return redirect()->back()->withSuccess('Section deleted !!!');        
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
