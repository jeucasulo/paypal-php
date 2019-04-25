<?php
session_start();

$paypalCheckout = new PaypalCheckout();
$accessToken = $paypalCheckout->getToken();
$paypalCheckout->createPlan($accessToken);

class PaypalCheckout{

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

  public function createPlan($accessToken){
   $url = "https://api.sandbox.paypal.com/v1/payments/billing-plans/ ";

   $paymentHeaders = array("Content-Type: application/json", "Authorization: Bearer ".$accessToken);

// JSON FORMAT SOURCE : https://developer.paypal.com/docs/api/overview/#make-your-first-call
   $postfields = '{
      "name": "Plan with Regular and Trial Payment Definitions",
      "description": "Plan with regular and trial payment definitions.",
      "type": "FIXED",
      "payment_definitions": [
        {
          "name": "Regular payment definition",
          "type": "REGULAR",
          "frequency": "MONTH",
          "frequency_interval": "2",
          "amount": {
            "value": "100",
            "currency": "BRL"
          },
          "cycles": "12",
          "charge_models": [
            {
              "type": "SHIPPING",
              "amount": {
                "value": "10",
                "currency": "BRL"
              }
            },
            {
              "type": "TAX",
              "amount": {
                "value": "12",
                "currency": "BRL"
              }
            }
          ]
        },
        {
          "name": "Trial payment definition",
          "type": "TRIAL",
          "frequency": "WEEK",
          "frequency_interval": "5",
          "amount": {
            "value": "9.19",
            "currency": "BRL"
          },
          "cycles": "2",
          "charge_models": [
            {
              "type": "SHIPPING",
              "amount": {
                "value": "1",
                "currency": "BRL"
              }
            },
            {
              "type": "TAX",
              "amount": {
                "value": "2",
                "currency": "BRL"
              }
            }
          ]
        }
      ],
      "merchant_preferences": {
        "setup_fee": {
          "value": "1",
          "currency": "BRL"
        },
        "return_url": "https://29428e7dd9774defbbde15e87e849c88.vfs.cloud9.us-east-2.amazonaws.com/?r=return",
        "cancel_url": "https://29428e7dd9774defbbde15e87e849c88.vfs.cloud9.us-east-2.amazonaws.com/?r=cancel",
        "auto_bill_amount": "YES",
        "initial_fail_amount_action": "CONTINUE",
        "max_fail_attempts": "0"
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

   // $PayID = "{\"id\":" . json_encode($runObj["id"]). "}";//this
   $PayID = json_encode(array_slice($runObj,0,1)); //get the PayId from json, where 0 is start and 1 is lenght
   $runJson = json_encode($runObj);

   // writes the create payment response for checking purposes
//   file_put_contents("createPaymentResponse.txt", $run);
//   file_put_contents("responseRunObjTypeOf.txt", gettype($runObj));
//   file_put_contents("responseRunObj.txt", $runObj);
//   file_put_contents("responseRunObjJsonSlice.txt", json_encode(array_slice($runObj,0,1)));
//   file_put_contents("responseRunObjJsonConvert.txt", json_encode($runObj));
//   file_put_contents("responseRunObjJsonConvertGetIdOnly.txt", json_encode($runObj['id']));
//   file_put_contents("responseRunObjGetIdOnly.txt", $runObj['id']);

  file_put_contents("responsePlanCreate.json", $run);

   
   

   // return the complete json that will be formated in js front end (res.id)
   echo $runJson;
   // return the payId that will be used for the frontend paypal object in the "create payment" method
   // echo $PayID;
 }
}
?>