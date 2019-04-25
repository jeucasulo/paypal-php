<?php

require_once('braintree-php-3.36.0/lib/Braintree.php');


// $nonce = $_POST["payment_method_nonce"];
file_put_contents('_payment_method_nonce',$_POST['payment_method_nonce']);

$gateway = new Braintree_Gateway([
    'accessToken' => 'access_token$sandbox$phbhsn2zwh7sdppz$9ad7e4ece42a1eededab29f9566776c1',
    // 'accessToken' => 'access_token$sandbox$dw77h479hh298f2m$743f08154343522bcd2ffec590f9f8b1', //facilitator

]);


//https://articles.braintreepayments.com/wells-flat/transactions/descriptors#dynamic-descriptor-requirements
$result = $gateway->transaction()->sale([
    "amount" => $_POST['amount'],
    'merchantAccountId' => 'BRL',
    "paymentMethodNonce" => $_POST['payment_method_nonce'],
    "orderId" => $_POST['Mapped to PayPal Invoice Number'],
    "descriptor" => [
      // "name" => "Descriptor displayed in customer CC statements. 22 char max"
      "name" => "cmp*wonderful product"
    ],
    "shipping" => [
      "firstName" => "Jen",
      "lastName" => "Smith",
      "company" => "Braintree",
      "streetAddress" => "1048 Avenida Paulista",
      "extendedAddress" => "unidade 2",
      "locality" => "São Paulo",
      "region" => "SP",
      "postalCode" => "05549-210",
      "countryCodeAlpha2" => "BR"
    ],
    "options" => [
      "paypal" => [
        "customField" => $_POST["PayPal custom field"],
        "description" => $_POST["Description for PayPal email receipt"]
      ],
    ]
]);
if ($result->success) {
  print_r("Success ID: " . $result->transaction->id);
} else {
  print_r("Error Message: " . $result->message);
}

?>