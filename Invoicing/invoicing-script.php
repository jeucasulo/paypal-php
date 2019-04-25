<?php
session_start();

$paypalCheckout = new PayPalInvoicing();

isset($_POST['create']) ? $paypalCheckout->createInvoicing() : $paypalCheckout->sendInvoicing();

class PayPalInvoicing{

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


    $accessToken = $runObj["access_token"];


    return $accessToken;
  }

  public function createInvoicing(){
    
   $accessToken = $this->getToken();
   file_put_contents('_getToken',$accessToken);


   $url = "https://api.sandbox.paypal.com/v1/invoicing/invoices/";

   $paymentHeaders = array("Content-Type: application/json", "Authorization: Bearer ".$accessToken);

// JSON FORMAT SOURCE : https://developer.paypal.com/docs/invoicing/integrate/create-and-send-invoices/#1-create-draft-invoice
   $postfields = '{
          "merchant_info": {
            "email": "jeucasulo-facilitator@hotmail.com",
            "first_name": "Jeú",
            "last_name": "Junior",
            "business_name": "Jeú Casulo",
            "phone": {
              "country_code": "055",
              "national_number": "4085551234"
            }
          },
          "billing_info": [{
            "email": "jeucasulo-buyer@hotmail.com",
            "first_name": "Stephanie",
            "last_name": "Meyers"
          }],
          "items": [{
            "name": "Zoom System wireless headphones",
            "quantity": 2,
            "unit_price": {
              "currency": "BRL",
              "value": "120"
            },
            "tax": {
              "name": "Tax",
              "percent": 8
            }
          }],
          "discount": {
            "percent": 1
          },
          "shipping_cost": {
            "amount": {
              "currency": "BRL",
              "value": "10"
            }
          },
          "note": "Thank you for your business.",
          "terms": "No refunds after 30 days."
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
   
   file_put_contents('response_invoicing.json',$run);

   echo $run;
 }
 
   public function sendInvoicing(){
     
   $accessToken = $this->getToken();

   $file = file_get_contents('response_invoicing.json'); //string
   $json = json_decode($file); // decode the JSON into an associative array
   $invoice_id = $json->id;

     
   $url = "https://api.sandbox.paypal.com/v1/invoicing/invoices/".$invoice_id."/send?notify_merchant=true?notify_customer=true";
   file_put_contents('_url',$url);

   $paymentHeaders = array("Content-Type: application/json", "Authorization: Bearer ".$accessToken);

// JSON FORMAT SOURCE : https://developer.paypal.com/docs/invoicing/integrate/create-and-send-invoices/#1-create-draft-invoice

   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $paymentHeaders);
  // curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

   curl_setopt($ch, CURLOPT_VERBOSE, 1);
   curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   curl_setopt($ch, CURLOPT_POST, true);

   $run = curl_exec($ch);

   curl_close($ch);


   echo $run;
 }

}
?>