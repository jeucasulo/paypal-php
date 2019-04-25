<div class="container">
    <div class="row">

        <div class="col">
            <!-- paypalbutton -->
            <h1 class="text-center"><div id="paypal-button"></div></h1>

        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col mx-auto text-center">
            <form>
              <div class="form-group">
                <label for="clientId">Client Id</label>
                <input type="text" class="form-control" id="clientId" aria-describedby="clientId" placeholder="Client Id">
                <small id="clientIdHelp" class="form-text text-muted">Insira o Client Id de sua aplicação </small>
              </div>
              <div class="form-group">
                <label for="secret">Secret</label>
                <input type="text" class="form-control" id="secret" name="secret" placeholder="Secret" >
                <small id="secretHelp" class="form-text text-muted">Insira o Secret Id de sua aplicação</small>
              </div>
            </form>

            
        </div>
        
        <div class="col mx-auto text-center">
            <br>
            <br>
            <br>
            <button id="getTokenButton" class="btn btn-primary">Get Token</button><br>
            <small class="form-text text-muted"><a href=""> Como emitir minhas credenciais?</a> </small>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="row">

        <div class="col">

            <!--HERE-->

            <div id="accordion">

                <!--Get Token-->
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <!--<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">-->

                  1. Get Token
                </button>
                <span id="getTokenWaitingNotification" class="badge badge-warning float-right">Waiting</span>
                <span id="getTokenNotification" class="badge badge-success float-right"></span>

              </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                                <div class="card-group">
                            
                                                        <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">Request</h5>
                                    <!--<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>-->
                                    
                                      <p class="card-text bg-dark text-light">
                                        &nbsp; curl -v https://api.sandbox.paypal.com/v1/oauth2/token \ <br/>
                                        &nbsp; -H "Content-Type: application/json" \ <br/>
                                        &nbsp; -H "Accept-Language: en_US"  \ <br/>
                                        &nbsp; -u <span class="client-secret-tag">"&lt;client_id:secret&gt;"</span> \<br/>
                                        &nbsp; -d <span class="codeFont"> "grant_type=client_credentials"</span>
                                      </p>
                                    <p class="card-text"><small class="text-muted">Requisição em cURL</small></p>
                                    <!--source: https://developer.paypal.com/docs/api/overview/#make-your-first-call#postman-->


                                </div>
                                
                                <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><b>Trigger:</b> Get Token Button</li>
                                  <li class="list-group-item"><b>Action:</b> Sends a auth request and returns the Token</li>
                                  <li class="list-group-item"><b>Source:</b> getToken( ) function</li>  
                                </ul>
                                
                                  <div class="card-footer text-muted">

                                  </div>


                                
                            </div>

                            
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">Response JSON</h5>
                                    <!--<p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>-->
                                    <!--<div id="ExecutePaymentJsonResponseOutput"></div>-->
                                    <textarea id="getTokenJsonResponseOutputTextArea" class="form-control" readonly> </textarea>

                                    <p class="card-text"><small class="text-muted" id="tokenTimeDiv">Aguardando a requisição</small></p>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

             


            </div>

            <!--HERE-->

        </div>

    </div>

</div>

<!--modals-->
<!-- auth form modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-body">
        <img src="PPEC/pp-auth-form.png"></img>
      </div>
  </div>
</div>


<!--modals-->


<script src="PPEC/jquery-3.3.1.min.js"></script>
<script src="TOKEN/get-token.js"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<!--<div id="containerControllers">-->

<!--</div>-->



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
    .client-secret-tag{
        color: #f59000;
    }
    button{
        border-radius:25px!important;
    }
    
</style>