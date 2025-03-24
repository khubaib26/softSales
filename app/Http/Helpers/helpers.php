<?php
// includeing classess
use App\Models\PaymentGateway;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;


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


?>