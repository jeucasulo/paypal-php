$("#createPayment").click(createPayment);



function createPayment(){
    console.log("---------------------------------Create Payment---------------------------------");
    $.ajax({
    // url: "execute-payment.php",// localhost
    url: "REF-REST-INSTALLS/create-payment.php",// cloud9
    type: "POST",
    dataType: "json", //error dataType since the callback response isnt a json
    // timeout: 10000, //error timeout when it delays
    // data: JSON.stringify(reqs),
    // data: { "payer_id": payerID },
}).done(function(data, textStatus, jqxhr) {
    console.log("---------------------------------data---------------------------------");
    console.log(data);
    // console.log("---------------------------------data.links[1].href---------------------------------");
    // console.log(data.links[1].href);
    // approval[0] = data.links[1].href;
    // sessionStorage.removeItem('approval_url');
    // approval_url = data.links[1].href;
    // sessionStorage.setItem('approval_url', data.links[1].href);
    

    // var imported = document.createElement('script');
    // imported.src = '/PPP/script.js';
    // document.head.appendChild(imported);

      //
    let newoutput = JSON.stringify(data, null, '\t')

    // document.getElementById("CreatePaymentJsonResponseOutput").innerHTML = output;
    document.getElementById("CreatePaymentJsonResponseOutputTextArea").value = newoutput;

    var textArea = document.getElementById("CreatePaymentJsonResponseOutputTextArea");
    textArea.rows = 60;

    document.getElementById("getTokenWaitingNotification2").innerHTML = "";
    document.getElementById("getTokenNotification2").innerHTML = "Done";

    document.getElementById("createPaymentWaitingNotification2").innerHTML = "";
    document.getElementById("createPaymentNotification2").innerHTML = "Done";
    
    
    var d = new Date(Date.now()); 
    let createTime = "Resposta gerada às " + d.getHours() +" horas, "+ d.getMinutes()+" minutos e "+d.getSeconds()+" segundos";
    
    document.getElementById("createTimeDiv").innerHTML = createTime;


    console.log("App.CreatePayment.Done");
}).fail(function(jqxhr, textStatus, errorThrown) {
    console.log(jqxhr);
    console.log(textStatus);
    console.log(errorThrown);
    console.log("App.CreatePayment.Fail");
});





}
