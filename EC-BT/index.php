<div>
    <div id="paypal-button"></div>
    
    
    
<!--// Be sure to have PayPal's checkout.js library and the Braintree client and PayPal checkout scripts loaded on your page.-->
 <script src="https://www.paypalobjects.com/api/checkout.js" data-version-4></script>
 <script src="https://js.braintreegateway.com/web/3.39.0/js/client.min.js"></script>
 <script src="https://js.braintreegateway.com/web/3.39.0/js/paypal-checkout.min.js"></script>
 
 
<!--access_token$sandbox$phbhsn2zwh7sdppz$9ad7e4ece42a1eededab29f9566776c1-->

<?php
require_once('EC-BT/braintree-php-3.36.0/lib/Braintree.php');
$gateway = new Braintree_Gateway([
    'accessToken' => 'access_token$sandbox$phbhsn2zwh7sdppz$9ad7e4ece42a1eededab29f9566776c1',
    // 'accessToken' => 'access_token$sandbox$dw77h479hh298f2m$743f08154343522bcd2ffec590f9f8b1', //facilitator
]);
echo('<span id="clientToken">'.$clientToken = $gateway->clientToken()->generate().'</span>');

?>

<script>
let clientToken = document.getElementById('clientToken').innerHTML;
// alert(clientToken); // clientTokenTestOk
paypal.Button.render({
  braintree: braintree,
  client: {
    production: 'CLIENT_TOKEN_FROM_SERVER',
    sandbox: clientToken
  },
  env: 'sandbox', // Or 'sandbox'
  commit: true, // This will add the transaction amount to the PayPal button

  payment: function (data, actions) {
    return actions.braintree.create({
      flow: 'checkout', // Required
      amount: 10.00, // Required
      currency: 'BRL', // Required
      enableShippingAddress: true,
      shippingAddressEditable: false,
      shippingAddressOverride: {
        recipientName: 'Teste',
        line1: '1048 Avenida Paulista',
        line2: 'unidade 2',
        city: 'São Paulo',
        countryCode: 'BR',
        postalCode: '05549-210',
        state: 'SP',
        phone: '11988887777'
      }
    });
  },

  onAuthorize: function (payload) {
      console.log(payload);
    // Submit `payload.nonce` to your server.
    
        $.ajax({
        // url: "execute-payment.php",// localhost
        url: "EC-BT/script.php",// cloud9
        type: "POST",
        // dataType: "json", //error dataType since the callback response isnt a json
        // timeout: 10000, //error timeout when it delays
        // data: JSON.stringify(reqs),
        data: {
          "payment_method_nonce": payload.nonce,
          "amount": "10.00"
        },
      	}).done(function(data, textStatus, jqxhr) {
      	    console.log(data);
      	    console.log("App.SubmitNonce.Done");
      	}).fail(function(jqxhr, textStatus, errorThrown) {
      	    console.log(jqxhr);
      	    console.log(textStatus);
      	    console.log(errorThrown);
      	    console.log("App.SubmitNonce.Fail");
      	});


    

  },
}, '#paypal-button');
</script>
</div>


