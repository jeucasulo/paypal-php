installs
<div class="container" id="tokenDiv">
    <div class="row">

        <div class="col">
            <!-- paypalbutton -->
            <h1 class="text-center"><div id="paypal-button"></div></h1>

        </div>
    </div>
</div>

<div class="container">
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
                  2. Create Billing Token
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
                                        &nbsp;curl -v https://api.sandbox.paypal.com/v1/billing-agreements/agreement-tokens \ <br/>
                                        &nbsp;-H "Content-Type: application/json" \ <br/>
                                        &nbsp;-H "Authorization: Bearer <a href="#"><span class="accessTokenTag">&lt;Access-Token&gt;	</span></a> " \ <br/>
                                        &nbsp;-d <span class="codeFont">'{ <br/>
                                        &nbsp;&emsp;"description": "Billing Agreement",</br>
                                        &nbsp;&emsp;"shipping_address":</br>
                                        &nbsp;&emsp;{</br>
                                        &nbsp;&emsp;&emsp;"line1": "1350 North First Street",</br>
                                        &nbsp;&emsp;&emsp;    "city": "San Jose",</br>
                                        &nbsp;&emsp;&emsp;    "state": "CA",</br>
                                        &nbsp;&emsp;&emsp;    "postal_code": "95112",</br>
                                        &nbsp;&emsp;&emsp;    "country_code": "US",</br>
                                        &nbsp;&emsp;&emsp;    "recipient_name": "John Doe"</br>
                                        &nbsp;&emsp;},</br>
                                        &nbsp;&emsp;"payer":</br>
                                        &nbsp;&emsp;{</br>
                                        &nbsp;&emsp;&emsp;"payment_method": "PAYPAL"</br>
                                        &nbsp;&emsp;},</br>
                                        &nbsp;&emsp;"plan":</br>
                                        &nbsp;&emsp;{</br>
                                        &nbsp;&emsp;&emsp;"type": "MERCHANT_INITIATED_BILLING",</br>
                                        &nbsp;&emsp;&emsp;"merchant_preferences":</br>
                                        &nbsp;&emsp;&emsp;{</br>
                                        &nbsp;&emsp;&emsp;&emsp;"return_url": "https://example.com/return",</br>
                                        &nbsp;&emsp;&emsp;&emsp;"cancel_url": "https://example.com/cancel",</br>
                                        &nbsp;&emsp;&emsp;&emsp;"notify_url": "https://example.com/notify",</br>
                                        &nbsp;&emsp;&emsp;&emsp;"accepted_pymt_type": "INSTANT",</br>
                                        &nbsp;&emsp;&emsp;&emsp;"skip_shipping_address": false,</br>
                                        &nbsp;&emsp;&emsp;&emsp;"immutable_shipping_address": true</br>
                                        &nbsp;&emsp;&emsp;}</br>
                                        &nbsp;&emsp;}</br>
                                        &nbsp;}</br>
                                      </p>
                                    <p class="card-text"><small class="text-muted">Mais exemplos de samples abaixo</small></p>

                                </div>
                                
                                <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><b>Get token:</b> <a href="#">Link</a></li>
                                  <li class="list-group-item"><b>Trigger:</b> PayPal Checkout Button <img src="REF-REST-INSTALLS/pp-ec-button.png"></img> </li>
                                  <li class="list-group-item"><b>Action:</b> Calls the incontext PayPal Auth form
                                  <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                                      Exibir
                                    </button>
                                  </li>
                                  <li class="list-group-item"><b>Parameters:</b> <a href="https://developer.paypal.com/docs/api/payments/v1/" target="_blank" data-toggle="modal" data-target=".bd-example-modal-xl">See all</a></li>
                                  <li class="list-group-item"><b>Source:</b> billingToken( ) function</li>
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
                  3. Create Billing Agreement
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
                                        &nbsp; curl -v https://api.sandbox.paypal.com/v1/billing-agreements/agreements \ <br/>
                                        &nbsp; -H "Content-Type: application/json" \ <br/>
                                        &nbsp; -H "Authorization: Bearer <a href="#"><span class="accessTokenTag">&lt;Access-Token&gt;	</span></a> " \ <br/>
                                        &nbsp; -d <span class="codeFont">'{ <br/>
                                        &emsp; "token_id": "(token_id)" <br/>
                                        &nbsp; }' </span><br/>                                    
                                      </p>
                                    <p class="card-text"><small class="text-muted">Mais exemplos de samples abaixo</small></p>


                                </div>
                                
                                <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><b>Trigger:</b> PayPal Checkout Button <img src="REF-REST-INSTALLS/pp-execute-btn - bt.png"></img> </li>
                                  <li class="list-group-item"><b>Action:</b> Billing Agreement
                                  <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter2">
                                      Exibir
                                    </button>
                                  </li>
                                  <li class="list-group-item"><b>Source:</b> billingAgreement( ) function</li>
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
        <img src="REF-REST-INSTALLS/pp-auth-form.png"></img>
      </div>
  </div>
