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

    console.log("App.receiveMessage");
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
            console.log("----------------------MessageReceived----------------------");
            console.log(message);
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

            
            console.log("App.ConsoleApp");

                let newoutput = JSON.stringify(message, null, '\t')

                // document.getElementById("CreatePaymentJsonResponseOutput").innerHTML = output;
                document.getElementById("ExecutePaymentJsonResponseOutputTextArea").value = newoutput;
        
                var textArea = document.getElementById("ExecutePaymentJsonResponseOutputTextArea");
                textArea.rows = 120;
        
                document.getElementById("executePaymentWaitingNotification").innerHTML = "";
                document.getElementById("executePaymentNotification").innerHTML = "Done";
        
                
                var d = new Date(Date.now()); 
                let createTime = "Resposta gerada às " + d.getHours() +" horas, "+ d.getMinutes()+" minutos e "+d.getSeconds()+" segundos";
                
                document.getElementById("executeTimeDiv").innerHTML = createTime;

            $.ajax({
                // url: "execute-payment.php",// localhost
                url: "PPP/execute-payment.php",// cloud9
                type: "POST",
                dataType: "json", //error dataType since the callback response isnt a json
                // timeout: 10000, //error timeout when it delays
                // data: JSON.stringify(reqs),
                data: { "payer_id": payerID },
            }).done(function(data, textStatus, jqxhr) {
                // var myId = data.id;
                console.log("----------------------typeof(data)--------------------");
                console.log(typeof(data));
                console.log(data);
                // console.log(myId);
                // console.log(data.transactions[0].related_resources[0].sale.state);
                console.log(textStatus);
                console.log(jqxhr);
                console.log("-----------------------App.ExecutePayment.Done-----------------------");
            }).fail(function(jqxhr, textStatus, errorThrown) {
                console.log(jqxhr);
                console.log(textStatus);
                console.log(errorThrown);
                console.log("-----------------------App.ExecutePayment.Fail----------------------");
            });

            console.log("pos ajax execute:" +executeURL);
            console.log("pos ajax payerId: " +payerID);
        }
    } catch (e) { //treat exceptions here
        // <<Insert Code Here>>
    }
}
