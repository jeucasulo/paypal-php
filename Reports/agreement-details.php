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
            <button type="text" name="getAgreementBtn" id="getAgreementBtn" class="btn btn-default">Get Agreement Details</button<
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
        data:{ "baid": baid , "details":"details"},
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

        output2 +=   "<li class='list-group-item'><b>Id: </b>" + data.id + "</li>" +
                     "<li class='list-group-item'><b>State: </b>" + data.state + "</li>" +
                     "<li class='list-group-item'><b>Payer: </b>" + data.payer.payer_info.email + "</li>"  +
                     "<li class='list-group-item'><b>Description: </b>" + data.description + "</li>" +
                     "<li class='list-group-item'><b>Date: </b>" + data.start_date + "</li>" 
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
        console.log("App.GetAgreementList.Fail");
    });            

    }
}



        
</script>
