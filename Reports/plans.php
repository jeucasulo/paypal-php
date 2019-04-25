<div class="container" id="switcher">
    <div class="row d-flex justify-content-center">
            <span><b><a href="#" id="prevList"> < </a></b>&nbsp</span>
            <span id="currentMinList">0</span> 
            <span> - </span> 
            <span id="currentMaxList"><?php echo $_GET['start_index']+20?></span> 
            <span>&nbsp<b><a href="#" id="nextList"> > </a></b></span> 
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
    $("#switcher").hide();
    let currentMinList = $("#currentMinList").text();
    LoadTable(currentMinList);
    
});

$("#prevList").click(function(e){
    e.preventDefault();
    console.log('PreviousList');
    $("#loader").show();
    $("#output, #switcher").hide();
    let currentMinList = parseInt($("#currentMinList").text());
    let currentMaxList = parseInt($("#currentMaxList").text());
    $("#currentMaxList").text(currentMaxList-20);
    $("#currentMinList").text(currentMinList-20);
    
    let prevList = currentMinList - 20;
    prevList = (prevList < 0) ? 0 : prevList;
    console.log(prevList);
    let url = "/?r=ppec-list&start_index="+prevList;
    console.log(url);
    LoadTable(prevList);
    // window.location = url;
});

$("#nextList").click(function(e){
    e.preventDefault();
    console.log('NextList');
    $("#loader").show();
    $("#output, #switcher").hide();
    let currentMaxList = parseInt($("#currentMaxList").text());
    let currentMinList = parseInt($("#currentMinList").text());
    $("#currentMaxList").text(currentMaxList+20);
    $("#currentMinList").text(currentMinList+20);
    
    let nextList = currentMinList + 20;
    // nextList = (nextList < 0) ? 0 : prevList;
    console.log(nextList);
    let url = "/?r=ppec-list&start_index="+nextList;
    console.log(url);
    LoadTable(nextList);
    // window.location = url;
});



function LoadTable(nextIndex){
    //   $("#currentMinList").text(nextIndex);
    //   $("#nextIndex").text(nextIndex+20);
       console.log("next index: " + nextIndex);
       $.ajax({
        // url: "execute-payment.php",// localhost
        url: "Reports/plans-script.php",// cloud9
        type: "POST",
        data:{ "nextIndex": nextIndex},
        dataType: "json", //error dataType since the callback response isnt a json
    }).done(function(data, textStatus, jqxhr) {
        // approval[0] = data.links[1].href;
        // sessionStorage.setItem('approval_url', data.links[1].href);
        
        // console.log(typeof(data));
        // console.log(data);
        // console.log(textStatus);
        // console.log(jqxhr);
        console.log("App.GetPlans.Done");
        console.log("Data");
        console.log(data);
        let list = "<table class='table table-striped table-dark'><thead><tr><th>Payment</th><th>Payment state</th><th>Amount</th><th>Transaction state </th><th>Date</th></tr></thead><tbody>";
        arr = jQuery.map( data.plans, function( n, i ) {
          list += "<tr><td><a href='/?r=plan&id="+n.id+"' target='_blank'>"+ n.id + "<a></td><td>" + n.name +"</td><td>"+n.description+"</td><td>"+n.state+"</td><td>"+n.create_time+"</td></tr>";
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
        $("#output, #switcher").show();
        
        // window.location = data.links[0].approval_url;
        // console.log(data.links[0].href);


        // $("#activatePlanBtn").attr("disabled", true);
        // $("#createAgreementBtn").attr("disabled", false);

    }).fail(function(jqxhr, textStatus, errorThrown) {
        console.log(jqxhr);
        console.log(textStatus);
        console.log(errorThrown);
        console.log("App.GetPlans.Fail");
    });            
 
}

        
</script>
