<?php

$sandbox = true;

if ($sandbox) {
    //credenciais da API para o Sandbox
    $user = 'jeucasulo-facilitator_api1.hotmail.com';
    $pswd = '9QWC28HW43XQ29ME';
    $signature = 'AvbrjyLw8e2V9PGT974X6JmrYVo9ATU18Gpu8LTXKr8wPSevcEl6d9sL';
 
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

?>