<?php



class Routes{
    public function checkCredentials($content){
        file_put_contents('_content.txt',$content);

        $require_path = $_SERVER['DOCUMENT_ROOT']."/Credentials/credentials.php";
        require_once($require_path);
        
        $credentials = new Credentials();
        if($credentials->checkCredentials()){
            // $this->myRoute($content);
            $this->route($content);
        }else{
            require_once("Credentials/index.php");

        }
    }
    
    public function myRoute($content){
      file_put_contents('_content.txt',$content);
      if($content == 'home'){
          require_once("home.php");
      }else{
          require_once($content."/index.php");
      }
    }
    
    public function route($content){
        
        switch($content){
            case "home":
                require_once("home.php");
                break;
            case "credentials":
                require_once("Credentials/index.php");
                break;
            case "ppp":
                require_once("PPP/index.php");
                break;
            case "ppp-ctb":
                require_once("PPP-CTB/index.php");
                break;
            case "ppec":
                require_once("PPEC/index.php");
                break;
            case "ppec-v2":
                require_once("PPEC-V2/index.php");
                break;
            case "payouts":
                require_once("Payouts/index.php");
                break;
            case "refund":
                require_once("Refund/index.php");
                break;
            case "search": // ????????????????????
                require_once("Search/index.php");
                break;
            case "invoicing":
                require_once("Invoicing/index.php");
                break;
            case "payment":
                require_once("Reports/payment.php");
                break;
            case "payments":
                require_once("Reports/payments.php");
                break;
            case "plans":
                require_once("Reports/plans.php");
                break;
            case "plan":
                require_once("Reports/plan.php");
                break;
            case "agreements":
                require_once("Reports/agreements.php");
                break;
            case "agreement-details":
                require_once("Reports/agreement-details.php");
                break;
            case "agreement-transactions":
                require_once("Reports/agreement-transactions.php");
                break;
            case "transactions":
                require_once("Reports/transactions.php");
                break;
            case "transaction":
                require_once("Reports/transaction.php");
                break;
            case "ppec-nvp":
                require_once("PPEC-NVP/index.php");
                break;
            case "ec-client":
                require_once("EC-Client/index.php");
                break;
            case "sub":
                require_once("Subscriptions/index.php");
                break;
            case "token":
                require_once("TOKEN/index.php");
                break;
            case "token-update":
                require_once("TOKEN-UPDATE/index.php");
                break;
            case "ref":
                require_once("REF/index.php");
                break;
            case "ref-rest":
                require_once("REF-REST/index.php");
                break;
            case "ref-rest-installs":
                require_once("REF-REST-INSTALLS/index.php");
                break;
            case "ec-scan":
                require_once("EC-SCAN/index.php");
                break;
            case "ec-bt":
                require_once("EC-BT/index.php");
                break;
            case "return":
                require_once("Subscriptions/return.php");
                break;
            case "cancel":
                require_once("Subscriptions/cancel.php");
                break;

        }
        
    }   
}

?>