</div>
<!--modals-->


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-body">
        <img src="REF-REST-INSTALLS/pp-billingAgreementContinue.png"></img>
      </div>
  </div>
</div>
<!--modals-->



<!-- parameters modal -->
<!-- Extra large modal -->

<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Parameter</th>
              <th scope="col">Description</th>
              <th scope="col">Value</th>
              <th scope="col">Type</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row"><span class="badge badge-secondary">intent</span></th>
              <td>The payment intent. Value is:</td>
              <td>  
                    <span class="badge badge-secondary">sale</span> Makes an immediate payment.<br>
                    <span class="badge badge-secondary">authorize</span> Authorizes a payment for capture later.<br>
                    <span class="badge badge-secondary">order</span> Creates an order.<br>
              </td>
              <td><span class="text-primary">enum</span> <span class="text-danger">required</span></td>
            </tr>
            
            <tr>
              <th scope="row"><span class="badge badge-secondary">payer</span></th>
              <td>The source of the funds for this payment. Payment method is PayPal Wallet payment or bank direct debit.</td>
              <td>  
                    <span class="badge badge-secondary">"payment_method": "paypal"</span><br>
              </td>
              <td><span class="text-primary">object</span> <span class="text-danger">required</span></td>
            </tr>
            
            <tr>
              <th scope="row"><span class="badge badge-secondary">transactions</span></th>
              <td>An array of payment-related transactions. A transaction defines what the payment is for and who fulfills the payment. For update and execute payment calls, the transactions object accepts the <i>amount</i> object only.</td>
              <td>  
                    <span class="badge badge-secondary">amount</span><br>
                    <span class="badge badge-secondary">description</span><br>
                    <span class="badge badge-secondary">custom</span><br>
                    <span class="badge badge-secondary">invoice_number</span><br>
                    <span class="badge badge-secondary">payment_options</span><br>
                    <span class="badge badge-secondary">soft_descriptor</span><br>
                    <span class="badge badge-secondary">item_list</span><br>
              </td>
              <td><span class="text-primary">array</span> <span class="text-muted"></span></td>
            </tr>
            
            <tr>
              <th scope="row"><span class="badge badge-secondary">experience_profile_id </span></th>
              <td>An array of payment-related transactions. A transaction defines what the payment is for and who fulfills the payment. For update and execute payment calls, the transactions object accepts the <i>amount</i> object only.</td>
              <td>  
                    <span class="badge badge-secondary">&lt;experience_profile_id&gt;	</span><br>
              </td>
              <td><span class="text-primary">string</span></td>
            </tr>
            
            <tr>
              <th scope="row"><span class="badge badge-secondary">note_to_payer  </span></th>
              <td>A free-form field that clients can use to send a note to the payer. <b>Maximum length: 165</b>.</td>
              <td>  
                    <span class="badge badge-secondary">"note_to_payer": "Contact us for any questions on your order."</span><br>
              </td>
              <td><span class="text-primary">string</span></td>
            </tr>
            
            <tr>
              <th scope="row"><span class="badge badge-secondary">redirect_urls</span></th>
              <td>A set of redirect URLs that you provide for PayPal-based payments.</td>
              <td>  
                    <span class="badge badge-secondary">return_url</span><br>
                    <span class="badge badge-secondary">cancel_url</span><br>
              </td>
              <td><span class="text-primary">object</span></td>
            </tr>



          </tbody>
        </table>
        

    </div>
  </div>
</div>

<br>
<br>
<br>

<div class="container" id="chooseInstallsDiv">
    <div class="row">

        <div class="col">
            <!-- paypalbutton -->
            <h6 class="text-center">
              <div id="create-payment">
                <h3>Selecione o número de parcelas</h3>
                <select name="chooseInstallsSelect" id="chooseInstallsSelect">
                  <!--<option value="1">1 - (1%) &nbsp;&nbsp;</option>-->
                  <!--<option value="2">2 - (2%) &nbsp;&nbsp;</option>-->
                  <!--<option value="3">3 - (3%) &nbsp;&nbsp;</option>-->
                  <!--<option value="4">4 - (4%) &nbsp;&nbsp;</option>-->
                  <!--<option value="5">5 - (5%) &nbsp;&nbsp;</option>-->
                  <!--<option value="6">6 - (6%) &nbsp;&nbsp;</option>-->
                  <!--<option value="7">7 - (7%) &nbsp;&nbsp;</option>-->
                  <!--<option value="8">8 - (8%) &nbsp;&nbsp;</option>-->
                  <!--<option value="9">9 - (9%) &nbsp;&nbsp;</option>-->
                  <!--<option value="10">10 - 10% &nbsp;&nbsp;</option>-->
                  <!--<option value="11">11 - 11% &nbsp;&nbsp;</option>-->
                  <!--<option value="12">12 - 12% &nbsp;&nbsp;</option>-->
                </select>
                <h3 id="finalVlues" class="d-none">
                      
                      
                      <span id='termsText'></span>x de R$
                      <span id='totalMountlyText'></span>&nbsp;Total: R$ 
                      <span id='totalAmountText'></span>&nbsp;

                </h3>
              </div>
            </h6>
        </div>
    </div>
