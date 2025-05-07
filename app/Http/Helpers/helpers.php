<?php
// includeing classess
use App\Models\PaymentGateway;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use Stevebauman\Location\Facades\Location;
//Square Library
use Square\SquareClient;
use Square\Exceptions\ApiException;
use Square\Models\CreatePaymentRequest;
use Square\Models\Money;
use Square\Environment;
//Braintree
use Braintree\Gateway;

// convert 1000 to K
function thousand_format($number) {
    $number = (int) preg_replace('/[^0-9]/', '', $number);
    if ($number >= 1000) {
        $rn = round($number);
        $format_number = number_format($rn);
        $ar_nbr = explode(',', $format_number);
        $x_parts = array('K', 'M', 'B', 'T', 'Q');
        $x_count_parts = count($ar_nbr) - 1;
        $dn = $ar_nbr[0] . ((int) $ar_nbr[1][0] !== 0 ? '.' . $ar_nbr[1][0] : '');
        $dn .= $x_parts[$x_count_parts - 1];

        return $dn;
    }
    return $number;
}

function get_percentage($total, $number){
    if ( $total > 0 ) {
        return round(($number * 100) / $total, 2);
    } else {
        return 0;
    }
}

// Growth Calculation Function
function growth_calculation($currentMonth, $lastMonth){
    if($lastMonth == 0){
        return number_format(0, 2);  
    }else{
        $growth = ($currentMonth - $lastMonth) / $lastMonth * 100;
        return number_format($growth, 2);
    } 
}

// Lead conversion rate calculation
function conversion_rate($convertedLead, $totalLead){
  if($totalLead == 0){
    return number_format(0, 2);
  }else{
    $lcr = ($convertedLead / $totalLead) * 100;
    return number_format($lcr, 2);
  }  
}


