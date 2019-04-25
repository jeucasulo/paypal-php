<div class="container">
    <div class="row">
        <div class="col">
            <a href="https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_merchant-hub" target="_blank">Agreements</a> 
        </div>
    </div>
</div>
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="row">
            <input type="text" name="getAgreementInput" id="getAgreementInput" value="I-B9YGA4SRLBX3" />
            <button type="text" name="getAgreementBtn" id="getAgreementBtn" class="btn btn-default">Get Agreement Transactions</button<
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
           <div id='output'>
           </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $("#loader").hide();
    $("#getAgreementBtn").click(Agreement.LoadTable);

    
    
});

var Agreement = {
    LoadTable:function(){
        $("#loader").show();
        

       let baid = $("#getAgreementInput").val();

       $.ajax({
        // url: "execute-payment.php",// localhost
        url: "Reports/agreements-script.php",// cloud9
        type: "POST",
        data:{ "baid": baid , "list":"list"},
        dataType: "json", //error dataType since the callback response isnt a json
    }).done(function(data, textStatus, jqxhr) {
        // approval[0] = data.links[1].href;
        // sessionStorage.setItem('approval_url', data.links[1].href);
        
        // console.log(typeof(data));
        // console.log(data);
        // console.log(textStatus);
        // console.log(jqxhr);
        console.log("App.GetAgreementList.Done");
        console.log("Data");
        console.log(data);
        let list = "<table class='table table-striped table-dark'><thead><tr><th>Payment</th><th>Payment status</th><th>Type</th><th>Payer name</th><th>Date</th></tr></thead><tbody>";
        arr = jQuery.map( data.agreement_transaction_list, function( n, i ) {
          list += "<tr><td><a href='/?r=transaction&id="+n.transaction_id+"' target='_blank'>"+ n.transaction_id + "<a></td><td>" + n.status +"</td><td>"+n.transaction_type+"</td><td>"+n.payer_name+"</td><td>"+n.time_stamp+"</td></tr>";
        //   the i var is the index var
        });
        list += "</tbody></table>";
        
        // list += "<div class='row d-flex justify-content-center'>";
        // list += "<a href='#' id='prev'><b> < </b></a>";
        // list += "<span id='currentMin'>"+nextIndex+"</span>";
        // list += "<span>"+" - "+"</span>";
        // list += "<span id='currentMax'>"+parseInt(nextIndex+20)+"</span>";
        // list += "<a href='#' id='next'><b> > </b></a>";
        // list += "</div>";
        

        document.getElementById('output').innerHTML = list;
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
        console.log("App.GetAgreementList.Fail");
    });            

    }
}



        
</script>
