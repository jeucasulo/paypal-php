$(document).ready(function(){
    console.log("App.GetToken");
    $("#getTokenButton").click(function(){
        Token.GetToken();    
    });
    
});


var Token = {
    GetToken:function(){
        let clientId = $("#clientId").val();
        let secret = $("#secret").val();
        console.log("App.GetToken.GetToken();");
        
        console.log("Client Id:" + clientId);
        console.log("Secret:" + secret);
        
            $.ajax({
                url: "TOKEN/get-token.php/?clientId="+clientId+"&secret="+secret,// cloud9
                type: "POST",
                dataType: "json", //error dataType since the callback response isnt a json
            }).done(function(data, textStatus, jqxhr) {
                console.log("App.GetToken.Done");
                console.log(data);
                // here
                let newoutput = JSON.stringify(data, null, '\t')
    
                // document.getElementById("CreatePaymentJsonResponseOutput").innerHTML = output;
                document.getElementById("getTokenJsonResponseOutputTextArea").value = newoutput;
    
                var textArea = document.getElementById("getTokenJsonResponseOutputTextArea");
                textArea.rows = 15;
    
                document.getElementById("getTokenWaitingNotification").innerHTML = "";
                document.getElementById("getTokenNotification").innerHTML = "Done";
    
                var d = new Date(Date.now()); 
                let createTime = "Resposta gerada às " + d.getHours() +" horas, "+ d.getMinutes()+" minutos e "+d.getSeconds()+" segundos";
                
                document.getElementById("tokenTimeDiv").innerHTML = createTime;

                // here
                
                
            }).fail(function(jqxhr, textStatus, errorThrown) {
                console.log(jqxhr);
                console.log(textStatus);
                console.log(errorThrown);
                console.log("App.GetToken.Fail");
            });
    }
};
    
    