// AuthorizeNet payment Function
function processAuthorizeNetPayment($data){
    
    $gatewayId = $data['invoice_data']['gateway_id'];
    
    //Get Merchant Information
    $paymentMethod = PaymentGateway::where(['status' => 1, 'id' =>$gatewayId])->first();
    
    // Check Merchant Environment 
    if($paymentMethod->environment == 1){
        $loginId = $paymentMethod->live_auth_login_id;
        $transcation_key = $paymentMethod->live_auth_transaction_key; 
        
    }else{
        $loginId = $paymentMethod->test_auth_login_id;
        $transcation_key = $paymentMethod->test_auth_transaction_key;
    }

    // Set the transaction's reference ID 
    $refID = 'REF'.time(); 
            
    // Create a merchantAuthenticationType object with authentication details 
    // retrieved from the config file  
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName($loginId);
    $merchantAuthentication->setTransactionKey($transcation_key);

    // Create the payment data for a credit card 
    $cardNumber = preg_replace('/\s+/', '', $data['card_number']);
    
    $creditCard = new AnetAPI\CreditCardType(); 
    $creditCard->setCardNumber($cardNumber); 
    $creditCard->setExpirationDate($data['card_exp_year'] . "-" .$data['card_exp_month']); 
    $creditCard->setCardCode($data['card_cvv']); 
    
    //dd($creditCard);
    // Add the payment data to a paymentType object 
    $paymentOne = new AnetAPI\PaymentType(); 
    $paymentOne->setCreditCard($creditCard); 

    // Create order information 
    $order = new AnetAPI\OrderType(); 
    $order->setInvoiceNumber($data['invoiceNumber']);
    $order->setDescription('IT Services'); 
    //dd($order);
    
    // Set the customer's Bill To address
    $customerAddress = new AnetAPI\CustomerAddressType();
    $customerAddress->setFirstName($data['first_name']);
    $customerAddress->setLastName($data['last_name']);
    //$customerAddress->setCompany($input['trademark_company_name']);
    //$customerAddress->setAddress($clientAddress);
    //$customerAddress->setCity($clientCity);
    //$customerAddress->setState($clientState);
    //$customerAddress->setCountry($clientCountry);
    //$customerAddress->setZip($clientZip);

    // Set the customer's identifying information 
    $customerData = new AnetAPI\CustomerDataType(); 
    $customerData->setType("individual"); 
    $customerData->setEmail($data['email']);

    // Create a transaction 
    $transactionRequestType = new AnetAPI\TransactionRequestType(); 
    $transactionRequestType->setTransactionType("authCaptureTransaction");    
    $transactionRequestType->setAmount($data['amount']); 
    $transactionRequestType->setOrder($order); 
    $transactionRequestType->setPayment($paymentOne);
    //$transactionRequestType->setBillTo($customerAddress);
    $transactionRequestType->setCustomer($customerData);

    $request = new AnetAPI\CreateTransactionRequest(); 
    $request->setMerchantAuthentication($merchantAuthentication); 
    $request->setRefId($refID); 
    $request->setTransactionRequest($transactionRequestType); 
    $controller = new AnetController\CreateTransactionController($request);

    if($paymentMethod->environment == 1){
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
    }else{
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
    }

    if ($response != null) {
        if ($response->getMessages()->getResultCode() == "Ok") {
            $tresponse = $response->getTransactionResponse();
            if ($tresponse != null & $tresponse->getResponseCode() == "1") {
                $transactionId = $tresponse->getTransId(); 
                $responseCode = $tresponse->getResponseCode(); 
                $authCode = $tresponse->getAuthCode();
                $msgCode = $tresponse->getMessages()[0]->getCode();
                $statusMsg = $tresponse->getMessages()[0]->getDescription();
                $status = 'success'; 
            } else {
                if ($tresponse->getErrors() != null) {
                    $errorCode = $tresponse->getErrors()[0]->getErrorCode();
                    $statusMsg =  $tresponse->getErrors()[0]->getErrorText();
                    $responseCode = $tresponse->getErrors()[0]->getErrorCode();
                    $status = 'Error';    
                }
            }
        }else{
            $tresponse = $response->getTransactionResponse();
            if ($tresponse != null && $tresponse->getErrors() != null) {
                $errorCode = $tresponse->getErrors()[0]->getErrorCode();
                $statusMsg =  $tresponse->getErrors()[0]->getErrorText();
                $responseCode = $tresponse->getErrors()[0]->getErrorCode();
                $status = 'Error';    
            }else{
                $errorCode = $response->getMessages()->getMessage()[0]->getCode();
                $statusMsg = $response->getMessages()->getMessage()[0]->getText(); 
                $status = 'Error';        
            }
        }   
    }else{
        $statusMsg =  "No response returned";
    }


    return $statusMsg;
    
    //return $data;
}

// Stripe Payment Function
function processStripePayment($data){
    //dd("Stripe payment process");
    $gatewayId = $data['invoice_data']['gateway_id'];
    
    //Get Merchant Information
    $paymentMethod = PaymentGateway::where(['status' => 1, 'id' =>$gatewayId])->first();
    
    // Check Merchant Environment 
    if($paymentMethod->environment == 1){
        //Production
        $publishableKey = $paymentMethod->live_stripe_publishable_key;
        $secretKey = $paymentMethod->live_stripe_secret_key; 
    }else{
        //SandBox
        $publishableKey = $paymentMethod->test_stripe_publishable_key;
		$secretKey = $paymentMethod->test_stripe_secret_key;
    }

    Stripe\Stripe::setApiKey($secretKey);

    try {
        $paymentResult = Stripe\Charge::create ([
            "amount" => $data['amount'] * 100,
            "currency" => "usd",
            "source" => $data['stripeToken'],
            "description" => "Test payment from tutorialsocean.com." 
        ]);
        //dd($paymentResult);
        if($paymentResult['status'] == 'succeeded') {
            return response()->json([
                'success' => true, 
                'msg' => 'Payment has been Successfully done! ',
                'payment' => $paymentResult
            ]);
        }
    } catch (\Stripe\Exception\CardException $e) {
            $paymentResult = $e->getMessage();
        
            return response()->json([
                'success' => false, 
                'msg' => 'Payment Fail!',
                'payment' => $paymentResult
            ]);
    } catch (\Exception $e) {
        // Handle other errors
        \Log::error($e);
            $paymentResult = $e->getMessage();
            return response()->json([
                'success' => false, 
                'msg' => 'Payment Fail!',
                'payment' => $paymentResult
            ]);
    }
    
    
    //return $statusMsg;
}

