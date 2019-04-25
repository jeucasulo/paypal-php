<?php
//Incluindo o arquivo que contém a função sendNvpRequest
require 'sendNvpRequest.php';
 
//Vai usar o Sandbox, ou produção?
$sandbox = true;
 
//Baseado no ambiente, sandbox ou produção, definimos as credenciais
//e URLs da API.
if ($sandbox) {
    //credenciais da API para o Sandbox
    // $user = 'renan-is-receiving_api1.baybal.co.uk';
    $user = 'jeucasulo-facilitator_api1.hotmail.com';
    // $pswd = 'JJ9K59CVPNNEATW5';
    $pswd = 'L55PLVN5RXBSJ3PF';
    // $signature = 'ASTSMGONs6t5ibcRNYLrqVQAL3rVAeaHP82yHPtSB5wnMq.3t2ky8aOX';
    $signature = 'ADT2nP.zOpA-lKvHkzG4tYEodltNAYxK2l7OfewaxdLBUwuLj46pGdcO';
 
    //URL da PayPal para redirecionamento, não deve ser modificada
    $paypalURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
} else {
    //credenciais da API para produção
    $user = 'usuario';
    $pswd = 'senha';
    $signature = 'assinatura';
 
    //URL da PayPal para redirecionamento, não deve ser modificada
    $paypalURL = 'https://www.paypal.com/cgi-bin/webscr';
}
 
//Campos da requisição da operação SetExpressCheckout, como ilustrado acima.
$requestNvp = array(
    'USER' => $user,
    'PWD' => $pswd,
    'SIGNATURE' => $signature,
 
    'VERSION' => '114.0',
    'METHOD'=> 'SetExpressCheckout',
 
    'PAYMENTREQUEST_0_PAYMENTACTION' => 'SALE',
    'PAYMENTREQUEST_0_AMT' => '22.00',
    'PAYMENTREQUEST_0_CURRENCYCODE' => 'BRL',
    'PAYMENTREQUEST_0_ITEMAMT' => '22.00',
    'PAYMENTREQUEST_0_INVNUM' => '1234',
 
    'L_PAYMENTREQUEST_0_NAME0' => 'Item A',
    'L_PAYMENTREQUEST_0_DESC0' => 'Produto A – 110V',
    'L_PAYMENTREQUEST_0_AMT0' => '11.00',
    'L_PAYMENTREQUEST_0_QTY0' => '1',
    'L_PAYMENTREQUEST_0_ITEMAMT' => '11.00',
    'L_PAYMENTREQUEST_0_NAME1' => 'Item B',
    'L_PAYMENTREQUEST_0_DESC1' => 'Produto B – 220V',
    'L_PAYMENTREQUEST_0_AMT1' => '11.00',
    'L_PAYMENTREQUEST_0_QTY1' => '1',

    'HDRIMG' => 'https://www.paypal-brasil.com.br/desenvolvedores/wp-content/uploads/2014/04/hdr.png',
    'LOCALECODE' => 'pt_BR',
 
    'RETURNURL' => 'http://127.0.0.1/ppec/',
    'CANCELURL' => 'http://PayPalPartner.com.br/CancelaFrete',
    'BUTTONSOURCE' => 'BR_EC_EMPRESA'
);
 
//Envia a requisição e obtém a resposta da PayPal
$responseNvp = sendNvpRequest($requestNvp, $sandbox);
 
//Se a operação tiver sido bem sucedida, redirecionamos o cliente para o
//ambiente de pagamento.
if (isset($responseNvp['ACK']) && $responseNvp['ACK'] == 'Success') {
    $query = array(
        'cmd'    => '_express-checkout',
        'token'  => $responseNvp['TOKEN']
    );
 
    $redirectURL = sprintf('%s?%s', $paypalURL, http_build_query($query));
 
    printf("Location: %s\n", $redirectURL);
} else {
    //Opz, alguma coisa deu errada.
    //Verifique os logs de erro para depuração.
}
