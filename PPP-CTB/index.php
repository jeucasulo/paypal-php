<?php
    session_start();
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);
?>
<script src="https://www.paypalobjects.com/webstatic/ppplusdcc/ppplusdcc.min.js" type="text/javascript"></script>


<!-- Create a HTML DIV on your checkout page where the iFrame will be embedded -->
<div class="container">
    <div class="row">
        <div class="col">
            <label for="installments">Selecione o número de parcelas</label>
            <select name="installments" id="installments" class="form-control">
                <option value="1">1 - 1%</option>
                <option value="2">2 - 2%</option>
                <option value="3">3 - 3%</option>
                <option value="4">4 - 4%</option>
                <option value="5">5 - 5%</option>
                <option value="6">6 - 6%</option>
            </select>
        </div>
    </div>
</div>
<script>
    $('#installments').change(function(){
        // alert( this.value );
        createPayment(this.value);
    })
</script>
<div class="container">
  <div class="row">
    <div class="col">
      <div id="load" class="justify-content-center text-center mx-auto">
          <br>
          <br>
          <br>
          
          <img src="/PPP/ajax-loader.gif"></img>
          <!--<img src="/PPP/chico.gif"></img>-->
          
          
          
          <br>
          <br>
          <br>
      </div>
      <div id="ppplusDiv"></div>
    </div>
  </div>
</div>


