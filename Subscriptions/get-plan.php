<?php

$paypalCheckout = new GetPlanAgreement();
$paypalCheckout->getPlan();



class GetPlanAgreement{
  
    public function getPlan(){
      
    //  echo "GetPlan<br>";
     
     
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
    
    $runObj = json_decode($run,1); // this one so you can get access token by index

    $accessToken = $runObj['access_token'];
    
    file_put_contents("accssTokenTest.txt", $accessToken);
    
    
    ////////////////////////////////////////////////////////////////////////
    
    if(file_exists('responsePlanCreate.json')){
      // $path = file_put_contents('existe', 'sim') ;
    }else{
      // $path = file_put_contents('existe','nao') ;
    }
    $path = file_get_contents('responsePlanCreate.json') ;
    $json = json_decode($path); // decode the JSON into an associative array
    $pId = $json->id;
    
    // echo "plan id -----------------------------------------------------------------> ".$pId;
    // file_put_contents('test.txt', $path);

   $url = "https://api.sandbox.paypal.com/v1/payments/billing-plans/$pId/";

   $paymentHeaders = array("Content-Type: application/json", "Authorization: Bearer ".$accessToken);


   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $paymentHeaders);
//   curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

   curl_setopt($ch, CURLOPT_VERBOSE, 1);
   curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   curl_setopt($ch, CURLOPT_POST, false);

   $run = curl_exec($ch);

   curl_close($ch);
   
   $json = json_decode($path); // decode the JSON into an associative array
   $pId = $json->id;
   $pState = $json->state;
   
   echo $run;
 }
}
?>