<?php
    $tokenAgreement = new stdClass();
    
    // if(file_exists('REF-REST/_responseAgreementCreate.json')){ //php
    if(file_exists('_responseAgreementCreate.json')){ //js
    $tokenAgreement->check = true;
    }else{
        $tokenAgreement->check = false;
    }
    $path = file_get_contents('_responseAgreementCreate.json') ;
    $json = json_decode($path); // decode the JSON into an associative array
    $BillingAgreementId = $json->id;
    $BillingAgreementState = $json->state;
    
    
    $tokenAgreement->id = $BillingAgreementId;
    $tokenAgreement->state = $BillingAgreementState;
    
    echo json_encode($tokenAgreement);
?>