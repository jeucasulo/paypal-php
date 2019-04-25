<?php
$clientId = $_POST['clientId'];
$secret = $_POST['secret'];
$appName = $_POST['appName'];
$sandboxAccount = $_POST['sandboxAccount'];

$paypalCheckout = new PaypalCheckout();
$paypalCheckout->SetCredentials($clientId,$secret,$appName,$sandboxAccount);

class PaypalCheckout{

  public function SetCredentials($clientId,$secret,$appName,$sandboxAccount){
      $credentials->clientId = $clientId;
      $credentials->secret = $secret;
      $credentials->appName = $appName;
      $credentials->sandboxAccount = $sandboxAccount;
      file_put_contents("credentials.json", json_encode($credentials));
      echo json_encode($credentials);
  }


}
?>