// Square Payment Function
function processSquarePayment($data){

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
        'environment' => ($paymentMethod->environment == 1) ? Environment::PRODUCTION : Environment::SANDBOX
    ]);

    // Set amount money
    $amount_money = new Money();
    $amount_money->setAmount($invoice_amount*100);
    $amount_money->setCurrency('USD');

    //dd($nonce);

    //Set Apliation Fee mondy (Optional)
    //$app_fee_money = new Money();
    //$app_fee_money->setAmount(10); // Amount in cents for application fee
    //$app_fee_money->setCurrency('USD');

    //Create Payment Request body
    $body = new CreatePaymentRequest($nonce, uniqid());
    $body->setAmountMoney($amount_money);
    // $body->setAppFeeMoney($app_fee_money); // Optional: Set Application fee money
    $body->setAutocomplete(true); //complete payment automatically

    // Optioanl : Set Custome ID, Location ID, reference ID, and Note
    $body->setLocationId($locationId);
    //$body->setReferenceId('12345678'); //Set Invoice Number
    //$body->setNote('Some description'); //Set Invoice Desctiption
    //dd($body);
    try {
        // Send payment request to Square API
        $api_response = $client->getPaymentsApi()->createPayment($body);
        
        //dd($api_response);
        // Handle API response
        
        if ($api_response->isSuccess()){
            $result = $api_response->getResult();
            $resp = json_encode($result);
            $resp_dec = json_decode($resp, true);
            //echo 'ID: '.$transid = $resp_dec["payment"]["card_details"]["card"]["card_brand"];
            // dd($result->getPayment()->getCard());
            // //dd($result->getPayment()->getStatus());
            // dd($result->getPayment()->getStatus());
            // dd($result->getPayment()->getId());
            return response()->json([
                'success' => true, 
                'msg' => 'Payment has been Successfully done!',
                'payment' => $result
            ]);

        } else {

            $errors = $api_response->getErrors();
            $reason = "";
            foreach ($errors as $error) {
                $reason .= $error->getDetail().' ';
            }
            
            return response()->json([
                'success' => false, 
                'msg' => 'Payment failed!',
                'errors' => $errors
            ]);
        }
    } catch (ApiException $e) {
        //Handle API exception
        return response()->json([
            'success' => false, 
            'msg' => $e->getMessage()
        ], 500);
    }


}

// Braintree Payment Function
function processBraintreePayment($data){
    
    $gatewayId = $data['invoice_data']['gateway_id'];
    
    //Get Merchant Information
    $paymentMethod = PaymentGateway::where(['status' => 1, 'id' =>$gatewayId])->first();

    if($paymentMethod->environment == 1){
         //Production
         $merchantId =$paymentMethod->live_braintree_merchantId;
         $publicKey =$paymentMethod->live_braintree_publicKey;
         $privateKey =$paymentMethod->live_braintree_privateKey;
         $environment = "production";
    }else{
        //SandBox
        $merchantId =$paymentMethod->test_braintree_merchantId;
        $publicKey =$paymentMethod->test_braintree_publicKey;
        $privateKey =$paymentMethod->test_braintree_privateKey;
        $environment = "sandbox";
    }

    $gateway = new Gateway([
        'environment' => $environment,
        'merchantId' => $merchantId,
        'publicKey' => $publicKey,
        'privateKey' => $privateKey,
    ]);
    
    
    $amount = $data['amount'];

    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $data['bt_nonce'],
        'options' => ['submitForSettlement' => true]
    ]);

        if ($result->success) {
            // $invoice->status = 'paid';
            // $invoice->transaction_id = $result->transaction->id;
            // $invoice->save();
            return response()->json([
                'success' => true, 
                'msg' => 'Payment has been Successfully done!',
                'payment' => $result
            ]);
        } else {
            return response()->json([
                'success' => false, 
                'msg' => 'Payment failed!',
                'errors' => $result->message
            ]);    
        }    
}


?>