<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Client;
use App\Models\Team;
use Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('role_or_permission:Client access|Client create|Client edit|Client delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Client create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Client edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Client delete', ['only' => ['destroy']]);
    } 

    public function index()
    {
        $userId = Auth::user()->id;
         
        if(Auth::user()->hasRole('admin'))
        {
            $clients = Client::all();
        }else{
            $clients = Client::whereHas('brand', function($query) use ($userId) {
                $query->whereHas('users', function($query) use ($userId) {
                    $query->where('users.id', $userId);
                });
            })->get();
        }

        return view('setting.client.index',['clients'=>$clients]);
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
        }else{
            $brands = Brand::where('publish','1')->whereHas('users', function($query) use ($userId) {
                $query->where('users.id', $userId);
            })->get();
        }
        
        return view('setting.client.new',['brands'=>$brands]);
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
            'brand_id' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        //dd($request);

        $client = client::create([
            'name'=>$request->name,
            'brand_id'=>$request->brand_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'client_description' => $request->client_description,
            'status' =>$request->publish
        ]);
        return redirect()->back()->withSuccess('Client created !!!');
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
