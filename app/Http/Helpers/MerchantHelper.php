<?php
namespace App\Helpers;
use App\Models\PaymentGateway;

use Square\SquareClient;
use Square\Environments;

class MerchantHelper {
    public static function processSquarePayment($data) {
      
        // $client = new SquareClient([
        //     'accessToken' => env('SQUARE_ACCESS_TOKEN'),
        //     'environment' => Environment::SANDBOX
        // ]);
        // Payment logic here

        $gatewayId = $data['invoice_data']['gateway_id'];
    
        //Get Merchant Information
        $paymentMethod = PaymentGateway::where(['status' => 1, 'id' =>$gatewayId])->first();

        if($paymentMethod->environment == 1){
            //Production
            $applicationId = $paymentMethod->square_production_application_id;
            $accessToken = $paymentMethod->square_production_access_token;
            $locationId = $paymentMethod->square_production_Location_id;
        }else{
            //SandBox
            $applicationId = $paymentMethod->square_sandbox_application_id;
            $accessToken = $paymentMethod->square_sandbox_access_token;
            $locationId = $paymentMethod->square_sandbox_Location_id; 
        }

        $invoice_amount = $data['amount'];
        $nonce = $data['nonce'];

        $client = new SquareClient([
            'accessToken' => $accessToken,
            'environment' => ($paymentMethod->environment == 1) ? Environments::PRODUCTION : Environments::SANDBOX
        ]);


        //dd($client);
    }
}