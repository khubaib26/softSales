<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;
use App\Models\Merchant;
use Illuminate\Http\Request;

class PaymentGatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */

    function __construct()
    {
        $this->middleware('role_or_permission:Gateway access|Gateway create|Gateway edit|Gateway delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Gateway create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Gateway edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Gateway delete', ['only' => ['destroy']]);
    } 


    public function index()
    {
        
        $paymentGateways = PaymentGateway::all();
        return view('setting.gateway.index',['paymentGateways'=>$paymentGateways]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $merchants = Merchant::where('status','1')->get();
        return view('setting.gateway.new',['merchants'=>$merchants]);

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
     * @param  \App\Models\PaymentGateway  $paymentGateway
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentGateway $paymentGateway)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentGateway  $paymentGateway
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentGateway $paymentGateway)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentGateway  $paymentGateway
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentGateway $paymentGateway)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentGateway  $paymentGateway
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentGateway $paymentGateway)
    {
        //
    }
}
