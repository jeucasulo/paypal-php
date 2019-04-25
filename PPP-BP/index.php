
    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- ppp -->
    <script
        src="https://www.paypalobjects.com/webstatic/ppplusdcc/ppplusdcc.min.js"
        type="text/javascript">
    </script>
  


    <div class="container">
        <div class="row">
            <div class="col">
                <center>
                    <button class="btn btn-primary" onclick="generateCC()">Generate New Credit Card</button>
                </center>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <center>
                    <label id="lastCC" style='border: 1px solid black'>4826580432389372</label>
                </center>
            </div>
        </div>
    </div>

<script>
function generateCC(){
    let cc = Math.floor(Math.random() * 9);
	let myArray = ['4799108266367836','4867474260376562','4290274793437551','4431609966844366','4121125264725327','5206920395319221','5558516155761455','5357039238638478','5452153329399926','5224731104766752'];
    let newCC = myArray[cc]; 
    let lastCC = document.getElementById('lastCC').textContent;
    
    if(newCC == lastCC){
        newCC = myArray[cc+1];
    } else{
		//console.log("Valores diferentes\nlast: "+lastCC+"\nnew: "+newCC);
    }
    document.getElementById('lastCC').innerHTML = newCC;
}
</script>



    
    


    <!-- Create a HTML DIV on your checkout page where the iFrame will be embedded -->
    <div id="ppplusDiv"> </div>


    <div class="container">
        <div class="row">
            <div class="col">
                <center>
                    <button
                        type="submit"
                        id="continueButton"
                        onclick="ppp.doContinue(); return false;" class="btn btn-success btn-lg btn-block"> Checkout
                    </button>
                </center>
            </div>
        </div>
    </div>
    
    <br>
    

<div class="container">
    <div id="row">
        <div id="col">
            <div>
                <center><button id="showCreatePaymentDiv" class="btn btn-default btn-lg btn-block">Show Create Payment Response</button></center>
            </div>
        </div>
    </div>

    <div id="createPaymentOutput" class="row">
        <div class="col">
            <?php 
                require_once('create-payment.php');
            ?>
        </div>
    </div>
</div>





    <!-- Render the PayPal Plus iFrame using the following Javascript example -->
    <script type="application/javascript">
    var approval_url = "<?php echo $_SESSION['approval_url']; ?>";

    var ppp = PAYPAL.apps.PPP(
    {
    "approvalUrl": approval_url,
    "placeholder": "ppplusDiv",
    "mode": "sandbox",
    "payerFirstName": "Jeu",
    "payerLastName": " Junior",
    "payerPhone": " customerPhone",
    "payerTaxId": " 35666171801",
    "payerTaxIdType": "BR_CPF",
    "language": "pt_BR",
    "country": "BR",
    "rememberedCards": "customerRememberedCardHash",
    // custom
    "payerEmail": "jeucasulo@hotmail.com",
    // "merchantInstallmentSelectionOptional": "true",
    // "merchantInstallmentSelection": "6",
    "css": {
        "pppTextInput": {
            "background-color": "#000000",
            "color": "red",
            "border-color": "#bbc",
            "border-width": "1px",
            "font-size": "15px",
            "font-family": "Arial",
            "font-style": "normal"
            
        },
        "pppDropdown": {
            "background-color": "#000000",
            "color": "rgb(80, 80, 80)",
            "border-color": "#bbc",
            "border-width": "1px",
            "font-size": "15px",
            "font-family": "Arial",
            "font-style": "normal",
            "color": "red"

        },
        "pppDropdownHover": {
            "background-color": "#000000",
            "color": "rgb(80, 80, 80)",
            "border-color": "#bbc",
            "border-width": "1px",
            "font-size": "15px",
            "font-family": "Arial",
            "font-style": "normal"
        },
        "pppDropdownMenu": {
            "background-color": "#000000",
            "color": "#505050",
            "font-size": "15px",
            "min-width": "0px"
        },
        "pppLabel": {
            "color": "#505050",
            "font-size": "15px",
            "font-family": "Arial",
            "font-style": "italic",
          
        },
        "pppPrivacyPolicyLabel": {
            "color": "#505050",
            "font-size": "14px",
            "font-family": "Arial",
            "font-style": "italic"
        },
        "pppCheckboxLabel": {
            "color": "#505050",
            "font-size": "13px",
            "font-family": "Arial",
            "font-style": "italic"
        },
        "pppAlertMessage": {
            "background-color": "#000000",
            "color": "rgb(255, 0, 0)",
            "border-color": "#700",
            "border-width": "1px",
            "font-size": "13px",
            "font-family": "Arial",
            "font-style": "normal"
        },
        "pppErrorFields": {
            "border-color": "#d00"
        }
    }

    }



    );
    </script>
    <!-- Render the PayPal Plus iFrame using the following Javascript example -->





