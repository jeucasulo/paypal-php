<?php
$clientId = $_POST['clientId'];
$secret = $_POST['secret'];

$paypalCheckout = new PaypalCheckout();
$paypalCheckout->getToken($clientId, $secret);

class PaypalCheckout{

  public function getToken($clientId, $secret){
    // $clientId = "AdYLZtwY8zHLgVLR7uawFMLHXWT-jswUL0jnyZJAIfjjYzsWfR9mxHhKQaAcDR409oZmujTDAh207JJI";
    // $secret = "EA1M8eQy2L81475BiOGvH2ioxMe5A7fAGj5oC1ODG5--yd49c4mIab5dwZDoeIuYbvh7w3GznoHTqOjT";

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
    curl_close($ch);
    
    // with the array cast (array) returns an array as well
    $runObj = json_decode($run, 1);

    $expires = date("m/d/Y h:i:s a", time() + 32398);
    $token_copy = json_decode($run);
    $token_copy->expires_in_date = $expires;
    
    file_put_contents('response_token_copy.json',json_encode($token_copy));
    file_put_contents('responseGetToken.json', $run);
    
    echo $run;
  }

}
?>