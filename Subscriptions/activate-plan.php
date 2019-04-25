<?php
// source: https://developer.paypal.com/docs/subscriptions/integrate/integrate-steps/#2-activate-a-plan
session_start();


$paypalCheckout = new PaypalCheckout();
$accessToken = $paypalCheckout->getToken();
$accessToken = $paypalCheckout->activate($accessToken);


class PaypalCheckout{
  
  
  public function activate($accessToken){
    $path = file_get_contents('responsePlanCreate.json') ;
    $json = json_decode($path); // decode the JSON into an associative array
    $pId = $json->id;

    // curl -v -X PATCH https://api.sandbox.paypal.com/v1/payments/billing-plans/P-7DC96732KA7763723UOPKETA/ \
    // -H "Content-Type: application/json" \
    // -H "Authorization: Bearer Access-Token" \
    // -d '[{
    //   "op": "replace",
    //   "path": "/",
    //   "value":
    //   {
    //     "state": "ACTIVE"
    //   }
    // }]'
    
  // file_put_contents('pIdFinal',$pId);
   $url = "https://api.sandbox.paypal.com/v1/payments/billing-plans/".$pId."/";
   file_put_contents('pIdFinal',$url);
   file_put_contents('tokenFinal',$accessToken);

   $paymentHeaders = array("Content-Type: application/json", "Authorization: Bearer ".$accessToken);

// JSON FORMAT SOURCE : https://developer.paypal.com/docs/api/payments.billing-agreements/v1/
   $postfields = '[{
      "op": "replace",
      "path": "/",
      "value":
      {
        "state": "ACTIVE"
      }
    }]';

   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $paymentHeaders);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

   curl_setopt($ch, CURLOPT_VERBOSE, 1);
   curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH'); 
  // curl_setopt($ch, CURLOPT_POST, true);

   $run = curl_exec($ch);

   curl_close($ch);
  
   echo $run;

  }

  public function getToken(){
    $clientId = "AdYLZtwY8zHLgVLR7uawFMLHXWT-jswUL0jnyZJAIfjjYzsWfR9mxHhKQaAcDR409oZmujTDAh207JJI";
    $secret = "EA1M8eQy2L81475BiOGvH2ioxMe5A7fAGj5oC1ODG5--yd49c4mIab5dwZDoeIuYbvh7w3GznoHTqOjT";

    $url = "https://api.sandbox.paypal.com/v1/oauth2/token";

    $headers = array( "Accept"=>"application/json",
      "Accept-Language"=>"en_US",
      "Content-Type"=>"application/x-www-form-urlencoded",
    );
    $postfields = "grant_type=client_credentials";
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

    curl_setopt($ch, CURLOPT_USERPWD, $clientId.":".$secret);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_POST, true);

    $run = curl_exec($ch);

    // echo $run;

    curl_close($ch);

    // with the array cast (array) returns an array as well
    $runObj = json_decode($run, 1);

    // writes the create payment response for checking purposes

    $_SESSION["access_token"] = $runObj["access_token"];
    $accessToken = $runObj["access_token"];

    file_put_contents("responseGetToken.txt", $run);

    return $accessToken;
  }

}
?>