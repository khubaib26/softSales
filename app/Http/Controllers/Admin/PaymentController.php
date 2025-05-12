<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Payment;
use Braintree\Gateway;
//use App\Helpers\MerchantHelper;



class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('setting.payment.index');
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
        $invoice = Invoice::where(['invoice_number'=>$id])->first();
        
        if($invoice->paymentGateway->merchant->name == "Braintree"){
            if($invoice->paymentGateway->environment == 1){
                //Production
                $merchantId = $invoice->paymentGateway->live_braintree_merchantId;
                $publicKey = $invoice->paymentGateway->live_braintree_publicKey;
                $privateKey = $invoice->paymentGateway->live_braintree_privateKey;
                $environment = "production";
           }else{
               //SandBox
               $merchantId = $invoice->paymentGateway->test_braintree_merchantId;
               $publicKey = $invoice->paymentGateway->test_braintree_publicKey;
               $privateKey = $invoice->paymentGateway->test_braintree_privateKey;
               $environment = "sandbox";
           }

            $gateway = new Gateway([
                'environment' => $environment,
                'merchantId' => $merchantId,
                'publicKey' => $publicKey,
                'privateKey' => $privateKey,
            ]);

            $clientToken = $gateway->clientToken()->generate();
        }else{
            $clientToken = '';
        }
       
        return view('setting.payment.index',['invoice'=>$invoice, 'clientToken'=>$clientToken]);
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
        //dd($request);
       
        $invoiceNumber = $request->invoice_number;

        $invoiceData = Invoice::where('invoice_number',$invoiceNumber)->first();
       
        // Get Merchant 
        $paymentGateway = $invoiceData->paymentGateway->merchant->name;
        $client = $invoiceData->client;

        //dd($request->nonce);
        $paymentProcessData = array(
            "invoiceNumber" => $request->invoice_number,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "phone" => $request->phoner,
            "amount" => $request->amount,
            "card_name" => $request->card_name,
            "card_number" => $request->card_number,
            "card_exp_month" => $request->card_exp_month,
            "card_exp_year" => $request->card_exp_year,
            "card_cvv" => $request->card_cvv,
            "invoice_data" => $invoiceData,
            "stripeToken" => $request->stripeToken,
            "nonce" => $request->nonce,
            'bt_nonce' => $request->bt_payment_method_nonce
        );

        switch ($paymentGateway) {
            case 'Authorize':
                $paymentStatus = processAuthorizeNetPayment($paymentProcessData);
                break;
            case 'Stripe':
                $paymentStatus = processStripePayment($paymentProcessData);
                break;
            case 'paypal':
                // Process PayPal payment
                break;
            case 'Square':
                $paymentStatus = processSquarePayment($paymentProcessData);
                break;
            case 'Braintree':
                $paymentStatus = processBraintreePayment($paymentProcessData);
                break;    
            default:
                // Invalid gateway
        }

        if($paymentStatus['success'] && $paymentStatus['transaction_reference'] != ''){
            
            $payment = Payment::create([
                'invoice_id' => $invoiceData->id,
                'brand_id' => $invoiceData->brand_id,
                'client_id' => $invoiceData->client_id,
                'user_id'  => $invoiceData->user_id,
                'gateway_id' => $invoiceData->gateway_id,
                'amount' => $request->amount,
                'paid_at' => now(),
                'transaction_reference' => $paymentStatus['transaction_reference'],
                'note' => $paymentStatus['response_text'],
                'payment_status' => $paymentStatus['response_code'],
            ]);

            $invoiceData->status = 'paid';
            $invoiceData->save();

            return redirect()->back()->withSuccess('Payment Successed !!!');

        }else{
            return redirect()->back()->withSuccess('Payment Fail !!!');
        }
    }    
}
