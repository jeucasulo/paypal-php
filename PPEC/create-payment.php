<?php
session_start();

file_put_contents('minhaAction.txt',$_POST['action']);

$paypalCheckout = new PaypalCheckout();
$accessToken = $paypalCheckout->getToken();
$paypalCheckout->createPayment($accessToken);

class PaypalCheckout{

  public function getToken(){
        $path = $_SERVER['DOCUMENT_ROOT']."/TOKEN-UPDATE/response_get_token_copy.json";
        
        if(file_exists($path)){
            $file = file_get_contents($path); //string
            $json = json_decode($file); // decode the JSON into an associative array
            return $json->access_token;
        }else{
            // echo "não existe";
        }

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

// JSON FORMAT SOURCE : https://developer.paypal.com/docs/api/overview/#make-your-first-call
   $postfields = '{
      "intent": "sale",
      "redirect_urls": {
        "return_url": "https://example.com/your_redirect_url.html",
        "cancel_url": "https://example.com/your_cancel_url.html"
      },
      "payer": {
        "payment_method": "paypal"
      },
      "transactions": [{
        "amount": {
          "total": "7.47",
          "currency": "BRL"
        }
      }]
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
   file_put_contents("responseRunObjTypeOf.txt", gettype($runObj));
   file_put_contents("responseRunObj.txt", $runObj);
   file_put_contents("responseRunObjJsonSlice.txt", json_encode(array_slice($runObj,0,1)));
   file_put_contents("responseRunObjJsonConvert.txt", json_encode($runObj));
   file_put_contents("responseRunObjJsonConvertGetIdOnly.txt", json_encode($runObj['id']));
   file_put_contents("responseRunObjGetIdOnly.txt", $runObj['id']);

   // return the complete json that will be formated in js front end (res.id)
   echo $runJson;
   // return the payId that will be used for the frontend paypal object in the "create payment" method
   // echo $PayID;
 }
}
?>