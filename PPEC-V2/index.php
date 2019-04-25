<div class="flex-center position-ref full-height">
    <div class="content">

        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        
        <script src="https://www.paypal.com/sdk/js?client-id=sb"></script>

        <div class="container">
             <div class="row">
                 <div class="col">
                     <!-- paypalbutton -->
                     <h1 class="text-center"><div id="paypal-button-container"></div></h1>
                 </div>
             </div>
        </div>
            <form id='myForm'>
                <input type="text" name="itemName[]" value='item1'/>
                <input type="text" name="itemName[]" value='item1'/>
                <input type="text" name="itemPrice[0]" value='price1'/>
                <input type="text" name="itemQtty[0]" value='qtty1'/>
            </form>     
        <script>
          paypal.Buttons({
            createOrder: function() {
                var form = new FormData(document.getElementById('myForm'));
                // return fetch('/my-server/create-paypal-transaction')
                // return fetch('/EC-V2/script.php')
                return fetch('/PPEC-V2/create-order.php',{
                method: 'post',
                body: form
                  
                // headers: {
                // Accept: 'application/json',
                // 'Content-Type': 'application/x-www-form-urlencoded'
                // body: 'name=jeu&age=30&city=sao paulo'
                
                
                
                  
                  
                  
              })
                .then(function(res) {
                  console.log(res);
                  return res.json();
                }).then(function(data) {
                  console.log(data);
                  return data.id;
                });
            },
                // Finalize the transaction
            onApprove: function(data, actions) {
                console.log(data);
                return fetch('/PPEC-V2/capture-order.php/?orderId=' + data.orderID, {
                    // method: 'post'
                    method: 'get'
                }).then(function(res) {
                    return res.json();
                    console.log(res);
                }).then(function(details) {
                    // Show a success message to the buyer
                    console.log(details);
                    alert('Transaction completed by ' + details.payer.name.given_name + '!');
                });
            }
          }).render('#paypal-button-container');
        </script>

    </div>
</div>
