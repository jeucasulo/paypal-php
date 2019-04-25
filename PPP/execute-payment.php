<?php
session_start();
session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
session_regenerate_id(true);

$payment = new Payment();

$paypalCheckout = new Payment();
$accessToken = $paypalCheckout->getToken();

$payment->executePayment($accessToken);

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
    }

    public function executePayment($accessToken){
        // $execute = $_SESSION['execute'];
        // $PaymentID = $_POST['paymentID'];
        $PayerID = $_POST['payer_id'];
        // $access_token = $_SESSION["access_token"];
        
        $path = $_SERVER['DOCUMENT_ROOT']."/PPP/create_payment_response.json";

        
        if(file_exists($path)){
            $file = file_get_contents($path); //string
            $json = json_decode($file); // decode the JSON into an associative array
            // return $json->access_token;
            // $approval = $runObj->links[1]->href;
            $execute = $json->links[2]->href;

        }else{
            // echo "não existe";
        }


        file_put_contents("payerID.txt", $PayerID);
        file_put_contents("_execute.txt", $execute);


        // echo $execute."<br><br><br>".$access_token;

        // $url = "https://api.sandbox.paypal.com/v1/payments/payment/".$PaymentID."/execute";
        $url = $execute;
        // $paymentHeaders = array("Content-Type: application/json", "Authorization: Bearer ".$_SESSION["access_token"]);
        $paymentHeaders = array("Content-Type: application/json", "Authorization: Bearer ".$accessToken);
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

        file_get_contents('create_payment_response.json',$run);

        echo json_encode(json_decode($run));
        // echo ($run);

        // transaction > related_resources > sale > state

    }
}
?>