<?php

$json_string = json_encode($_POST);

// $file_handle = fopen('my_filename.json', 'w');
// fwrite($file_handle, $json_string);
// fclose($file_handle);

file_put_contents('_post.json',$json_string);
file_put_contents('_str.json',$_POST['a']);



$test = isset($_POST['body'])?'sim':'nao';
file_put_contents('_test.txt',$test);
/* GetToken */
require_once(__DIR__.'/get-token.php');
$token = new Token();
$accessToken = $token->getToken();
/* GetToken */

$paypalCheckout = new PaypalCheckout();
$paypalCheckout->createOrder($accessToken);

class PaypalCheckout{

  public function createOrder($accessToken){
   $url = "https://api.sandbox.paypal.com/v2/checkout/orders";

   $paymentHeaders = array("Content-Type: application/json", "Authorization: Bearer ".$accessToken);

   $postfields = '{
      "intent": "CAPTURE",
      "purchase_units": [
        {
          "amount": {
            "currency_code": "USD",
            "value": "100.00"
          }
        }
      ]
    }';

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


   file_put_contents("_createOrder.json", $run);

   echo $run;
 }
}
?>