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
        // validation 
        $request->validate([
            'merchant_id' => 'required',
            'descriptor'=>'required',
            'email' =>'required',
            'currency'=>'required',
            'limit'=>'required'
        ]);

        //dd($request);

        $gateway = PaymentGateway::create([
            'merchant_id' => $request->merchant_id,
            'descriptor' => $request->descriptor,
            'email' => $request->email,
            'currency' => $request->currency,
            'limit' => $request->limit,

            'live_auth_login_id' => $request->auth_live_login_id,
            'live_auth_transaction_key' => $request->auth_live_transaction_key,
            'test_auth_login_id' => $request->auth_test_login_id,
            'test_auth_transaction_key' => $request->auth_test_transaction_key,
            'live_stripe_publishable_key' => $request->live_stripe_publishable_key,
            'live_stripe_secret_key' => $request->live_stripe_secret_key,
            'test_stripe_publishable_key' => $request->test_stripe_publishable_key,
            'test_stripe_secret_key' => $request->test_stripe_secret_key,
            // 'test_paypal_api_username' => $request->test_paypal_api_username,
            // 'test_paypal_api_password' => $request->test_paypal_api_password,
            // 'test_paypal_api_signature' => $request->test_paypal_api_signature,
            // 'live_paypal_api_username' => $request->live_paypal_api_username,
            // 'live_paypal_api_password' => $request->live_paypal_api_password,
            // 'live_paypal_api_signature' => $request->live_paypal_api_signature,
            // 'test_braintree_merchantId' => ,
            // 'test_braintree_publicKey' => ,
            // 'test_braintree_privateKey' => ,
            // 'live_braintree_merchantId' => ,
            // 'live_braintree_publicKey' => ,
            // 'live_braintree_privateKey' => ,
            // 'square_sandbox_application_id' => ,
            // 'square_sandbox_access_token' => ,
            // 'square_sandbox_location_id' => ,
            // 'square_production_application_id' => ,
            // 'square_production_access_token' => ,
            // 'square_production_Location_id' => ,
            // 'twocheckout_sandbox_seller_id' => ,
            // 'twocheckout_sandbox_publishable_key' => ,
            // 'twocheckout_sandbox_private_key' => ,
            // 'twocheckout_live_seller_id' => ,
            // 'twocheckout_live_publishable_key' => ,
            // 'twocheckout_live_private_key' => ,
            'environment' => $request->environment,
            'status' => $request->publish,    
        ]);

        return redirect()->back()->withSuccess('Gateway created !!!');
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
