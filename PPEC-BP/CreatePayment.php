<?php
session_start();


$paypalCheckout = new PaypalCheckout();
$accessToken = $paypalCheckout->getToken();
$paypalCheckout->createPayment($accessToken);




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
    file_put_contents("createPaymentResponse.txt", $run);


    $_SESSION["access_token"] = $runObj["access_token"];
    $accessToken = $runObj["access_token"];
    
    return $accessToken;
  }

  public function createPayment($accessToken){
   $url = "https://api.sandbox.paypal.com/v1/payments/payment";

   $paymentHeaders = array("Content-Type: application/json", "Authorization: Bearer ".$accessToken);

//   $postfields = array (
//      'intent' => 'sale',
//      'redirect_urls' => 
//      array (
//       'return_url' => 'https://example.com/your_redirect_url.html',
//       'cancel_url' => 'https://example.com/your_cancel_url.html',
//      ),
//      'payer' => 
//      array (
//       'payment_method' => 'paypal',
//      ),
//      'transactions' => 
//      array (
//       0 => 
//       array (
//          'amount' => 
//          array (
//           'total' => '7.47',
//           'currency' => 'BRL',
//          ),
//       ),
//      ),
//   );
//   $postfields = json_encode($postfields);

   $postfields = '{  
   "intent":"sale",
   "redirect_urls":{  
      "return_url":"https://example.com/your_redirect_url.html",
      "cancel_url":"https://example.com/your_cancel_url.html"
   },
   "payer":{  
      "payment_method":"paypal"
   },
   "transactions":{  
      "amount":{  
         "total":"7.47",
         "currency":"BRL"

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

   // $PayID = "{\"id\":" . json_encode($runObj["id"]). "}";//this
   $PayID = json_encode(array_slice($runObj,0,1)); //get the PayId from json, where 0 is start and 1 is lenght
   $runJson = json_encode($runObj);
   
   // writes the create payment response for checking purposes
   file_put_contents("createPaymentResponse.txt", $run);
   file_put_contents("runObjTypeOf.txt", gettype($runObj));
   file_put_contents("runObj.txt", $runObj);
   file_put_contents("runObjJsonSlice.txt", json_encode(array_slice($runObj,0,1)));
   file_put_contents("runObjJsonConvert.txt", json_encode($runObj));
   file_put_contents("runObjJsonConvertGetIdOnly.txt", json_encode($runObj['id']));
   file_put_contents("runObjGetIdOnly.txt", $runObj['id']);
    
    
    

   
   // return the complete json that will be formated in js front end (res.id)
   echo $runJson;
   // return the payId that will be used for the frontend paypal object in the "create payment" method
   // echo $PayID;
 }
}
?>