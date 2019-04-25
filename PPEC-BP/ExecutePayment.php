<?php
session_start();
$payment = new Payment();
$payment->executePayment();

class Payment{
    public function executePayment(){
        // access the post vars sent from the ExecutePayment on the frontend trough the paypal button object and
        // gets the paymentId and payerId
        $PaymentID = $_POST['paymentID'];
        $PayerID = $_POST['payerID'];

        $url = "https://api.sandbox.paypal.com/v1/payments/payment/".$PaymentID."/execute";
        $paymentHeaders = array("Content-Type: application/json", "Authorization: Bearer ".$_SESSION["access_token"]);
        $postfields = "{\"payer_id\":\"$PayerID\"}";        

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
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