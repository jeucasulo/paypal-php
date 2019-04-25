<?php
// source: https://developer.paypal.com/docs/subscriptions/integrate/integrate-steps/#2-activate-a-plan


session_start();
// $token_id = $_POST['baToken'];
$finalValue = $_GET['value'];
file_put_contents('_finalValue.txt',$finalValue);

$paypalCheckout = new CFO();


$accessToken = $paypalCheckout->getToken();
$paypalCheckout->calculatedFinancingOptions($accessToken,$finalValue);


class CFO{


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

  public function calculatedFinancingOptions($accessToken,$finalValue){
    
    // file_put_contents('_token_id.txt', $token_id);
    
    
    if(file_exists('_responseAgreementCreate.json')){
      // $path = file_put_contents('existe', 'sim') ;
    }else{
      // $path = file_put_contents('existe','nao') ;
    }
    $path = file_get_contents('_responseAgreementCreate.json') ;
    $json = json_decode($path); // decode the JSON into an associative array
    $BillingAgreementId = $json->id;
    $BillingAgreementState = $json->state;
    file_put_contents('_isToken.txt', 'id: '. $BillingAgreementId.' state: '.$BillingAgreementState);

    

   $url = "https://api.sandbox.paypal.com/v1/credit/calculated-financing-options";

   $paymentHeaders = array("Content-Type: application/json", "Authorization: Bearer ".$accessToken);

// JSON FORMAT SOURCE : https://developer.paypal.com/docs/subscriptions/integrate/integrate-steps/#3-create-an-agreement
   $postfields = '{
    "financing_country_code": "BR",
    "transaction_amount": {
        "value": "'.$finalValue.'",
        "currency_code": "BRL"
    },
    "funding_instrument": {
        "type": "BILLING_AGREEMENT",
        "billing_agreement": {
            "billing_agreement_id": "'.$BillingAgreementId.'"
        }
    }
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

   $runObj = json_decode($run, 1);

   
   $runJson = json_encode($runObj);

   

   file_put_contents("_responseCalculatedFinancingOptions.json", $run);

   echo $runJson;
 }
}
?>