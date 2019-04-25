<?php
    $require_path = $_SERVER['DOCUMENT_ROOT']."/Credentials/credentials.php";
    require_once($require_path);
    
    $credentials = new Credentials();
    $credentials->checkCredentials();
    $importCredentials = $credentials->getCredentials();
?>

<div class="container">
    <div class="row">

        <div class="col">
            <!-- paypalbutton -->
            <h1 class="text-center"><div>TokenUpdate</div></h1>

        </div>
    </div>
</div>
<div class="container">
    <div class="row">

        <div class="col">
            <h6 class="text-center" id="clientId" hidden><?php echo $importCredentials->clientId ?></h6>
        </div>
        <div class="col">
            <h6 class="text-center" id="secret" hidden><?php echo $importCredentials->secret ?></h6>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">

        <div class="col">
            <p> <b> Status: </b><span class="" id="status"></span></p>
            <p> <b> App Id:</b> <span id="app_id"></span></p>
            <p> <b> Nonce: </b><span id="nonce"></span></p>
            <p> <b> Access token:</b> <span id="access_token"></span></p>
            <p> <b> Token type:</b> <span id="token_type"></span></p>
            <p> <b> Lifetime: </b><span class="" id="lifetime"></span></p>
            <p> <b> Expires in date: </b><span class="text-primary" id="expires_in"></span></p>
            <p> <b> Created_at: </b><span class="text-primary" id="created_at"></span></p>
            <p> <b> Expired: </b><span class="" id="expired"></span></p>
            <p> <b> Convert expires: </b><span class="text-primary" id="convert_expires"></span></p>
            <p> <b> Convert now: </b><span class="text-primary" id="convert_now"></span></p>
            <!--Corrigir esse-->
            <p> <b> Expired time: </b><span class="text-danger" id="expired_time"></span></p>

        </div>
    </div>
</div>

<div class="container">
    <div class="row">

        <div class="col">
            
            <button class="btn btn-default" id="createTokenBtn">Create token</button>

        </div>

    </div>
</div>


<script src="PPEC/jquery-3.3.1.min.js"></script>


<script>
$(document).ready(function(){
    Token.GetToken();
    $("#createTokenBtn").click(Token.CreateToken);
});
var Token = {
    CreateToken:function(){
        let clientId = $("#clientId").html();
        let secret = $("#secret").html();

        $.ajax({
            // url: "execute-payment.php",// localhost
            url: "TOKEN-UPDATE/token.php",// cloud9
            type: "POST",
            // dataType: "json", //error dataType since the callback response isnt a json
            data: {"clientId":clientId, "secret":secret}

        }).done(function(data, textStatus, jqxhr) {
            
            console.log("App.CreateToken.Done");
            console.log("Data");
            console.log(data);
            Token.GetToken();
            
        }).fail(function(jqxhr, textStatus, errorThrown) {
            console.log(jqxhr);
            console.log(textStatus);
            console.log(errorThrown);
            console.log("App.CreateToken.Fail");
        });
        
    }  ,
    GetToken:function(){
        $.ajax({
            url: "TOKEN-UPDATE/token.php",// cloud9
            type: "POST",
            data: {"action":"get"},
            dataType: "json", //error dataType since the callback response isnt a json
        }).done(function(data, textStatus, jqxhr) {
            console.log("App.GetToken.Done");
            console.log("Data");
            console.log(data);
            // if(data.expired == true){
            //     Token.GetToken();
            // }
            document.getElementById('status').innerHTML = data.status;
            document.getElementById('status').style.color = data.expired ? "red" : "green";

            document.getElementById('app_id').innerHTML = data.app_id;
            document.getElementById('nonce').innerHTML = data.nonce;
            document.getElementById('access_token').innerHTML = data.access_token;
            document.getElementById('token_type').innerHTML = data.token_type;
            document.getElementById('lifetime').innerHTML = data.lifetime;
            // document.getElementById('lifetime').style = data.lifetime;
            document.getElementById("lifetime").style.color = data.expired ? "red" : "green";

            document.getElementById('expires_in').innerHTML = data.expires_in;
            document.getElementById('created_at').innerHTML = data.created_at;
            document.getElementById('expired').innerHTML = data.expired;
            document.getElementById('expired').style.color = data.expired ? "red" : "green";

            document.getElementById('convert_expires').innerHTML = data.convert_expires;
            document.getElementById('convert_now').innerHTML = data.convert_now;
            document.getElementById('expired_time').innerHTML = data.expired_time;
            

        }).fail(function(jqxhr, textStatus, errorThrown) {
            console.log(jqxhr);
            console.log(textStatus);
            console.log(errorThrown);
            console.log("App.GetToken.Fail");
        });
    }
}
</script>

<style type="text/css">
    #CreatePaymentJsonResponseOutput,
    #ExecutePaymentJsonResponseOutput {
        font-size: 10pt;
    }
    
    textarea {
        resize: none;
        overflow: hidden;
        border: none !important;
        font-size: 7pt !important;
        color: black !important;
    }
    .codeFont{
        color:#02cf92;
    }
    .accessTokenTag{
        color: #f59000;
    }
</style>