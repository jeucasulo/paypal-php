<?php
    $token = new Token();
    // $token->createToken($importCredentials->clientId,$importCredentials->secret);
    $importCredentials = $token->getCredentials();
    
    $_POST['action'] == 'get' ? $token->getToken() : $token->createToken($importCredentials->clientId,$importCredentials->secret);
    
    // $token->getToken();
    
    class Token{
        public function getToken(){
            
            if($this->checkToken()){
                
                $file = file_get_contents('response_get_token_copy.json'); //string
                $json = json_decode($file); // decode the JSON into an associative array
    
                $now = date("Y-m-d H:i:s");
                $now2 = date("m/d/Y H:i:s a");
                $diff = abs(strtotime($now) - strtotime($json->expires_in_date));
                // $diff = abs(strtotime($json->expires_in_date) - strtotime($now2));
                // $expired = (abs(strtotime($now)>strtotime($json->expires_in_date))) ? true : false;
                $status = (strtotime($json->expires_in_date) < abs(strtotime($now)) ) ? "Expired":"Active";
                $expired = strtotime($json->expires_in_date) < abs(strtotime($now));
                
                // file_put_contents('responseDiff.txt', $diff );
                // file_put_contents('_expires_in_date', $json->expires_in_date );
                // file_put_contents('_expires_in_dateType', gettype($json->expires_in_date));
                // file_put_contents('_now_date', $now );
                // file_put_contents('_now_date2', $now2 );
                // file_put_contents('_now_date2type', gettype($now2) );
                // file_put_contents('_hasExpired', $expired );
                
                
                $expiresDate = date("m/d/Y H:i:s a", strtotime($json->expires_in_date));
                
                $diffNow = date($now2);

                
                $res->status = $status;
                $res->expired = $expired;
                $res->lifetime = gmdate("d H:i:s", (int)$diff);
                $res->access_token = $json->access_token;
                $res->token_type = $json->token_type;
                $res->nonce = $json->nonce;
                $res->app_id = $json->app_id;
                $res->expires_in = $json->expires_in_date;
                $res->created_at = $json->created_at_date;
                $res->convert_expires = strtotime($json->expires_in_date);
                $res->convert_now = abs(strtotime($now));
                $res->expired_time = gmdate("H:i:s", (int)strtotime($json->expires_in_date) - abs(strtotime($now)));
                
                if(strtotime($dateExpires) < strtotime($dateNow)){
                    $res->status = "expired";
                    $this->createToken($importCredentials->clientId,$importCredentials->secret);
                    $this->getToken();
                    
                }else{
                // 	echo "não expirou ainda";
                }
                

                echo json_encode($res);
            }else{
                $importCredentials = $this->getCredentials();
                // $this->createToken($importCredentials->clientId,$importCredentials->secret);
                // $this->getToken();
            }
        }
        public function checkToken(){
            $path = 'response_get_token_copy.json';
            return file_exists($path);
        }
        public function createToken($clientId,$secret){
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
            
            // with the array cast (array) returns an array as well
            $runObj = json_decode($run, 1);
        
            $expires = date("m/d/Y h:i:s a", time() + 32398);
            $created = date("m/d/Y h:i:s a", time());
            $token_copy = json_decode($run);
            $token_copy->created_at_date = $created;
            $token_copy->expires_in_date = $expires;
            
            file_put_contents('response_get_token_copy.json',json_encode($token_copy));
            file_put_contents('response_get_token.json', $run);
            
            header("Refresh:0");
        }
        public function getCredentials(){
            $require_credentials_path = $_SERVER['DOCUMENT_ROOT']."/Credentials/credentials.php";
            require_once($require_credentials_path);
            $credentials = new Credentials();
            $credentials->checkCredentials();
            $importCredentials = $credentials->getCredentials();
            
            return $importCredentials;
        }
    }
?>