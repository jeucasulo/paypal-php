<?php
session_start();
// echo "foi";
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

    curl_close($ch);

  // with the array cast (array) returns an array as well
    $runObj = json_decode($run, 1);

    $_SESSION["access_token"] = $runObj["access_token"];
    $accessToken = $runObj["access_token"];

    return $accessToken;
  }

  public function createPayment($accessToken){
   $url = "https://api.sandbox.paypal.com/v1/payments/payment";

   $paymentHeaders = array("Content-Type: application/json", "Authorization: Bearer ".$accessToken);


 
    $postfields = '{
           "intent":"sale",
           "redirect_urls":{
              "return_url":"www.sometest.com/success",
              "cancel_url":"www.sometest.com/cancel"
           },
           "payer":{
              "payment_method":"paypal"
           },
           "application_context":{
              "brand_name":"PayPalPlus Test",
              "shipping_preference":"NO_SHIPPING"
           },
           "transactions":[
              {
                 "amount":{
                    "total":"101.00",
                    "currency":"BRL",
                    "details":{
                       "subtotal":"101.00"
                    }
                 },
            "description":"Order From Test.com",
            "payment_options":{
            "allowed_payment_method":"IMMEDIATE_PAY"
                 },
                 "item_list":{
                    "items":[
                       {
                          "name":"God Of War",
                          "description":"God Of War ps4",
                          "quantity":1,
                          "price":"101.00",
                          "sku":"#33",
                          "currency":"BRL"
                       }
                    ]
                 }
              }
           ]
        }';


   // $postfields = json_encode($postfields);                                                                                   

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

   $runObj = json_decode($run);

   $approval = $runObj->links[1]->href;
   $execute = $runObj->links[2]->href;

   $_SESSION['approval_url'] = $approval;
   $_SESSION['execute'] = $execute;

  echo "<script>console.log($run)</script>";
    

    

    $myArray = json_decode($run,1);


    //
    function recursive($array, $level = 1){
        foreach($array as $key => $value){
            //If $value is an array.
            if(is_array($value)){
                //We need to loop through it.
                recursive($value, $level + 1);
            } else{
                //It is not an array, so print it out.
                echo "<span class='text-danger'>" . $key . "</span>: " . $value, '<br>';
            }
        }
    }
    recursive($myArray,1);
    //

 }

 

}
?>