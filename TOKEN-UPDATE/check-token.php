<?php
session_start();

$paypalCheckout = new PaypalCheckout();
$paypalCheckout->checkToken();

class PaypalCheckout{

  public function checkToken(){
        if(file_exists('response_token_copy.json')){
            
            $path = file_get_contents('response_token_copy.json'); //string
            $json = json_decode($path); // decode the JSON into an associative array

            $now = date("Y-m-d H:i:s");
            $diff = abs(strtotime($now) - strtotime($json->expires_in_date));
            $expired = (abs(strtotime($now)>strtotime($json->expires_in_date))) ? true : false;
            file_put_contents('responseDiff.txt', $expired );
            
            
            $res->status = "active";
            $res->expired = $expired;
            $res->lifetime = gmdate("H:i:s", (int)$diff);
            $res->access_token = $json->access_token;
            $res->token_type = $json->token_type;
            $res->nonce = $json->nonce;
            $res->app_id = $json->app_id;
            $res->expires_in = $json->expires_in;

            echo json_encode($res);

        }else{
            // "expires_in": 32398 // seconds

            date_default_timezone_set('UTC');
            
            $now = date("Y-m-d H:i:s");
            $expires = date("m/d/Y h:i:s a", time() + 32398);
            
            $diff = abs(strtotime($now) - strtotime($expires));

            $myObj->file_exist = "false";
            $myObj->error = 'no token created';
            $myObj->expires = $expires;
            $myObj->now = $now;
            $myObj->update_time = $diff/3600;
            
            $myJSON = json_encode($myObj);

            echo $myJSON;
        }
  }

}
?>