</div>


<div class="container disabledbutton" id="payDiv">
    <div class="row">

        <div class="col">
            <!-- paypalbutton -->
            <h6 class="text-center">
              <div id="create-payment">
                <h6>Total: <span id="totalWithTax"></span> </h6>
                <select name="cfoSelect" id="cfoSelect"></select>
                <button id="createPayment" class="btn btn-success">Pay</button>
              </div>
            </h6>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">

        <div class="col">

            <!--HERE-->

            <div id="accordion">

                <!--Get Token-->
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                <!--<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">-->

                  1. Get Token
                </button>
                <span id="getTokenWaitingNotification2" class="badge badge-warning float-right">Waiting</span>
                <span id="getTokenNotification2" class="badge badge-success float-right"></span>

              </h5>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
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
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                  2. Caculated Financing Options
                </button>
                <span id="cfoWaitingNotification2" class="badge badge-warning float-right">Waiting</span>
                <span id="cfoNotification2" class="badge badge-success float-right"></span>
              </h5>
                    </div>

                    <div id="collapseFive" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-group">
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">Request (cURL)</h5>
                                    <!--<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>-->
                                    
                                      <p class="card-text bg-dark text-light">
                                        &nbsp; curl -v https://api.sandbox.paypal.com/v1/credit/calculated-financing-options \ <br/>
                                        &nbsp; -H "Content-Type: application/json" \ <br/>
                                        &nbsp; -H "Authorization: Bearer <a href="#"><span class="accessTokenTag">&lt;Access-Token&gt;	</span></a> " \ <br/>
                                        &nbsp; -d <span class="codeFont">'{ <br/>
                                        &nbsp; &emsp; "financing_country_code": "BR", <br/>
                                        &nbsp; &emsp; "transaction_amount": { <br/>
                                        &nbsp; &emsp;&emsp;    "value": "100", <br/>
                                        &nbsp; &emsp;&emsp;    "currency_code": "BRL" <br/>
                                        &nbsp; &emsp;}, <br/>
                                        &nbsp; &emsp; "funding_instrument": { <br/>
                                        &nbsp; &emsp;&emsp; "type": "BILLING_AGREEMENT", <br/>
                                        &nbsp; &emsp;&emsp; "billing_agreement":{ <br/>
                                        &nbsp; &emsp;&emsp;&emsp; "billing_agreement_id":"(billing_agreement_id)" <br/>
                                        &nbsp; &emsp;&emsp; } <br/>
                                        &nbsp; &emsp;}' <br/>                                      </p>
                                    <p class="card-text"><small class="text-muted">Mais exemplos de samples abaixo</small></p>

                                </div>
                                
                                <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><b>Get token:</b> <a href="#">Link</a></li>
                                  <!--<li class="list-group-item"><b>Trigger:</b> PayPal Checkout Button <img src="REF-REST-INSTALLS/pp-ec-button.png"></img> </li>-->
                                  <li class="list-group-item"><b>Trigger:</b>RegularStoreButton<button class="btn btn-success btn-sm">Pay</button> </li>
                                  <li class="list-group-item"><b>Action:</b>Use the BillingAgreementToken to execute the payment</li>
                                  <li class="list-group-item"><b>Parameters:</b> <a href="https://developer.paypal.com/docs/api/payments/v1/" target="_blank" data-toggle="modal" data-target=".bd-example-modal-xl">See all</a></li>
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

                                        <textarea id="cfoJsonResponseOutputTextArea" class="form-control" readonly> </textarea>

                                    </div>
                                    <p class="card-text"><small class="text-muted" id="createTimeDiv">Aguardando a requisição</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                
                
                
                <!--Create Payment-->
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                  3. Create Payment
                </button>
                <span id="createPaymentWaitingNotification2" class="badge badge-warning float-right">Waiting</span>
                <span id="createPaymentNotification2" class="badge badge-success float-right"></span>
              </h5>
                    </div>

                    <div id="collapseSix" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-group">
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">Request (cURL)</h5>
                                    <!--<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>-->
                                    
                                      <p class="card-text bg-dark text-light">
                                        &nbsp; curl -v https://api.sandbox.paypal.com/v1/payments/payment \ <br/>
                                        &nbsp; -H "Content-Type: application/json" \ <br/>
                                        &nbsp; -H "Authorization: Bearer <a href="#"><span class="accessTokenTag">&lt;Access-Token&gt;	</span></a> " \ <br/>
                                        &nbsp; -d <span class="codeFont">'{ <br/>
                                        &nbsp; &emsp; "intent": "sale", <br/>
                                        &nbsp; &emsp; "redirect_urls": { <br/>
                                        &nbsp; &emsp;&emsp;    "return_url": "https://example.com/your_redirect_url.html", <br/>
                                        &nbsp; &emsp;&emsp;    "cancel_url": "https://example.com/your_cancel_url.html" <br/>
                                        &nbsp; &emsp;}, <br/>
                                        &nbsp; &emsp; "payer": { <br/>
                                        &nbsp; &emsp;&emsp; "payment_method": "paypal", <br/>
                                        &nbsp; &emsp;&emsp; "funding_instruments":[ <br/>
                                        &nbsp; &emsp;&emsp; { <br/>
                                        &nbsp; &emsp;&emsp;&emsp; "billing": <br/>
                                        &nbsp; &emsp;&emsp;&emsp; { <br/>
                                        &nbsp; &emsp;&emsp;&emsp;&emsp; "billing_agreement_id":"(billing_agreement_id)" <br/>
                                        &nbsp; &emsp;&emsp;&emsp; } <br/>
                                        &nbsp; &emsp;&emsp; }] <br/>
                                        &nbsp; &emsp;}, <br/>
                                        &nbsp; &emsp; "transactions": [{ <br/>
                                        &nbsp; &emsp;&emsp; "amount": { <br/>
                                        &nbsp; &emsp;&emsp;&emsp;      "total": "7.47", <br/>
                                        &nbsp; &emsp;&emsp;&emsp;      "currency": "BRL" <br/>
                                        &nbsp; &emsp;&emsp;    } <br/>
                                        &nbsp; &emsp;}] <br/>
                                        &nbsp; &emsp;}' </span><br/>                                    
                                      </p>
                                    <p class="card-text"><small class="text-muted">Mais exemplos de samples abaixo</small></p>

                                </div>
                                
                                <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><b>Get token:</b> <a href="#">Link</a></li>
                                  <!--<li class="list-group-item"><b>Trigger:</b> PayPal Checkout Button <img src="REF-REST-INSTALLS/pp-ec-button.png"></img> </li>-->
                                  <li class="list-group-item"><b>Trigger:</b>RegularStoreButton<button class="btn btn-success btn-sm">Pay</button> </li>
                                  <li class="list-group-item"><b>Action:</b>Use the BillingAgreementToken to execute the payment</li>
                                  <li class="list-group-item"><b>Parameters:</b> <a href="https://developer.paypal.com/docs/api/payments/v1/" target="_blank" data-toggle="modal" data-target=".bd-example-modal-xl">See all</a></li>
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
            </div>
        </div>
    </div>
