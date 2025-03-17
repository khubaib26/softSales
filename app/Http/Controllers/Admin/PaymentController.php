<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function make_payment_transaction(Request $request){
       
       
        $invoiceNumber = $request->invoice_number;

        $invoiceData = Invoice::where('invoice_number',$invoiceNumber)->first();
        //$invoice = Invoice::with('paymentGateway.merchant')->find(1);
        // Get Merchant 
        $paymentGateway = $invoiceData->paymentGateway->merchant->name;
        $client = $invoiceData->client;

        $paymentProcessData = array(
            "invoiceNumber" => $request->invoice_number,
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phoner,
            "amount" => $request->amount,
            "card_name" => $request->card_name,
            "card_number" => $request->card_number,
            "card_exp_month" => $request->card_exp_month,
            "card_exp_year" => $request->card_exp_year,
            "card_cvv" => $request->card_cvv
        );

        switch ($paymentGateway) {
            case 'Authorize':
                $paymentStatus = processAuthorizeNetPayment($paymentProcessData);
                break;
            case 'stripe':
                // Process Stripe payment
                break;
            case 'paypal':
                // Process PayPal payment
                break;
            case 'authorize':
                // Process Authorize.net payment
                break;
            default:
                // Invalid gateway
        }

        dd($paymentStatus);
    }
}
