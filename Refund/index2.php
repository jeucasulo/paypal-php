<div class="container">
    <div class="row d-flex justify-content-center">
        
            <div class="col">
                <h1 class="text-center">
                    <input type="text" name="getAgreementInput" id="getPaymentInput" class="form-control" value="6K893100KB3231029" />
                </h1>
            </div>
            
            <div class="col">
                <h1 class="text-center">
                    <button type="text" name="getAgreementBtn" id="getPaymentBtn" class="btn btn-default">Get Payment Details</button>
                </h1>
            </div>
            
            <div class="col">
                <h1 class="text-center">
                    <button type="text" name="executeRefundBtn" id="executeRefundBtn" class="btn btn-default">Execute Refund</button>
                </h1>
            </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class=col>
            <div id="loader" >
                <div  class="row d-flex justify-content-center">
                    <img  src="_img/ajax-loader.gif"></img>
                </div>
            </div>
        </div>
    </div>
</div>


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


<script>
$(document).ready(function(){
    $("#loader").hide();
    $("#getPaymentBtn").click(Agreement.LoadTable);
    $("#executeRefundBtn").click(Agreement.ExecuteRefund);

    
    
});

var Agreement = {
    LoadTable:function(){
        $("#loader").show();
        
       let payId = $("#getPaymentInput").val();

       $.ajax({
        // url: "execute-payment.php",// localhost
        url: "Refund/refunds-script.php",// cloud9
        type: "POST",
        data:{ "payId": payId , "details":"details"},
        dataType: "json", //error dataType since the callback response isnt a json
    }).done(function(data, textStatus, jqxhr) {
        // approval[0] = data.links[1].href;
        // sessionStorage.setItem('approval_url', data.links[1].href);
        
        // console.log(typeof(data));
        // console.log(data);
        // console.log(textStatus);
        // console.log(jqxhr);
        console.log("App.GetPayment.Done");
        console.log("Data");
        console.log(data);

        output2 =   "<li class='list-group-item'><b>Id: </b>" + data.id + "</li>" +
                    "<li class='list-group-item'><b>State:</b> " + data.state + "</li>" +
                    "<li class='list-group-item'><b>Created:</b> " + data.create_time + "</li>" +
                    "<li class='list-group-item'><b>Total:</b> " + data.transactions[0].amount.total +"</li>" +
                    "<li class='list-group-item'><b>Description:</b> " + data.transactions[0].description +"</li>" +
                    "<li class='list-group-item'><b>Name:</b> " + data.payer.payer_info.first_name + " " + data.payer.payer_info.last_name + "</li>" +
                    "<li class='list-group-item'><b>Payer:</b> " + data.payer.payer_info.email + "</li>"
                    ;
        $("#output2").html(output2);

        
        // list += "<div class='row d-flex justify-content-center'>";
        // list += "<a href='#' id='prev'><b> < </b></a>";
        // list += "<span id='currentMin'>"+nextIndex+"</span>";
        // list += "<span>"+" - "+"</span>";
        // list += "<span id='currentMax'>"+parseInt(nextIndex+20)+"</span>";
        // list += "<a href='#' id='next'><b> > </b></a>";
        // list += "</div>";
        

        $("#loader").hide();
        $("#output").show();
        
        // window.location = data.links[0].approval_url;
        // console.log(data.links[0].href);


        // $("#activatePlanBtn").attr("disabled", true);
        // $("#createAgreementBtn").attr("disabled", false);

    }).fail(function(jqxhr, textStatus, errorThrown) {
        console.log(jqxhr);
        console.log(textStatus);
        console.log(errorThrown);
        console.log("App.GetPayment.Fail");
    });            

    },
    ExecuteRefund:function(){
        
       $("#loader").show();
        
       let payId = $("#getPaymentInput").val();

       $.ajax({
        // url: "execute-payment.php",// localhost
        url: "Refund/refunds-script.php",// cloud9
        type: "POST",
        data:{ "payId": payId , "refund":"refund"},
        dataType: "json", //error dataType since the callback response isnt a json
    }).done(function(data, textStatus, jqxhr) {
        
        console.log("App.ExecuteRefund.Done");
        console.log("Data");
        console.log(data);

        output2 =   "<li class='list-group-item'><b>Id: </b>" + data.id + "</li>" +
                    "<li class='list-group-item'><b>State:</b> " + data.state + "</li>" +
                    "<li class='list-group-item'><b>Created:</b> " + data.create_time + "</li>" +
                    "<li class='list-group-item'><b>Total:</b> " + data.transactions[0].amount.total +"</li>" +
                    "<li class='list-group-item'><b>Description:</b> " + data.transactions[0].description +"</li>" +
                    "<li class='list-group-item'><b>Name:</b> " + data.payer.payer_info.first_name + " " + data.payer.payer_info.last_name + "</li>" +
                    "<li class='list-group-item'><b>Payer:</b> " + data.payer.payer_info.email + "</li>"
                    ;
        $("#output2").html(output2);

        $("#loader").hide();
        $("#output").show();
        
    }).fail(function(jqxhr, textStatus, errorThrown) {
        console.log(jqxhr);
        console.log(textStatus);
        console.log(errorThrown);
        console.log("App.ExecuteRefund.Fail");
    });            

    }
}



        
</script>
