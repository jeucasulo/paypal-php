<?php
session_start();
$payment = new Payment();
$payment->executePayment();

class Payment{
  public function getToken(){
    $path = $_SERVER['DOCUMENT_ROOT']."/TOKEN-UPDATE/response_get_token_copy.json";
    
    if(file_exists($path)){
        $file = file_get_contents($path); //string
        $json = json_decode($file); // decode the JSON into an associative array
        return $json->access_token;
    }else{
        // echo "não existe";
    }

    return $accessToken;
  }

    public function executePayment(){
        // access the post vars sent from the ExecutePayment on the frontend trough the paypal button object and
        // gets the paymentId and payerId
        $PaymentID = $_POST['paymentID'];
        $PayerID = $_POST['payerID'];
        $accessToken = $this->getToken();

        $endpoint = "https://api.sandbox.paypal.com/v1/payments/payment/".$PaymentID."/execute";
        $paymentHeaders = array("Content-Type: application/json", "Authorization: Bearer ".$accessToken);
        $postfields = "{\"payer_id\":\"$PayerID\"}";        
        
        // source: https://developer.paypal.com/docs/api/payments/v1/#payment_execute

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $paymentHeaders);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_POST, true);

        $run = curl_exec($ch);

        curl_close($ch);

        $runArray = json_decode($run, 1);
        
        // writes the execute payment response for checking purposes
        file_put_contents("executePaymentResponse.txt", $run);

        

        // return the response from the paypal site trought the curl post execute 
        echo $run;
    }
}
?>