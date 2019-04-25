<?php
session_start();

$baid = $_POST['baid'];

$paypalCheckout = new PaypalCheckout();
$accessToken = $paypalCheckout->getToken();


isset($_POST['list'])?$paypalCheckout->getList($baid,$accessToken):$paypalCheckout->getDetails($baid);

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

    // file_put_contents("responseGetToken.txt", $run);

    return $accessToken;
  }

  public function getList($baid,$accessToken){
      file_put_contents('getListCallStart.txt',$accessToken);
      //   $nextIndex = $_POST['nextIndex'];

//   $url = "https://api.sandbox.paypal.com/v1/payments/billing-agreements/I-GRYYCJ8RK3UX/transactions?start_date=2018-12-01&end_date=2019-06-30";
   $url = "https://api.sandbox.paypal.com/v1/payments/billing-agreements/".$baid."/transactions?start_date=2018-12-01&end_date=2019-06-30";
//   file_put_contents("responseURL.txt", $url);
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

   // return the complete json that will be formated in js front end (res.id)
   echo $runJson;
   // return the payId that will be used for the frontend paypal object in the "create payment" method
   // echo $PayID;
 }
 
 public function getDetails($baid){
file_put_contents('getDetails.txt', $baid);
// $payId = $_POST['id'];
   $payId = $id;
   
   $accessToken = $this->getToken();

//   $url = "https://api.sandbox.paypal.com/v1/payments/payment/PAY-4TN94532BT647290YLQTLZ2Q";
//   $url = "https://api.sandbox.paypal.com/v1/payments/payment/".$baid."";
//   $url = "https://api.sandbox.paypal.com/v1/payments/billing-agreements/I-B9YGA4SRLBX3";
   $url = "https://api.sandbox.paypal.com/v1/payments/billing-agreements/".$baid;
//   $url = "https://api.sandbox.paypal.com/v1/payments/payment/PAY-0US81985GW1191216KOY7OXA ";

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

   // return the complete json that will be formated in js front end (res.id)
   echo $runJson;
   // return the payId that will be used for the frontend paypal object in the "create payment" method
   // echo $PayID;

 }
}
?>