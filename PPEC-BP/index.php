<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <title>Paypal Checkout</title>
  
  
  

  
</head>
<body>
<?php
  // require_once('oauth');
?>
  <div id="" class="container">
    <div id="" class="row">
      <div id="" class="col">
        <h1 class="text-center">PaypalCheckout</h1>


      </div>
    </div>
  </div>
  <hr>
  <div id="" class="container">
    <div id="" class="row">
    
      <div id="" class="col">
        <!-- paypalbutton -->
        <h1 class="text-center"><div id="paypal-button"></div></h1>

      </div>
    </div>
  </div>
  
  <div id="" class="container">
    <div id="" class="row">
      <div id="" class="col-md-4">
        <div class=""><input type="checkbox" name="toggleCreatePaymentResponse" id="toggleCreatePaymentResponse" value="teste"/><label for="toggleCreatePaymentResponse">Create Payment Response</label></div>
        <div class=""><input type="checkbox" name="toggleCreatePaymentJsonResponse" id="toggleCreatePaymentJsonResponse" value="teste"/><label for="toggleCreatePaymentJsonResponse">Create Payment Response (Json)</label></div>
        <div class=""><input type="checkbox" name="toggleExecutePaymentResponse" id="toggleExecutePaymentResponse" value="teste"/><label for="toggleExecutePaymentResponse">Execute Payment Response</label></div>
        <div class=""><input type="checkbox" name="toggleExecutePaymentJsonResponse" id="toggleExecutePaymentJsonResponse" value="teste"/><label for="toggleExecutePaymentJsonResponse">Execute Payment Response (Json)</label></div>
      </div>
      
      <div id="" class="col-md-8">
        
        
        
        
          <div id="CreatePaymentResponse" class="">
            

            <h3 class="title text-muted">Create Payment Response</h3>
            <p id="createPaymentId"></p>
            <p id="createPaymentIntent"></p>
            <p id="createPaymentState"></p>
            <p id="createPaymentPayer"></p>
            <p id="createPaymentTransactions"></p>
            <p id="createPaymentTransactions1"></p>
            <p id="createCreateTime"></p>
            <p id="createLinks0"></p>
            <p id="createLinks1"></p>
            <p id="createLinks2"></p>
          </div>
          
          <div id="CreatePaymentJsonResponse">
            <h3 class="title text-muted">Create Payment Response (Json)</h3>
            <div id="CreatePaymentJsonResponseOutput"></div>
          </div>
          
        <div id="ExecutePaymentResponse">
          <h3 class="title text-muted">Execute Payment Response</h3>
          <p id="executePaymentId"></p>
          <p id="executePaymentCart"></p>
          <p id="executePaymentIntent"></p>
          <p id="executePaymentState"></p>
          
          <p id="executePaymentPayer"></p>
          
          <p id="executePaymentPayerFirstName"></p>
          <p id="executePaymentPayerLastName"></p>
          <p id="executePaymentPayerEmail"></p>
          <p id="executePaymentPayerPayerId"></p>
          <p id="executePaymentPayerCountryCode"></p>
          
          <p id="executePaymentPayerShippingCity"></p>
          <p id="executePaymentPayerShippingLine1"></p>
          <p id="executePaymentPayerShippingNormalization"></p>
          <p id="executePaymentPayerShippingPostalCode"></p>
          <p id="executePaymentPayerShippingRecipient"></p>
          <p id="executePaymentPayerShippingState"></p>
          
          <p id="executePaymentPayerTaxId"></p>
          <p id="executePaymentPayerTaxIdType"></p>
          
          <p id="executePaymentTransactions"></p>
          <p id="executePaymentTransactions1"></p>
          <p id="executePaymentTransactionsItemListShippingAdressCity"></p>
          <p id="executePaymentTransactionsItemListShippingAdressLine1"></p>
          <p id="executePaymentTransactionsItemListShippingAdressNormalization"></p>
          <p id="executePaymentTransactionsItemListShippingAdressPostalCode"></p>
          <p id="executePaymentTransactionsItemListShippingAdressRecipient"></p>
          <p id="executePaymentTransactionsItemListShippingAdressState"></p>
          
          <p id="executePaymentTransactionsPayeeEmail"></p>
          <p id="executePaymentTransactionsPayeeMerchantId"></p>
          
          <p id="executeCreateTime"></p>
          <p id="executeLinks0"></p>
        </div>
        
        <div id="ExecutePaymentJsonResponse">
          <h3 class="title text-muted">ExecutePaymentJsonResponse</h3>
          <div id="ExecutePaymentJsonResponseOutput"></div>

        </div>



        
      </div>

    </div>
    

  </div>



<br>

  <div id="" class="container">
    <div id="" class="row">
    
      <div id="" class="col">
      </div>
      
      <div id="" class="col">

      </div>

    </div>
  </div>
  
    <div id="" class="container">
    <div id="" class="row">
    
      <div id="" class="col">


      </div>
      
      <div id="" class="col">
        

      </div>

    </div>
  </div>





<script src="PPEC/jquery-3.3.1.min.js"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<!--<div id="containerControllers">-->
  
<!--</div>-->





<script src="PPEC/ec-button.js"></script>
  
<!-- paypalbutton -->


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<script>
  $(document).ready(function(){
    $("#CreatePaymentResponse").hide();
    $("#CreatePaymentJsonResponse").hide();
    $("#ExecutePaymentResponse").hide();
    $("#ExecutePaymentJsonResponse").hide();
    // console.log("teste");
    
    $('#toggleCreatePaymentResponse').change(function() {
    // if($(this).is(":checked")) {
        //var returnVal = confirm("Are you sure?");
        //$(this).attr("checked", returnVal);
        $("#CreatePaymentResponse").toggle(1000);
    // }
    // $('#textbox1').val($(this).is(':checked'));        
    });
    $('#toggleCreatePaymentJsonResponse').change(function() {
    // if($(this).is(":checked")) {
        //var returnVal = confirm("Are you sure?");
        //$(this).attr("checked", returnVal);
        $("#CreatePaymentJsonResponse").toggle(1000);
    // }
    // $('#textbox1').val($(this).is(':checked'));        
    });
    
    $('#toggleExecutePaymentResponse').change(function() {
    // if($(this).is(":checked")) {
        //var returnVal = confirm("Are you sure?");
        //$(this).attr("checked", returnVal);
        $("#ExecutePaymentResponse").toggle(1000);
    // }
    // $('#textbox1').val($(this).is(':checked'));        
    });

    $('#toggleExecutePaymentJsonResponse').change(function() {
    // if($(this).is(":checked")) {
        //var returnVal = confirm("Are you sure?");
        //$(this).attr("checked", returnVal);
        $("#ExecutePaymentJsonResponse").toggle(1000);
    // }
    // $('#textbox1').val($(this).is(':checked'));        
    });
    
    


    
    
  });
</script>
</body>
</html>


<style type="text/css">
  #CreatePaymentResponse, #ExecutePaymentResponse, #CreatePaymentJsonResponseOutput, #ExecutePaymentJsonResponseOutput{
    /*color: red;*/
    font-size: 10pt;

  }

</style>