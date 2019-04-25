<?php
    class Credentials {
        public function checkCredentials(){
                $path = __DIR__.'/credentials.json';
                if(file_exists($path)){
                    $path = file_get_contents($path) ;
                    $jsonToArray = json_decode($path); // decode the JSON into an associative array
                    $clientId = $jsonToArray->clientId;
                    $secret = $jsonToArray->secret;
                    return true;
                }else{
                    false;
                }

        }
        public function getCredentials(){
            if($this->checkCredentials()){
                //
                    $path = __DIR__.'/credentials.json';
                    if(file_exists($path)){
                        $path = file_get_contents($path) ;
                        $jsonToArray = json_decode($path); // decode the JSON into an associative array
                        // $clientId = $jsonToArray->clientId;
                        // $secret = $jsonToArray->secret;
                        // echo "ClindId: ".$clientId."<br/>";
                        // echo "Secret: ".$secret;
                        return $jsonToArray;
                    }else{
                        return "Credencial não persistida";
                    }
                //
            }
        }
    }
?>
