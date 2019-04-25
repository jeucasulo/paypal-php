<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col">
            <input type="text" name="transectionId" id="transectionId"  value="2C4604269F401382G" class="form-control"/>    
        </div>
        <div class="col">
            <button id="search" class="btn btn-default">Get transaction</button>
        </div>
        <div class="col">
            <button id="search" class="btn btn-default">Get transaction</button>
        </div>
    </div>
    <br>
    <div class="row d-flex justify-content-center">
        <div class"col-md-2">
                <div class="card bg-dark" style="width: 18rem;">
                  <div class="card-header text-white">
                    Details
                  </div>
                  <ul class="list-group list-group-flush" id="output2">
                  </ul>
                </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function(){
    Transection.GetDetails();
    $("#executeRefundBtn").click(Transection.ExecuteRefund);
});
var Transection = {
    GetDetails:function(){
    let id = $("#transectionId").val();
    let output2 = "";
    let output = "";
    $.ajax({
        // url: "execute-payment.php",// localhost
        url: "Search/transactions-script.php",// cloud9
        type: "POST",
        data: {'id': id},
        dataType: "json", //error dataType since the callback response isnt a json
    }).done(function(data, textStatus, jqxhr) {
        // approval[0] = data.links[1].href;
        // sessionStorage.setItem('approval_url', data.links[1].href);
        
        // console.log(typeof(data));
        // console.log(data);
        // console.log(textStatus);
        // console.log(jqxhr);
        console.log("App.GetTransection.Done");
        console.log("Data");
        console.log(data);
        output2 +=   "<li class='list-group-item'><b>Id: </b>" + data.transaction_details[0].transaction_info.transaction_id + "</li>" +
                     "<li class='list-group-item'><b>State: </b>" + data.transaction_details[0].transaction_info.transaction_status + "</li>" +
                     "<li class='list-group-item'><b>Payer: </b>" + data.transaction_details[0].payer_info.email_address + "</li>"  +
                     "<li class='list-group-item'><b>Value: </b>" + data.transaction_details[0].transaction_info.transaction_amount.value + "</li>" +
                     "<li class='list-group-item'><b>Date: </b>" + data.transaction_details[0].transaction_info.transaction_initiation_date + "</li>" 
                    ;
        $("#output2").html(output2);

    }).fail(function(jqxhr, textStatus, errorThrown) {
        console.log(jqxhr);
        console.log(textStatus);
        console.log(errorThrown);
        console.log("App.GetTransection.Fail");
    });            

    },
    ExecuteRefund:function(){
    let id = $("#transectionId").val();
    let output2 = "";
   
    $.ajax({
        // url: "execute-payment.php",// localhost
        url: "Search/transactions-script.php",// cloud9
        type: "POST",
        data: {"refund": id},
        dataType: "json", //error dataType since the callback response isnt a json
    }).done(function(data, textStatus, jqxhr) {
        // approval[0] = data.links[1].href;
        // sessionStorage.setItem('approval_url', data.links[1].href);
        
        // console.log(typeof(data));
        // console.log(data);
        // console.log(textStatus);
        // console.log(jqxhr);
        console.log("App.ExecuteTransection.Done");
        console.log("Data");
        console.log(data);
        // output2 +=   "<li class='list-group-item'><b>Id: </b>" + data.transaction_details[0].transaction_info.transaction_id + "</li>" +
        //              "<li class='list-group-item'><b>State: </b>" + data.transaction_details[0].payer_info.transaction_status + "</li>" +
        //              "<li class='list-group-item'><b>Payer: </b>" + data.transaction_details[0].payer_info.email_address + "</li>"  +
        //              "<li class='list-group-item'><b>Value: </b>" + data.transaction_details[0].transaction_info.transaction_amount.value + "</li>" +
        //              "<li class='list-group-item'><b>Date: </b>" + data.transaction_details[0].transaction_info.transaction_initiation_date + "</li>" 
                    
        //             ;
        // $("#output2").html(output2);

    }).fail(function(jqxhr, textStatus, errorThrown) {
        console.log(jqxhr);
        console.log(textStatus);
        console.log(errorThrown);
        console.log("App.ExecuteTransection.Fail");
    });            

    }
}
</script>