<div class="container">
    <div id="row">
        <div id="col">
            <div>
                <center><button id="showExecutePaymentDiv" class="btn btn-default btn-lg btn-block">Show Execute Payment Response</button></center>
            </div>
        </div>
    </div>

    <div id="row">
        <div id="col">
            <div id="executePaymentOutput"></div>
        </div>
    </div>
</div>




<!-- For PayPal Plus iFrame interaction, you will need to implement a client-side Javascript
listener that will receive every postMessage() from PayPal Plus application.
 -->
    <script>
        if (window.addEventListener) {
            window.addEventListener("message", receiveMessage, false);
            console.log("addEventListener successful", "debug");
        } else if (window.attachEvent) {
            window.attachEvent("onmessage", receiveMessage);
            console.log("attachEvent successful", "debug");
        } else {
            console.log("Could not attach message listener", "debug");
            throw new Error("Can't attach message listener");
        }

        function receiveMessage(event) {

            console.log("receiveMessage");
            try {
                var message = JSON.parse(event.data);
                if (typeof message['cause'] !== 'undefined') { //iFrame error handling
                    ppplusError = message['cause'].replace(/['"]+/g, ""); //log & attach this error into the order if possible
                    // <<Insert Code Here>>
                    switch (ppplusError) {
                        case "INTERNAL_SERVICE_ERROR": //javascript fallthrough
                        case "SOCKET_HANG_UP": //javascript fallthrough
                        case "socket hang up": //javascript fallthrough
                        case "connect ECONNREFUSED": //javascript fallthrough
                        case "connect ETIMEDOUT": //javascript fallthrough
                        case "UNKNOWN_INTERNAL_ERROR": //javascript fallthrough
                        case "fiWalletLifecycle_unknown_error": //javascript fallthrough
                        case "Failed to decrypt term info": //javascript fallthrough
                        case "RESOURCE_NOT_FOUND": //javascript fallthrough
                        case "INTERNAL_SERVER_ERROR":
                            alert("Ocorreu um erro inesperado, por favor tente novamente."); //pt_BR
                            //Generic error, inform the customer to try again; generate a new approval_url and reload the iFrame.
                            // <<Insert Code Here>>
                            break;
                        case "RISK_N_DECLINE": //javascript fallthrough
                        case "NO_VALID_FUNDING_SOURCE_OR_RISK_REFUSED": //javascript fallthrough
                        case "TRY_ANOTHER_CARD": //javascript fallthrough
                        case "NO_VALID_FUNDING_INSTRUMENT":
                            alert("Seu pagamento não foi aprovado. Por favor utilize outro cartão, caso o problema persista entre em contato com o PayPal (0800-047-4482)."); //pt_BR
                            //Risk denial, inform the customer to try again; generate a new approval_url and reload the iFrame.
                            // <<Insert Code Here>>
                            break;
                        case "CARD_ATTEMPT_INVALID":
                            alert("Ocorreu um erro inesperado, por favor tente novamente."); //pt_BR
                            //03 maximum payment attempts with error, inform the customer to try again; generate a new approval_url and reload the iFrame.
                            // <<Insert Code Here>>
                            break;
                        case "INVALID_OR_EXPIRED_TOKEN":
                            alert("A sua sessão expirou, por favor tente novamente."); //pt_BR
                            //User session is expired, inform the customer to try again; generate a new approval_url and reload the iFrame.
                            // <<Insert Code Here>>
                            break;
                        case "CHECK_ENTRY":
                            alert("Por favor revise os dados de Cartão de Crédito inseridos."); //pt_BR
                            //Missing or invalid credit card information, inform your customer to check the inputs.
                            // <<Insert Code Here>>
                            break;
                        default: //unknown error & reload payment flow
                            alert("Ocorreu um erro inesperado, por favor tente novamente."); //pt_BR
                            //Generic error, inform the customer to try again; generate a new approval_url and reload the iFrame.
                            // <<Insert Code Here>>
                    }
                }
                if (message['action'] == 'checkout') { //PPPlus session approved, do logic here
                    var rememberedCard = null;
                    var payerID = null;
                    var installmentsValue = null;
                    rememberedCard = message['result']['rememberedCards']; //save on user BD record
                    payerID = message['result']['payer']['payer_info']['payer_id']; //use it on executePayment API
                    if ("term" in message) {
                        installmentsValue = message['result']['term']['term']; //installments value
                    } else {
                        installmentsValue = 1; //no installments
                    }
                    
                    
                    /* Next steps:
                    1) Save the rememberedCard value on the user record on your Database.
                    2) Save the installmentsValue value into the order (Optional).
                    3) Call executePayment API using payerID value to capture the payment.
                    */
                    // <<Insert Code Here>>
                    
                    var reqs = { "payer_id": payerID };
                    // var executeURL = window.location.hostname+"/Paypal/PPP2/create-payment.php";
                    var executeURL = "execute-payment.php";
                    console.log("execute:" +executeURL);
                    console.log("payerId: " +payerID);


                    // $.ajax({
                    //   url: executeURL,
                    //   type: 'POST',
                    //   // beforeSend: function(xhr) {
                    //   //   xhr.setRequestHeader('Content-Type', 'application/json');
                    //   //   xhr.setRequestHeader('Authorization', "Bearer " + "A21AAFZg5UQm1UoPVv-xhmLLwKBYqfjp0BUHwd4DHuWLcYH_DCh80zRD9hnx7X3kdXRzCnCYUM84thKEO0CX0HCzUWbANCW-g");
                    //   // },
                    //   dataType: 'json',
                    //   // data: JSON.stringify(reqs),
                    //   data: reqs,

                    //     success: function(response){
                    //       var state = response.transactions['0'].related_resources['0'].sale['state'];          
                    //       if (state == 'completed') {
                    //         alert("Payment successfuly agreed!");
                    //         console.log(response);
                    //         window.location = "./success";
                    //       }
                    //     },

                    //     error: function(err){
                    //       //result.text(JSON.stringify(err, null, 4));
                    //       console.log("Erro");
                    //       console.log(err);
                    //     }
                    //   });
                
                    console.log("App.ConsoleApp");
                    let executePaymentOutput = "";
                    //LOOPING CONSOLE
                    function loopingObj(object){
                        for (key in object){
                          var value=object[key];
                          if(typeof value === 'object'){
                             console.log('{');
                             loopingObj(value);
                             console.log('}');
                          }else{
                            console.log(key + " : " + value);
                            // document.getElementById("executePaymentOutput").innerHTML += "<span class='text-danger'>"+key+"</span> : " + value + "</br>";
                            executePaymentOutput += "<span class='text-danger'>"+key+"</span> : " + value + "</br>";
                          }
                        }
                        return executePaymentOutput;
                    }
              
                    executePaymentOutput = loopingObj(message);
                    document.getElementById("executePaymentOutput").innerHTML += executePaymentOutput;

                    //LOOPING CONSOLE
                    


                    $.ajax({
                        // url: "execute-payment.php",// localhost
                        url: "PPP/execute-payment.php",// cloud9
                        type: "POST",
                        dataType: "json", //error dataType since the callback response isnt a json
                        // timeout: 10000, //error timeout when it delays
                        // data: JSON.stringify(reqs),
                        data: { "payer_id": payerID },
                    }).done(function(data, textStatus, jqxhr) {
                        var myId = data.id;
                        console.log(typeof(data));
                        console.log(myId);
                        console.log(data.transactions[0].related_resources[0].sale.state);
                        console.log(textStatus);
                        console.log(jqxhr);
                        console.log("done...");
                    }).fail(function(jqxhr, textStatus, errorThrown) {
                        console.log(jqxhr);
                        console.log(textStatus);
                        console.log(errorThrown);
                        console.log("error...");
                    });


                    console.log("pos ajax execute:" +executeURL);
                    console.log("pos ajax payerId: " +payerID);


                    

                }
            } catch (e) { //treat exceptions here
                // <<Insert Code Here>>
            }
        }
    </script>


</script>


<script type="text/javascript">
    $(document).ready(function(){
        // alert('testando'); 
        $("#createPaymentOutput").hide();
        $("#showExecutePaymentDiv").hide();
        $("#executePaymentOutput").hide();
        
        $("#showCreatePaymentDiv").click(function(){
            $("#createPaymentOutput").toggle();
        });
        
        
        $("#showExecutePaymentDiv").click(function(){
            $("#executePaymentOutput").toggle();
        });
        $("#continueButton").click(function(){
            $("#showExecutePaymentDiv").toggle();
        });

    });
</script>
    



