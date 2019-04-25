<div class="container">
    <div class="row">
        <div class="col">
            <input type="text" name="clientId" id="clientId" placeholder="Client id" class="form-control" />
        </div>
        <div class="col">
            <input type="text" name="secret" id="secret" placeholder="Secret" class="form-control" />
        </div>
        <div class="col">
            <input type="text" name="appName" id="appName" placeholder="App name" class="form-control" />
        </div>
        <div class="col">
            <input type="text" name="sandboxAccount" id="sandboxAccount" placeholder="Sandbox account" class="form-control" />
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <button id="setCredentialsBtn" class="btn btn-default">Atualizar credencias</button>
        </div>
    </div>
</div>
<!--https://www.sandbox.paypal.com/businessprofile/mytools/apiaccess/firstparty/signature-->
<div class="container">
    <hr>

    <div class="row">
        <div class="col">
            <?php
                $path = __DIR__.'/credentials.json';
                if(file_exists($path)){
                    $path = file_get_contents($path) ;
                    $jsonToArray = json_decode($path); // decode the JSON into an associative array
                    $clientId = $jsonToArray->clientId;
                    $secret = $jsonToArray->secret;
                    echo "<b>ClindId: </b>".$jsonToArray->clientId."<br/>";
                    echo "<b>Secret: </b>".$jsonToArray->secret."<br/>";
                    echo "<b>App name: </b>".$jsonToArray->appName."<br/>";
                    echo "<b>Sandbox account: </b>".$jsonToArray->sandboxAccount."<br/>";
                }else{
                    echo "<p>Nenhuma credencial inserida</p>";
                }
            ?>

        </div>
    </div>
</div>



<script>
$(document).ready(function(){
    $("#setCredentialsBtn").click(Credentials.SetCredentials);
});
var Credentials = {
    SetCredentials:function(){
            let clientId = $("#clientId").val();
            let secret = $("#secret").val();
            let appName = $("#appName").val();
            let sandboxAccount = $("#sandboxAccount").val();
            $.ajax({
                url: "Credentials/set-credentials.php",// cloud9
                type: "POST",
                dataType: "json", 
                data: {"clientId":clientId,"secret":secret,"appName":appName,"sandboxAccount":sandboxAccount}, 
            }).done(function(data, textStatus, jqxhr) {
                console.log("App.SetCredentials.Done");
                console.log("Data");
                console.log(data);
            }).fail(function(jqxhr, textStatus, errorThrown) {
                console.log(jqxhr);
                console.log(textStatus);
                console.log(errorThrown);
                console.log("App.SetCredentials.Fail");
            });
    }
}
</script>

