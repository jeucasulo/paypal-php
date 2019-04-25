<?php

// echo "teste";
//parte 1
//Incluindo o arquivo que contém a função sendNvpRequest
require 'sendNvpRequest.php';
 
// Configuração de username, password e signature da conta buyer
require 'config.php';
 
//Campos da requisição da operação SetExpressCheckout, como ilustrado acima.
$requestNvp = array(
    'USER' => $user,
    'PWD' => $pswd,
    'SIGNATURE' => $signature,
 
    'VERSION' => '108.0',
    'METHOD'=> 'SetExpressCheckout',
 
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
 
    // 'RETURNURL' => 'http://127.0.0.1/ppec/nvp-soap/sucesso.php',
    'RETURNURL' => 'https://29428e7dd9774defbbde15e87e849c88.vfs.cloud9.us-east-2.amazonaws.com/PPEC-NVP/sucesso.php',
    // 'RETURNURL' => '/sucesso.php',
    'CANCELURL' => 'http://www.pudim.com.br/',
    'BUTTONSOURCE' => 'BR_EC_EMPRESA'
);
 
//Envia a requisição e obtém a resposta da PayPal
$responseNvp = sendNvpRequest($requestNvp, $sandbox);
var_dump($responseNvp) ;

$output = "";
foreach ($responseNvp as $key=>$value) {
    $output .= $key." : ".$value."\n";
}
file_put_contents("responseSetExpressCheckout.txt", $output);
file_put_contents("responseSetExpressCheckoutJson.txt", (json_encode($responseNvp)));


//Se a operação tiver sido bem sucedida, redirecionamos o cliente para o
//ambiente de pagamento.
if (isset($responseNvp['ACK']) && $responseNvp['ACK'] == 'Success') {
    $query = array(
        'cmd'    => '_express-checkout',
        'token'  => $responseNvp['TOKEN']
    );
 
    $redirectURL = sprintf('%s?%s', $paypalURL, http_build_query($query));
 
    header('Location: ' . $redirectURL);
} else {
    // echo "$responseNvp['ACK'];
    // echo "deu ruim";
    //Opz, alguma coisa deu errada.
    //Verifique os logs de erro para depuração.
}