</div>
       
<hr>   
<div class="container">
  <div class="row">
    <div class="col">
      <button id="inactiveButton" class="btn btn-danger">Desvincular conta</button>
    </div>
  </div>
</div>





<script src="REF-REST-INSTALLS/jquery-3.3.1.min.js"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<!--<div id="containerControllers">-->

<!--</div>-->

<script src="REF-REST-INSTALLS/ec-button.js"></script>

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
    .disabledbutton {
      pointer-events: none;
      opacity: 0.4;
    }
    
</style>

<script type="text/javascript" src="REF-REST-INSTALLS/check-token.js"></script>
<script type="text/javascript" src="REF-REST-INSTALLS/inactive-token.js"></script>
<script type="text/javascript" src="REF-REST-INSTALLS/create-payment.js"></script>
<script type="text/javascript" src="REF-REST-INSTALLS/calculated-financing-options.js"></script>




<script>
  $("#chooseInstallsSelect").change(function(){
    let installmentsTerms = $("#chooseInstallsSelect").val();
    // alert(installmentsTerms);
    // let value = 100 + (100/100*installmentsTerms);
    // alert(value);
    // calculatedFinancingOptions(value);   
    let totalAmount = $('#chooseInstallsSelect option:selected').attr('totalAmount');
    let totalMountly = $('#chooseInstallsSelect option:selected').attr('totalMountly');
    let terms = $(this).val();
    
    $("#totalAmountText").text(totalAmount);
    $("#totalMountlyText").text(totalMountly);
    $("#termsText").text(terms);
    $("#finalVlues").removeClass('d-none');
  });

  // $("#totalAmount").text(installsments);
</script>