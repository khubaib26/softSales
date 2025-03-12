<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Client;
use App\Models\Team;
use App\Models\Invoice;
use App\Models\PaymentGateway;
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
            // $clients = Client::whereHas('brand', function($query) use ($userId) {
            //     $query->whereHas('users', function($query) use ($userId) {
            //         $query->where('users.id', $userId);
            //     });
            // })->get();
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
        
        return view('setting.invoice.new',['brands'=>$brands, 'merchants' =>$merchants, 'clients'=>$clients]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
