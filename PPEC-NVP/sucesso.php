 <style>
    body {
        background: #3f6aaf;
		font-family: 'Oswald', sans-serif;
		color: white;
		letter-spacing: 2px;
		font-size: 34px;
		top: 50%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%);
		position: absolute;
	}
	
 </style>

<?php
echo "sucesso";
// equivalente ao execute payment

//Incluindo o arquivo que contém a função sendNvpRequest
require 'sendNvpRequest.php';
// Configuração de username, password e signature da conta buyer
require 'config.php';

$token = 	$_GET["token"]; //GET de Token
$payerid = 	$_GET["PayerID"]; //GET de PayerID 
	
$requestNvp = array(
    'USER' => $user,
    'PWD' => $pswd,
    'SIGNATURE' => $signature,
 
    'VERSION' => '108.0',
    'METHOD'=> 'DoExpressCheckoutPayment',
	
    'TOKEN' => $token,
    'PAYERID' => $payerid,
	
    'PAYMENTREQUEST_0_PAYMENTACTION' => 'SALE',
    'PAYMENTREQUEST_0_AMT' => '22.00',
    'PAYMENTREQUEST_0_CURRENCYCODE' => 'BRL',
    'PAYMENTREQUEST_0_ITEMAMT' => '22.00',
     
    'L_PAYMENTREQUEST_0_NAME0' => 'Item A',
    'L_PAYMENTREQUEST_0_DESC0' => 'Produto A – 110V',
    'L_PAYMENTREQUEST_0_AMT0' => '11.00',
    'L_PAYMENTREQUEST_0_QTY0' => '1',
    'L_PAYMENTREQUEST_0_ITEMAMT' => '11.00',
    'L_PAYMENTREQUEST_0_NAME1' => 'Item B',
    'L_PAYMENTREQUEST_0_DESC1' => 'Produto B – 220V',
    'L_PAYMENTREQUEST_0_AMT1' => '11.00',
    'L_PAYMENTREQUEST_0_QTY1' => '1',
);

$responseNvp = sendNvpRequest($requestNvp, $sandbox);

$output = "";
foreach ($responseNvp as $key=>$value) {
    $output .= $key." : ".$value."\n";
}

file_put_contents("responseDoExpressCheckoutPayment.txt", $output);
file_put_contents("responseDoExpressCheckoutPaymentJson.txt", (json_encode($responseNvp)));


echo 'O ID da transação é: ' . $responseNvp['PAYMENTINFO_0_TRANSACTIONID'];

?>
