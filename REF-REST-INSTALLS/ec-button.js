// creates a paypal button object
paypal.Button.render({
    env: 'sandbox', // Or 'production'
    // Set up the payment:
    // 1. Add a payment callback
    payment: function(data, actions) {
        // 2. Make a request to your server

        // var CREATE_URL = "PPEC/create-payment.php"; //cloud9
        var CREATE_URL = "REF-REST-INSTALLS/create-billing-token.php"; //cloud9

        // Excute a post to the endpoint and gets the res.id from the return from the CreatePayment method
        return actions.request.post(CREATE_URL,{action:"___minha action carai"})

        // Return actions.request.post('/my-api/create-payment/')
        .then(function(res) {
            // 3. Return res.id from the response
            console.log("App.CreatePaymentResponde");
            console.log(res); // this

            let createPayment = "";

            function loopingObj(object) {

                for (key in object) {
                    var value = object[key];
                    if (typeof value === 'object') {
                        loopingObj(value);
                    } else {
                        createPayment += "<span class='text-danger'>" + key + "</span> : " + value + "</br>";
                    }
                }

                return createPayment;
            }

            // createPayment = loopingObj(res);
            // document.getElementById("CreatePaymentJsonResponseOutput").innerHTML = createPayment;

            // let output = JSON.stringify(res);
            // output = output.replace(/,/g, ",<br/>");
            // output = output.replace(/{"/g, "{<br/>\"");
            // output = output.replace(/"}/g, "\"<br/>}");
            // output = output.replace(/\[/g, "\[<br/>");
            // output = output.replace(/\]/g, "<br/>\]");

            let newoutput = JSON.stringify(res, null, '\t')

            // document.getElementById("CreatePaymentJsonResponseOutput").innerHTML = output;
            document.getElementById("CreatePaymentJsonResponseOutputTextArea").value = newoutput;

            var textArea = document.getElementById("CreatePaymentJsonResponseOutputTextArea");
            textArea.rows = 37;

            document.getElementById("createPaymentWaitingNotification").innerHTML = "";
            document.getElementById("createPaymentNotification").innerHTML = "Done";

            document.getElementById("getTokenWaitingNotification").innerHTML = "";
            document.getElementById("getTokenNotification").innerHTML = "Done";
            
            var d = new Date(Date.now()); 
            let createTime = "Resposta gerada às " + d.getHours() +" horas, "+ d.getMinutes()+" minutos e "+d.getSeconds()+" segundos";
            
            document.getElementById("createTimeDiv").innerHTML = createTime;

            // console.log(res);
            return res.token_id; //this 

        });
    },

    // Execute the payment:
    // 1. Add an onAuthorize callback
    onAuthorize: function(data, actions) {
        console.log("----------------Data----------------");
        console.log(data);
        // 2. Make a request to your server
        // 
        var localhost = window.location.hostname;
        // var EXECUTE_URL = "http://"+localhost+"/PPEC/ExecutePayment.php"; // localhost
        var EXECUTE_URL = "REF-REST-INSTALLS/create-billing-agreement.php"; // cloud9

        // excute a post to the endpoint then SEND the payerId and paymentId FOR
        // the the ExecutePayment method that can use it on accessing the post vars
        return actions.request.post(EXECUTE_URL, {
                // paymentID: data.paymentID,
                // payerID: data.payerID
                'baToken': data.billingToken
            })
            .then(function(res) {
                // print the return from the execute payment from the backend method
                console.log("App.ExecutePaymentResponde");
                console.log(res);

                let executePayment = "";

                function loopingObj(object) {
                    for (key in object) {
                        var value = object[key];
                        if (typeof value === 'object') {
                            // console.log('{');
                            loopingObj(value);
                            // console.log('}');
                        } else {
                            // console.log(key + " : " + value);
                            // document.getElementById("ExecutePaymentJsonResponseOutput").innerHTML += "<span class='text-danger'>"+key+"</span> : " + value + "</br>";
                            executePayment += "<span class='text-danger'>" + key + "</span> : " + value + "</br>";

                        }
                    }

                }

                // loopingObj(res);
                // document.getElementById("ExecutePaymentJsonResponseOutput").innerHTML = executePayment;
                // ExecutePaymentJsonResponseOutputTextArea

                let executeOutput = JSON.stringify(res, null, '\t')

                // document.getElementById("CreatePaymentJsonResponseOutput").innerHTML = output;
                document.getElementById("ExecutePaymentJsonResponseOutputTextArea").value = executeOutput;
                var textAreaExecute = document.getElementById("ExecutePaymentJsonResponseOutputTextArea");
                textAreaExecute.rows = 105;

                document.getElementById("executePaymentWaitingNotification").innerHTML = "";
                document.getElementById("executePaymentNotification").innerHTML = "Done";
                
                var d = new Date(Date.now()); 
                let executeTime = "Resposta gerada às " + d.getHours() +" horas, "+ d.getMinutes()+" minutos e "+d.getSeconds()+" segundos";
                
                document.getElementById("executeTimeDiv").innerHTML = executeTime;


            });
    }
}, '#paypal-button');