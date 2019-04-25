$('#inactiveButton').click(inactiveToken);
// inactiveToken();
function inactiveToken(){
    console.log("---------------------------------Check Token---------------------------------");
    $.ajax({
    url: "/REF-REST/inactive-token.php",// cloud9
    type: "POST",
    dataType: "json", //error dataType since the callback response isnt a json
    // timeout: 10000, //error timeout when it delays
    // data: JSON.stringify(reqs),
    // data: { "payer_id": payerID },
    }).done(function(data, textStatus, jqxhr) {
        console.log("---------------------------------data---------------------------------");
        console.log(data);
        console.log("App.InactiveToken.Done");
        if(data.check==true){
            $('#tokenDiv').addClass('disabledbutton');
            $('#payDiv').removeClass('disabledbutton');
            // alert('token ja existe');
            
            document.getElementById("createPaymentWaitingNotification").innerHTML = "";
            document.getElementById("createPaymentNotification").innerHTML = "Done";

            document.getElementById("getTokenWaitingNotification").innerHTML = "";
            document.getElementById("getTokenNotification").innerHTML = "Done";
            
            document.getElementById("executePaymentWaitingNotification").innerHTML = "";
            document.getElementById("executePaymentNotification").innerHTML = "Done";


        }
    }).fail(function(jqxhr, textStatus, errorThrown) {
        console.log(jqxhr);
        console.log(textStatus);
        console.log(errorThrown);
        console.log("App.InactiveToken.Fail");
    });
}
