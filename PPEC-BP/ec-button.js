  // creates a paypal button object
  paypal.Button.render({
    env: 'sandbox', // Or 'production'
    // Set up the payment:
    // 1. Add a payment callback
    payment: function(data, actions) {
      // 2. Make a request to your server
      // return actions.request.post('C:/laragonwww/PaypalCheckout-onclick/Teste/CreatePayment.php')
      var localhost = window.location.hostname;
      // var CREATE_URL = "http://"+localhost+"/PPEC/CreatePayment.php"; //localhost
      var CREATE_URL = "PPEC/CreatePayment.php?action=ec"; //cloud9
      
      // excute a post to the endpoint and gets the res.id from the return from the CreatePayment method
      return actions.request.post(CREATE_URL)
      // C:\laragon\www\PaypalCheckout\
      // return actions.request.post('/my-api/create-payment/')
        .then(function(res) {
          // 3. Return res.id from the response
          console.log("App.CreatePaymentResponde");
          console.log(res);// this
          document.getElementById('createPaymentId').innerHTML = "<b>PaymentId:</b> " + res.id;
          document.getElementById('createPaymentIntent').innerHTML = "<b>Intent:</b> " + res.intent;
          document.getElementById('createPaymentState').innerHTML = "<b>State:</b> " + res.state;
          document.getElementById('createPaymentPayer').innerHTML = "<b>PaymentPayer/Payment_method:</b> " + res.payer.payment_method;
          document.getElementById('createPaymentTransactions').innerHTML = "<b>Transactions(currency):</b> " + res.transactions[0].amount.currency;
          document.getElementById('createPaymentTransactions1').innerHTML = "<b>Transactions(total):</b> " + res.transactions[0].amount.total;
          document.getElementById('createCreateTime').innerHTML = "<b>Create time</b>: " + res.create_time;
          document.getElementById('createLinks0').innerHTML = "<b>Links:</b> " + res.links[0].href + " | <b>rel:</b> " + res.links[0].rel + " | <b>method:</b> " + res.links[0].method;
          document.getElementById('createLinks1').innerHTML = "<b>Links:</b> " + res.links[1].href + " | <b>rel:</b> " + res.links[1].rel + " | <b>method:</b> " + res.links[1].method;
          document.getElementById('createLinks2').innerHTML = "<b>Links:</b> " + res.links[2].href + " | <b>rel:</b> " + res.links[2].rel + " | <b>method:</b> " + res.links[2].method;
          
          // CreatePaymentJsonResponseOutput
            
            function loopingObj(object){
              for (key in object){
              var value=object[key];
              if(typeof value === 'object'){
                 console.log('{');
                // document.getElementById("CreatePaymentJsonResponseOutput").innerHTML += "{";
                 loopingObj(value);
                 console.log('}');
                // document.getElementById("CreatePaymentJsonResponseOutput").innerHTML += "}";
              }else{
                console.log(key + " : " + value);
                document.getElementById("CreatePaymentJsonResponseOutput").innerHTML += "<span class='text-danger'>"+key+"</span> : " + value + "</br>";
              }
            }
            }
              
            loopingObj(res);

          return res.id; //this 
          
        });
    },
    
    // Execute the payment:
    // 1. Add an onAuthorize callback
    onAuthorize: function(data, actions) {
      // 2. Make a request to your server
      // 
      var localhost = window.location.hostname;
      // var EXECUTE_URL = "http://"+localhost+"/PPEC/ExecutePayment.php"; // localhost
      var EXECUTE_URL = "PPEC/ExecutePayment.php"; // cloud9

      // excute a post to the endpoint then SEND the payerId and paymentId FOR
      // the the ExecutePayment method that can use it on accessing the post vars
      return actions.request.post(EXECUTE_URL, {
        paymentID: data.paymentID,
        payerID:   data.payerID
      })
        .then(function(res) {
          // print the return from the execute payment from the backend method
          console.log("App.ExecutePaymentResponde");
          console.log(res);
    
          document.getElementById('executePaymentId').innerHTML = "<b>PaymentId:</b>   " + res.id;
          document.getElementById('executePaymentCart').innerHTML = "<b>Cart:</b>   " + res.cart;
          document.getElementById('executePaymentIntent').innerHTML = "<b>Intent:</b>   " + res.intent;
          document.getElementById('executePaymentState').innerHTML = "<b>State:</b>   " + res.state;
          
          document.getElementById('executePaymentPayer').innerHTML = "<b>Payer |  Payment_method:</b>   " + res.payer.payment_method;
          
          document.getElementById('executePaymentPayerFirstName').innerHTML = "<b>Payer |  PayerInfo |  FirstName:</b>   " + res.payer.payer_info.first_name;
          document.getElementById('executePaymentPayerLastName').innerHTML = "<b>Payer |  PayerInfo |  LastName:</b>   " + res.payer.payer_info.last_name;
          document.getElementById('executePaymentPayerEmail').innerHTML = "<b>Payer |  PayerInfo |  PayerEmail:</b>   " + res.payer.payer_info.email;
          document.getElementById('executePaymentPayerPayerId').innerHTML = "<b>Payer |  PayerInfo |  PayerId:</b>   " + res.payer.payer_info.payer_id;
          document.getElementById('executePaymentPayerCountryCode').innerHTML = "<b>Payer |  PayerInfo |  CountryCode:</b>   " + res.payer.payer_info.country_code;
          
          document.getElementById('executePaymentPayerShippingCity').innerHTML = "<b>Payer |  PayerInfo |  ShippingAdress |  City:</b>   " + res.payer.payer_info.shipping_address.city;
          document.getElementById('executePaymentPayerShippingLine1').innerHTML = "<b>Payer |  PayerInfo |  ShippingAdress |  Line1:</b>   " + res.payer.payer_info.shipping_address.line1;
          document.getElementById('executePaymentPayerShippingNormalization').innerHTML = "<b>Payer |  PayerInfo |  ShippingAdress |  NormalizationStatus:</b>   " + res.payer.payer_info.shipping_address.normalization_status;
          document.getElementById('executePaymentPayerShippingPostalCode').innerHTML = "<b>Payer |  PayerInfo |  ShippingAdress |  PostalCode:</b>   " + res.payer.payer_info.shipping_address.postal_code;
          document.getElementById('executePaymentPayerShippingRecipient').innerHTML = "<b>Payer |  PayerInfo |  ShippingAdress |  RecipientName:</b>   " + res.payer.payer_info.shipping_address.recipient_name;
          document.getElementById('executePaymentPayerShippingState').innerHTML = "<b>Payer |  PayerInfo |  ShippingAdress |  State:</b>   " + res.payer.payer_info.shipping_address.state;
          
          document.getElementById('executePaymentPayerTaxId').innerHTML = "<b>Payer |  PayerInfo |  ShippingAdress |  TaxId:</b>   " + res.payer.payer_info.tax_id;
          document.getElementById('executePaymentPayerTaxIdType').innerHTML = "<b>Payer |  PayerInfo |  ShippingAdress |  TaxIdType:</b>   " + res.payer.payer_info.tax_id_type;
          
          document.getElementById('executePaymentTransactions').innerHTML = "<b>Transactions | Amount | Currency:</b>   " + res.transactions[0].amount.currency;
          document.getElementById('executePaymentTransactions1').innerHTML = "<b>Transactions | Amount |Total:</b>   " + res.transactions[0].amount.total;
          
          document.getElementById('executePaymentTransactionsItemListShippingAdressCity').innerHTML = "<b>Transactions |  ItemList |  ShippingAdress |  City:</b>   " + res.transactions[0].item_list.shipping_address.city;
          document.getElementById('executePaymentTransactionsItemListShippingAdressLine1').innerHTML = "<b>Transactions |  ItemList |  ShippingAdress |  Line1:</b>   " + res.transactions[0].item_list.shipping_address.line1;
          document.getElementById('executePaymentTransactionsItemListShippingAdressNormalization').innerHTML = "<b>Transactions |  ItemList |  ShippingAdress |  NormalizationStatus:</b>   " + res.transactions[0].item_list.shipping_address.normalization_status;
          document.getElementById('executePaymentTransactionsItemListShippingAdressPostalCode').innerHTML = "<b>Transactions |  ItemList |  ShippingAdress |  PostalCode:</b>   " + res.transactions[0].item_list.shipping_address.postal_code;
          document.getElementById('executePaymentTransactionsItemListShippingAdressRecipient').innerHTML = "<b>Transactions |  ItemList |  ShippingAdress |  RecipientName:</b>   " + res.transactions[0].item_list.shipping_address.recipient_name;
          document.getElementById('executePaymentTransactionsItemListShippingAdressState').innerHTML = "<b>Transactions |  ItemList |  ShippingAdress |  State:</b>   " + res.transactions[0].item_list.shipping_address.state;

          document.getElementById('executePaymentTransactionsPayeeEmail').innerHTML = "<b>Transactions |  Payee |  Email:</b>   " + res.transactions[0].payee.email;
          document.getElementById('executePaymentTransactionsPayeeMerchantId').innerHTML = "<b>Transactions |  Payee |  MerchantId:</b>   " + res.transactions[0].payee.merchant_id;

          
          document.getElementById('executeCreateTime').innerHTML = "<b>Create time</b>  : " + res.create_time;
          document.getElementById('executeLinks0').innerHTML = "<b>Links:</b>   " + res.links[0].href + " | <b>rel:</b>   " + res.links[0].rel + " | <b>method:</b>   " + res.links[0].method;          // document.getElementById('executeLinks1').innerHTML = "<b>Links:</b> " + res.links[1].href + " | <b>rel:</b> " + res.links[1].rel + " | <b>method:</b> " + res.links[1].method;
          // document.getElementById('executeLinks2').innerHTML = "<b>Links:</b> " + res.links[2].href + " | <b>rel:</b> " + res.links[2].rel + " | <b>method:</b> " + res.links[2].method;

            function loopingObj(object){
              for (key in object){
              var value=object[key];
              if(typeof value === 'object'){
                 console.log('{');
                 loopingObj(value);
                 console.log('}');
              }else{
                console.log(key + " : " + value);
                document.getElementById("ExecutePaymentJsonResponseOutput").innerHTML += "<span class='text-danger'>"+key+"</span> : " + value + "</br>";

              }
            }
            }
              
            loopingObj(res);
              
  
  
  
  
  
          
        });
    }
  }, '#paypal-button');
