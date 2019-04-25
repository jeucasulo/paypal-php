<?php
$token = new Token();
$token->getToken();

class Token {

    public function getToken(){
        
        $clientId = "AdYLZtwY8zHLgVLR7uawFMLHXWT-jswUL0jnyZJAIfjjYzsWfR9mxHhKQaAcDR409oZmujTDAh207JJI";
        $secret = "EA1M8eQy2L81475BiOGvH2ioxMe5A7fAGj5oC1ODG5--yd49c4mIab5dwZDoeIuYbvh7w3GznoHTqOjT";

        $endpoint = "https://api.sandbox.paypal.com/v1/oauth2/token";

        $headers = array( "Accept"=>"application/json",
          "Accept-Language"=>"en_US",
          "Content-Type"=>"application/x-www-form-urlencoded",
        );
        $postfields = "grant_type=client_credentials";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
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
        
        file_put_contents('_getToken.json', $run);
        
        $runObj = json_decode($run, 1);

        return $runObj['access_token'];
    }
}
?>