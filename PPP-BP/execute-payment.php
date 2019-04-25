<?php

// $execute = $_SESSION['execute'];
// echo "<script>console.log('execute payment ok')</script>";

// echo "execute ok";
// return "execute ok";



// require_once('create-payment.php');
session_start();
$payment = new Payment();
$payment->executePayment();

class Payment{
    public function executePayment(){
        $execute = $_SESSION['execute'];
        // $PaymentID = $_POST['paymentID'];
        $PayerID = $_POST['payer_id'];
        $access_token = $_SESSION["access_token"];

        file_put_contents("payerID.txt", $PayerID);


        // echo $execute."<br><br><br>".$access_token;

        // $url = "https://api.sandbox.paypal.com/v1/payments/payment/".$PaymentID."/execute";
        $url = $execute;
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

        echo json_encode(json_decode($run));

        // transaction > related_resources > sale > state

    }
}
?>