<div class="container">
    <div class="row">
        <div class="col">
            <center>
                <button
                    type="submit"
                    id="continueButton"
                    onclick="ppp.doContinue(); return false;" class="btn btn-success btn-lg btn-block">
                    Checkout
                </button>
            </center>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col">

            <!-- acordion -->
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
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Response</h5>
                                    <!--<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>-->
                                    <p class="card-text">
                                        
                                    </p>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!--Create Payment-->
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  2. Create Payment
                </button>
                <span id="createPaymentWaitingNotification" class="badge badge-warning float-right">Waiting</span>
                <span id="createPaymentNotification" class="badge badge-success float-right"></span>
              </h5>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-group">
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">Request (cURL)</h5>
                                    <!--<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>-->
                                    
                                      <p class="card-text bg-dark text-light">
                                        &nbsp; curl -v https:  //api.sandbox.paypal.com/v1/payments/payment \ <br/>
                                        &nbsp; -H "Content-Type: application/json" \ <br/>
                                        &nbsp; -H "Authorization: Bearer <a href="#"><span class="accessTokenTag">&lt;Access-Token&gt;	</span></a> " \ <br/>
                                        &nbsp; -d <span class="codeFont">'{ <br/>
                                        &nbsp; &emsp; "intent": "sale", <br/>
                                        &nbsp; &emsp; "redirect_urls": { <br/>
                                        &nbsp; &emsp;&emsp;    "return_url": "https://example.com/your_redirect_url.html", <br/>
                                        &nbsp; &emsp;&emsp;    "cancel_url": "https://example.com/your_cancel_url.html" <br/>
                                        &nbsp;   }, <br/>
                                        &nbsp; &emsp; "payer": { <br/>
                                        &nbsp; &emsp;&emsp; "payment_method": "paypal" <br/>
                                        &nbsp;   }, <br/>
                                        &nbsp; &emsp; "transactions": [{ <br/>
                                        &nbsp; &emsp;&emsp; "amount": { <br/>
                                        &nbsp; &emsp;&emsp;&emsp;      "total": "7.47", <br/>
                                        &nbsp; &emsp;&emsp;&emsp;      "currency": "BRL" <br/>
                                        &nbsp; &emsp;&emsp;    } <br/>
                                        &nbsp; &emsp;}] <br/>
                                        &nbsp; }' </span><br/>                                    
                                      </p>
                                    <p class="card-text"><small class="text-muted">Mais exemplos de samples abaixo</small></p>

                                </div>
                                
                                <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><b>Get token:</b> <a href="#">Link</a></li>
                                  <li class="list-group-item"><b>Trigger:</b> Page load (payment option check etc)</li>
                                  <li class="list-group-item"><b>Action:</b> Renders the PayPal Plus form</li>
                                  <li class="list-group-item"><b>Parameters:</b> <a href="https://developer.paypal.com/docs/api/payments/v1/" target="_blank">See all</a></li>
                                  <li class="list-group-item"><b>Source:</b> createPayment( ) function</li>
                                </ul>
                                
                                  <div class="card-footer text-muted">
                                      <!--<a href="#" class="btn btn-primary">Node</a>-->
                                      <!--<a href="#" class="btn btn-primary">PHP</a>-->
                                      <!--<a href="#" class="btn btn-primary">Python</a>-->
                                      <!--<a href="#" class="btn btn-primary">Ruby</a>-->
                                      <!--<a href="#" class="btn btn-primary">Java</a>-->
                                      <!--<a href="#" class="btn btn-primary">.Net</a>-->
                                      <!--<a href="#" class="btn btn-primary">Postman</a>-->
                                      
                                      <div class="btn-group" role="group" aria-label="Basic example">
                                          <a href="https://developer.paypal.com/docs/api/quickstart/payments/?mark=node#define-payment" class="btn btn-primary" target="_blank">Node</a>
                                          <a href="https://developer.paypal.com/docs/api/quickstart/payments/?mark=php#define-payment" class="btn btn-primary" target="_blank">PHP</a>
                                          <a href="https://developer.paypal.com/docs/api/quickstart/payments/?mark=python#define-payment" class="btn btn-primary" target="_blank">Python</a>
                                          <a href="https://developer.paypal.com/docs/api/quickstart/payments/?mark=ruby#define-payment" class="btn btn-primary" target="_blank">Ruby</a>
                                          <a href="https://developer.paypal.com/docs/api/quickstart/payments/?mark=java#define-payment" class="btn btn-primary" target="_blank">Java</a>
                                          <a href="https://developer.paypal.com/docs/api/quickstart/payments/?mark=.net#define-payment" class="btn btn-primary" target="_blank">.Net</a>
                                          <a href="https://developer.paypal.com/docs/api/overview/#make-your-first-call" class="btn btn-primary" target="_blank">Postman</a>
                                      </div>

                                  </div>


                                
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">Response JSON</h5>
                                    <!--<p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>-->
                                    <!--<div id="CreatePaymentJsonResponseOutput"></div>-->
                                    <div class="form-group textarea-div">

                                        <textarea id="CreatePaymentJsonResponseOutputTextArea" class="form-control" readonly> </textarea>

                                    </div>
                                    <p class="card-text"><small class="text-muted" id="createTimeDiv">Aguardando a requisição</small></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!--Execute Payment-->
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  3. Execute Payment
                </button>
                <span id="executePaymentWaitingNotification" class="badge badge-warning float-right">Waiting</span>

                <span id="executePaymentNotification" class="badge badge-success float-right"></span>
              </h5>
                    </div>

                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-group">
                            
                                                        <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">Request</h5>
                                    <!--<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>-->
                                    
                                      <p class="card-text bg-dark text-light">
                                        &nbsp; curl -v https://api.sandbox.paypal.com/v1/payments/payment/PAY-9N9834337A9191208KOZOQWI/execute \ <br/>
                                        &nbsp; -H "Content-Type: application/json" \ <br/>
                                        &nbsp; -H "Authorization: Bearer <a href="#"><span class="accessTokenTag">&lt;Access-Token&gt;	</span></a> " \ <br/>
                                        &nbsp; -d <span class="codeFont">'{ <br/>
                                        &emsp; "payer_id": "CR87QHB7JTRSC" <br/>
                                        &nbsp; }' </span><br/>                                    
                                      </p>
                                    <p class="card-text"><small class="text-muted">Mais exemplos de samples abaixo</small></p>


                                </div>
                                
                                <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><b>Trigger:</b> PayPal Checkout Button <img src="PPEC/pp-ec-button.png"></img> </li>
                                  <li class="list-group-item"><b>Action:</b> Calls the incontext PayPal Auth form
                                  <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                                      Exibir
                                    </button>
                                  </li>
                                  <li class="list-group-item"><b>Source:</b> createPayment( ) function</li>
                                  <li class="list-group-item"><b>Parameters:</b> <a href="https://developer.paypal.com/docs/api/payments/v1/" target="_blank">See all</a></li>
                                </ul>
                                
                                  <div class="card-footer text-muted">
                                      <!--<a href="#" class="btn btn-primary">Node</a>-->
                                      <!--<a href="#" class="btn btn-primary">PHP</a>-->
                                      <!--<a href="#" class="btn btn-primary">Python</a>-->
                                      <!--<a href="#" class="btn btn-primary">Ruby</a>-->
                                      <!--<a href="#" class="btn btn-primary">Java</a>-->
                                      <!--<a href="#" class="btn btn-primary">.Net</a>-->
                                      <!--<a href="#" class="btn btn-primary">Postman</a>-->
                                      
                                      <div class="btn-group" role="group" aria-label="Basic example">
                                          <a href="https://developer.paypal.com/docs/api/quickstart/payments/?mark=node#execute-payment" class="btn btn-primary" target="_blank">Node</a>
                                          <a href="https://developer.paypal.com/docs/api/quickstart/payments/?mark=php#execute-payment" class="btn btn-primary" target="_blank">PHP</a>
                                          <a href="https://developer.paypal.com/docs/api/quickstart/payments/?mark=python#execute-payment" class="btn btn-primary" target="_blank">Python</a>
                                          <a href="https://developer.paypal.com/docs/api/quickstart/payments/?mark=ruby#execute-payment" class="btn btn-primary" target="_blank">Ruby</a>
                                          <a href="https://developer.paypal.com/docs/api/quickstart/payments/?mark=java#execute-payment" class="btn btn-primary" target="_blank">Java</a>
                                          <a href="https://developer.paypal.com/docs/api/quickstart/payments/?mark=.net#execute-payment" class="btn btn-primary" target="_blank">.Net</a>
                                          <a href="https://developer.paypal.com/docs/api/overview/#make-your-first-call" class="btn btn-primary" target="_blank">Postman</a>
                                      </div>
                                  </div>
                            </div>

                            
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">Response JSON</h5>
                                    <!--<p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>-->
                                    <!--<div id="ExecutePaymentJsonResponseOutput"></div>-->
                                    <textarea id="ExecutePaymentJsonResponseOutputTextArea" class="form-control" readonly> </textarea>

                                    <p class="card-text"><small class="text-muted" id="executeTimeDiv">Aguardando a requisição</small></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- acordion -->

        </div>    
    </div>
</div>
<!--here-->

<br>

<div class="container">
    <div class="row">
        <div class="col">
            <center>
                <button class="btn btn-primary" onclick="generateCC()">Generate New Credit Card</button>
            </center>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <center>
                <label id="lastCC" style='border: 1px solid black'>4826580432389372</label>
            </center>
        </div>
    </div>
</div>
<script>
    sessionStorage.removeItem('approval_url')
</script>
<!--credit card number genarte-->
<script src="/PPP/cc-generate.js" type="text/javascript"> </script>

<!--call the create payment function from php-->
<script src="/PPP/create-payment.js" type="text/javascript"> </script>

<!-- Render the PayPal Plus iFrame using the following Javascript example -->
<!--<script src="/PPP/script.js" type="text/javascript"> </script>-->

<!-- 4 PPP iFrame interaction u need to implement a client-side JS listener that receive every postMessage() from PayPal Plus application.-->
<script src="/PPP/listener.js" type="text/javascript"> </script>



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
    .accessTokenTag{
        color: #f59000;
    }
    
</style>
