<?php
session_start();
session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
session_regenerate_id(true);


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
   $installments =  $_GET['installments'];
   $total = 100 + (100/$installments);
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
    
    $data = array(
   "intent" => "sale",
   "payer" => array(
     "payment_method" => "paypal"
   ),
     "application_context" => array(
      "brand_name"=>"PayPalPlus Test",
      "shipping_preference"=>"SET_PROVIDED_ADDRESS"
   ),

   "transactions" => array(
     array(
			      "amount" => array(
			        "total" => "30.04",
			        "currency" => "BRL",
			        "details" => array(
			          "subtotal" => "30.00",
			         // "tax" => "0.07",
			         //handling_fee
			          "shipping" => "1.04",
			          "shipping_discount" => "-1.00"
			         // "insurance" => "0.01" 
			         )
			      ),


       "description" => "The payment transaction description.",
       "payment_options" => array(
         "allowed_payment_method" => "IMMEDIATE_PAY"
       ),
       "item_list" => array(
         "items" => array(
           array(
             "name" => "hat",
             "description" => "Brown hat.",
             "quantity" => "5",
             "price" => "3",
             "sku" => "1",
             "currency" => "BRL"
           ),
           array(
             "name" => "handbag",
             "description" => "Black handbag.",
             "quantity" => "1",
             "price" => "15",
             "sku" => "34",
             "currency" => "BRL"
           )
         ),
         "shipping_address" =>  array(
		 "recipient_name"  =>  "Luiz Fabio Rezende Antunes",
		 "line1" =>  "Rua Sara Braune, 91",
		 "line2" =>  "Braunes",
		 "city" =>  "Nova Friburgo",
		 "country_code" =>  "BR",
		 "postal_code" =>  "28633000",
		 "state" =>  "RJ",
		 "phone" =>  "2225265283"  
		 )
       )
     )
   ),
   "note_to_payer" => "Contact us for any questions on your order.",
   "redirect_urls" => array(
     "return_url" => "https://www.amorebrasil.com.br/return",
     "cancel_url" => "https://www.amorebrasil.com.br/cancel"
   )
);

   $data = json_encode($data);
   file_put_contents('_jsonFromLuiz.json', $data);


   // $postfields = json_encode($postfields);                                                                                   

   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $paymentHeaders);
//   curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

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
   
   file_put_contents('_approval.txt',$approval);

//   $_SESSION['approval_url'] = $approval;
   $_SESSION['execute'] = $execute;
   
    


    //   echo "<script>console.log($run)</script>";
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
                // echo "<span class='text-danger'>" . $key . "</span>: " . $value, '<br>';
            }
        }
    }
    // recursive($myArray,1);
    //
    
    file_put_contents("create_payment_response.json", $run);

    echo $run;
 }
}
?>