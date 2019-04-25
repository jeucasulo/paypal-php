<div class="container">
    <div class="row">
        <div class=col>
            <div>
                <h6 hidden>PayId: <span id='payId'><?php echo $_GET['id']?></span></h6>
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
    
</div>


<script>
$(document).ready(function(){
    
    let id = $("#payId").text();
    let output2 = "";
    let output = "";
    $.ajax({
        // url: "execute-payment.php",// localhost
        url: "Reports/transactions-script.php",// cloud9
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
                     "<li class='list-group-item'><b>State: </b>" + data.transaction_details[0].payer_info.transaction_status + "</li>" +
                     "<li class='list-group-item'><b>Payer: </b>" + data.transaction_details[0].payer_info.email_address + "</li>"  +
                     "<li class='list-group-item'><b>Value: </b>" + data.transaction_details[0].transaction_info.transaction_amount.value + "</li>" +
                     "<li class='list-group-item'><b>Date: </b>" + data.transaction_details[0].transaction_info.transaction_initiation_date + "</li>" 
                    // "<li class='list-group-item'><b>State:</b> " + data.transaction_info.transaction_status + "</li>" +
                    // "<li class='list-group-item'><b>Created:</b> " + data.transaction_info.transaction_status + "</li>" +
                    // "<li class='list-group-item'><b>Total:</b> " + data.transactions.amount.total +"</li>" +
                    // "<li class='list-group-item'><b>Description:</b> " + data.transactions.description +"</li>" +
                    // "<li class='list-group-item'><b>Name:</b> " + data.payer.payer_info.first_name  + "</li>" +
                    // "<li class='list-group-item'><b>Payer:</b> " + data.payer.payer_info.email + "</li>"
                    ;
        $("#output2").html(output2);

        // <!--<li class='list-group-item'>Vestibulum at eros</li>-->

        // arr = jQuery.map( data.payments, function( n, i ) {
        //   console.log( "Index: " + i + " | Payment: "+ n.id + " | State: " + n.state);
        // });
        
        // window.location = data.links[0].approval_url;
        // console.log(data.links[0].href);


        // $("#activatePlanBtn").attr("disabled", true);
        // $("#createAgreementBtn").attr("disabled", false);

    }).fail(function(jqxhr, textStatus, errorThrown) {
        console.log(jqxhr);
        console.log(textStatus);
        console.log(errorThrown);
        console.log("App.GetTransection.Fail");
    });            
});
</script>
