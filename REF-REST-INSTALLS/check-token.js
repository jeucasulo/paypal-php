checkToken();
function checkToken(){
    console.log("---------------------------------Check Token---------------------------------");
    $.ajax({
    url: "/REF-REST-INSTALLS/check-token.php",// cloud9
    type: "POST",
    dataType: "json", //error dataType since the callback response isnt a json
    // timeout: 10000, //error timeout when it delays
    // data: JSON.stringify(reqs),
    // data: { "payer_id": payerID },
    }).done(function(data, textStatus, jqxhr) {
        console.log("---------------------------------data---------------------------------");
        console.log(data);
        console.log("App.CheckToken.Done");
        if(data.check==true && data.state=='ACTIVE'){
            $('#tokenDiv').addClass('disabledbutton');
            $('#payDiv').removeClass('disabledbutton');
            // alert('token ja existe');
            
            document.getElementById("createPaymentWaitingNotification").innerHTML = "";
            document.getElementById("createPaymentNotification").innerHTML = "Done";

            document.getElementById("getTokenWaitingNotification").innerHTML = "";
            document.getElementById("getTokenNotification").innerHTML = "Done";
            
            document.getElementById("executePaymentWaitingNotification").innerHTML = "";
            document.getElementById("executePaymentNotification").innerHTML = "Done";
            getMaxInstalls();


        }
    }).fail(function(jqxhr, textStatus, errorThrown) {
        console.log(jqxhr);
        console.log(textStatus);
        console.log(errorThrown);
        console.log("App.CheckToken.Fail");
    });
}

function getMaxInstalls(){
    console.log("---------------------------------GetMaxInstalls---------------------------------");
    $.ajax({
    url: "/REF-REST-INSTALLS/get-max-installs.php",// cloud9
    type: "POST",
    dataType: "json", //error dataType since the callback response isnt a json
    // timeout: 10000, //error timeout when it delays
    // data: JSON.stringify(reqs),
    // data: { "payer_id": payerID },
    }).done(function(data, textStatus, jqxhr) {
        console.log("---------------------------------data---------------------------------");
        console.log(data);
        console.log("App.MaxInstalls.Done");
        
            // let taxs = [0,1,2,3,4,5,6,7,8,9,10,11,12];
            // let taxs = [0,1.3,1.7,3,4,5,6,7,8,9,10,11,12];
            let taxs = [0,0,0,3,4,5,6,7,8,9,10,11,12];

        
            let installs = "";
            // alert(data.financing_options[0].qualifying_financing_options.length);
            var installsments = data.financing_options[0].qualifying_financing_options.map(function(valor,index){
                
                let totalTaxAmout = 100+(100/100*taxs[index]);
                let mountlyTax = parseFloat(((totalTaxAmout - 100) / valor.credit_financing.term)).toFixed(2);
                let totalMountly = parseFloat(parseFloat(mountlyTax) + parseFloat(valor.monthly_payment.value)).toFixed(2);

                let valorAvista;
                let parcelas;
                let response = valor.credit_financing.term == 1 ? valorAvista : parcelas;
                
                    
                // return "<option value='"+valor.credit_financing.term+"'>"+valor.credit_financing.term+"x  "+valor.monthly_payment.currency_code+"("+valor.credit_financing.term+"%) &nbsp;&nbsp;&nbsp;&nbsp;</option>";
                return "<option value='"+valor.credit_financing.term+"' totalAmount='"+totalTaxAmout+"' totalMountly='"+totalMountly+"'>"+
                valor.credit_financing.term+"x de R$ "+
                // valor.monthly_payment.value+
                totalMountly+
                " - Total R$: " +
                parseFloat(totalTaxAmout).toFixed(2)+ //gets the total amount + relative installment tax
                "&nbsp;("+(taxs[index]==0?"Sem juros":taxs[index]+"%")+") &nbsp;&nbsp;&nbsp;&nbsp;</option>";
            });
            
            // console.log(installsments);
            // $("#totalWithTax").text(data.financing_options[0].qualifying_financing_options[0].total_cost.value);
            // $("#cfoSelect").append(null);
            $("#chooseInstallsSelect").append(installsments);
            
            // $("#chooseInstallsSelect").addClass("disabledbutton");
            
            


        // }
    }).fail(function(jqxhr, textStatus, errorThrown) {
        console.log(jqxhr);
        console.log(textStatus);
        console.log(errorThrown);
        console.log("App.MaxInstalls.Fail");
    });
}
