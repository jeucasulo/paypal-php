// reativar o segundo select
// $("#chooseInstallsSelect").change(function(){
//  let installmentsTerms = $("#chooseInstallsSelect").val();
//  alert(installmentsTerms);
//  let value = 100 + (100/100*installmentsTerms);
//  alert(value);
//  calculatedFinancingOptions(value);   
// });

function calculatedFinancingOptions(value){
    console.log("---------------------------------calculatedFinancingOptions---------------------------------");
    $.ajax({
    url: "/REF-REST-INSTALLS/calculated-financing-options.php?value="+value,// cloud9
    type: "POST",
    dataType: "json", //error dataType since the callback response isnt a json
    // timeout: 10000, //error timeout when it delays
    // data: JSON.stringify(reqs),
    // data: { "payer_id": payerID },
    }).done(function(data, textStatus, jqxhr) {
        console.log("---------------------------------data---------------------------------");
        console.log(data);
        console.log("App.CFO.Done");
        // if(data.check==true && data.state=='ACTIVE'){
        //     $('#tokenDiv').addClass('disabledbutton');
        //     $('#payDiv').removeClass('disabledbutton');
        //     // alert('token ja existe');
            
            
            document.getElementById("cfoWaitingNotification2").innerHTML = "";
            document.getElementById("cfoNotification2").innerHTML = "Done";

            document.getElementById("getTokenWaitingNotification2").innerHTML = "";
            document.getElementById("getTokenNotification2").innerHTML = "Done";
            
            // document.getElementById("executePaymentWaitingNotification").innerHTML = "";
            // document.getElementById("executePaymentNotification").innerHTML = "Done";
            
            let newoutput = JSON.stringify(data, null, '\t')

            // document.getElementById("CreatePaymentJsonResponseOutput").innerHTML = output;
            document.getElementById("cfoJsonResponseOutputTextArea").value = newoutput;

            var textArea = document.getElementById("cfoJsonResponseOutputTextArea");
            textArea.rows = 420;
            
            let installs = "";
            taxs = [0,1,2,3,4,5,6,7,8,9,10,11,12];
            // alert(data.financing_options[0].qualifying_financing_options.length);
            var installsments = data.financing_options[0].qualifying_financing_options.map(function(valor){
                
                // installs += "<option>"+valor.credit_financing.term+"</option>";
                return "<option>"+valor.credit_financing.term+"x "+valor.monthly_payment.value+" "+valor.monthly_payment.currency_code+"("+valor.credit_financing.term+"%) - Total: R$ "+(100+(100/100+taxs[valor.credit_financing.term-1]))+"&nbsp;&nbsp;&nbsp;&nbsp;</option>";
            });
            
            // console.log(installsments);
            $("#totalWithTax").text(data.financing_options[0].qualifying_financing_options[0].total_cost.value);
            // $("#cfoSelect").append(null);
            $("#cfoSelect").append(installsments);
            $("#chooseInstallsSelect").addClass("disabledbutton");
            
            


        // }
    }).fail(function(jqxhr, textStatus, errorThrown) {
        console.log(jqxhr);
        console.log(textStatus);
        console.log(errorThrown);
        console.log("App.CFO.Fail");
    });

}