<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!-- Bootstrap Theme -->
    <link rel="stylesheet" href="https://bootswatch.com/4/materia/bootstrap.min.css" crossorigin="anonymous">
    
    <!--Ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <title>PayPal</title>
  </head>
  <body>
      
      
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/?r=home">PayPal</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
    <ul class="navbar-nav">
        
        <li class="nav-item">
          <a class="nav-link" href="/?r=credentials">Credenciais</a>
        </li>

        
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Token
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/?r=token">Token</a>
          <a class="dropdown-item" href="/?r=token-update">Token check</a>
        </div>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Express Checkout
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/?r=ec-client">EC-Client</a>
          <a class="dropdown-item" href="/?r=ppec">Rest</a>
          <a class="dropdown-item" href="/?r=ppec-nvp">NVP</a>
          <a class="dropdown-item" href="/?r=ppec-v2">V2</a>
          <a class="dropdown-item" href="/?r=ec-bt">EC-BT</a>
        </div>

      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Reports
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/?r=transactions">Transactions</a>
          <a class="dropdown-item" href="/?r=payments">Payments</a>
          <a class="dropdown-item" href="/?r=plans">Plans</a>
          <a class="dropdown-item" href="/?r=agreement-details">Agreement details</a>
          <a class="dropdown-item" href="/?r=agreement-transactions">Agreement transactions</a>
        </div>
      </li>



      <li class="nav-item">
        <a class="nav-link" href="/?r=sub">Subscritions</a>
      </li>
      <!--<li class="nav-item">-->
      <!--  <a class="nav-link" href="/?r=ppp">PayPal Plus</a>-->
      <!--</li>-->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          PayPalPlus
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/?r=ppp">PayPal Plus</a>
          <a class="dropdown-item" href="/?r=ppp-ctb">Cost to Buyer</a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/?r=payouts">Payouts</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/?r=refund">Refunds</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/?r=invoicing">Invoicing</a>
      </li>
      
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Reference
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/?r=ref">Híbrido</a>
          <a class="dropdown-item" href="/?r=ref-rest">Rest</a>
          <a class="dropdown-item" href="/?r=ref-rest-installs">Installments</a>
        </div>
      </li>
      
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Misc
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/?r=ec-scan">EC-Scan</a>
        </div>
      </li>

      
      <!--<li class="nav-item">-->
      <!--  <a class="nav-link" href="/?r=ref">Reference</a>-->
      <!--</li>-->
    <form class="form-inline my-2 my-lg-0">
      <input id="searchInput" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button id="searchBtn" class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>


      

    </ul>
  </div>
</nav>
      
      
    
<!--<nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark">-->
<!--    <div class="container">-->
<!--    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">-->
<!--        <ul class="navbar-nav mr-auto">-->
            
<!--            <li class="nav-item dropdown">-->
<!--                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkToken" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                  Token-->
<!--                </a>-->
<!--                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkToken">-->
<!--                  <a class="nav-link" href="/?r=token">Token</a>-->
<!--                  <a class="nav-link" href="/?r=token-update">Token check</a>-->
<!--                </div>-->
<!--            </li>-->


            
<!--            <li class="nav-item dropdown">-->
<!--                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                  Express Checkout-->
<!--                </a>-->
<!--                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">-->
<!--                  <a class="dropdown-item" href="/?r=ppec">Rest</a>-->
<!--                  <a class="dropdown-item" href="/?r=ppec-nvp">NVP</a>-->
<!--                  <a class="dropdown-item" href="/?r=ppec-list&start_index=0">List</a>-->
<!--                </div>-->
<!--            </li>-->

<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="/?r=sub">Subscritions</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="/?r=ppp">PayPal Plus</a>-->
<!--            </li>-->
<!--        </ul>-->
<!--    </div>-->
<!--    <div class="mx-auto order-0">-->
<!--        <a class="navbar-brand mx-auto" href="/">PayPal</a>-->
<!--        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">-->
<!--            <span class="navbar-toggler-icon"></span>-->
<!--        </button>-->
<!--    </div>-->
<!--    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">-->
<!--        <ul class="navbar-nav ml-auto">-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#">SOAP</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#">Outros</a>-->
<!--            </li>-->
<!--        </ul>-->
<!--    </div>-->
<!--    </div>-->
<!--</nav>-->



<br>
<br>
<br>

        <!--content-->

            <?php
              require_once('routes.php');
              
              $route = isset($_GET['r']) ? $_GET['r'] : "home";
              
              $routes = new Routes();
              $routes->checkCredentials($route);
            ?>
            
        <!--content-->
        
        
        
        <!--footer-->
        <br>
        <br>
        <br>
        <footer class="footer navbar-dark bg-dark">
          <div class="container">
              <div class="row">
                  <div class="col">
                     <p>Token</p>
                     <p>Express Checkout</p>
                     <p>PayPal Plus</p>
                     <p>Parâmetros</p>
                     <p>Exemplos</p>
                     <p>Modelos</p>
                  </div>
                  <div class="col">
                    <span class="text-muted">A fixed-height value is no longer needed! A dummy text for check responsive behavior.</span>
                  </div>
                  <div class="col">
                    <span class="text-muted">A fixed-height value is no longer needed! A dummy text for check responsive behavior.</span>
                  </div>
              </div>
          </div>
        </footer>
        
        <style type="text/css">
            .footer {
              padding: 1rem 0;
              margin-top: auto;
              background-color: #f5f5f5;
            }
        </style>

        <!--footer-->
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>

<script>
  $(document).ready(function(){
    $("#searchBtn").click(Index.Search);
    });
  
  var Index = {
    Search:function(event){
      event.preventDefault();
      
      let searchInput = $("#searchInput").val();
      searchInput = searchInput.replace(/\s/g,'');
      // alert(searchInput.length);
      
      if(searchInput.includes('PAY')){
        console.log("App.Redirect.PaymentDetails.Done");
        window.location.replace('?r=payment&id='+searchInput+'')
      }else if(searchInput.includes('P-')){
        console.log("App.Redirect.PaymentDetails.Done");
        window.location.replace('?r=plan&id='+searchInput+'')
      }else if(searchInput.length == '17'){
        console.log("App.Redirect.PaymentDetails.Done");
        window.location.replace('?r=transaction&id='+searchInput+'')
      }else{
        alert("Please insert a valid id");
      }
    }
  }
</script>