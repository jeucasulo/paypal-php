<?php
// session_start();
// session_unset();
// session_destroy();
// session_write_close();
// setcookie(session_name(),'',0,'/');
// session_regenerate_id(true);


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
  }

  public function createPayment($accessToken){
     
    if(file_exists('REF-REST/_responseAgreementCreate.json')){ //php
    // if(file_exists('_responseAgreementCreate.json')){ //js
    $tokenAgreement->check = true;
    }else{
        $tokenAgreement->check = false;
    }
    $path = file_get_contents('_responseAgreementCreate.json') ;
    $json = json_decode($path); // decode the JSON into an associative array
    $BillingAgreementId = $json->id;
    $BillingAgreementState = $json->state;
    
    file_put_contents('_APAGARtestBA_ID.txt',$BillingAgreementId);


   $url = "https://api.sandbox.paypal.com/v1/payments/payment";

   $paymentHeaders = array("Content-Type: application/json", "Authorization: Bearer ".$accessToken);
   
   $invoiceNumber = time();
   file_put_contents('_apagarInvoiceNumber.txt', $invoiceNumber);

    $postfields = '{
      "intent": "sale",
      "application_context":
      {
        "shipping_preference":"NO_SHIPPING"  
      },
      "payer":
      {
        "payment_method": "PAYPAL",
        "funding_instruments": [
        {
          "billing":
          {
            "billing_agreement_id": "'.$BillingAgreementId.'"
          }
        }]
      },
      "transactions": [
      {
        "amount":
        {
          "currency": "BRL",
          "total": "100.00"
        },
        "description": "Payment transaction.",
        "custom": "Payment custom field.",
        "note_to_payee": "Note to payee field.",
        "invoice_number": "'.$invoiceNumber.'",
        "item_list":
        {
          "items": [
          {
            "sku": "skuitemNo1",
            "name": "ItemNo1",
            "description": "The item description.",
            "quantity": "1",
            "price": "100.00",
            "currency": "BRL"
          }]
        },
        "payment_options":
        {
            "allowed_payment_method":"IMMEDIATE_PAY"
        }
      }],
      "redirect_urls":
      {
        "return_url": "https://example.com/return",
        "cancel_url": "https://example.com/cancel"
      }
    }';
    file_put_contents('_apagarPostField',$postfields);

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


    file_put_contents("_create_payment_response.json", $run);

    echo $run;
 }
}
?>