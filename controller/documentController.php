<?php
class documentController extends baseController{
     
    public function __construct() {
        
        parent::__construct();
        $this->connect=new connect();
        $this->adapter=$this->connect->connection();
        $this->defaultAction="index";
        //Check Login
        $loginCheck=new usersModel($this->adapter);
        $loginCheck=$loginCheck->loginCheck();
        if(!$loginCheck){parent::redirect('auth','login');}

        $this->allOptions=array();
        $options=new optionsModel($this->adapter);
        $flags=$_SESSION['flags']; 
        //echo $flags;
        $this->allOptions=$options->getOptions($flags);  

    }
     

     //this action is called so it creates a user that is being refered in the base controller wich load all the models
    public function index(){
        echo "index";
    }

    public function invoices(){
        $company=new company($this->adapter);
        $company=$company->getAll();
        $invoices=new documentsModel($this->adapter);
        $invoices=$invoices->getInvoices();
        $invoices=($invoices==false ? array():$invoices);
        $documentType="invoice";
        //var_dump($invoice_header);
        $this->view("index",array(
            "viewDashboard"=>'documents',
            "allOptions"=>$this->allOptions,
            "company"=>$company,
            "title"=>"Invoices",
            "documentType"=>$documentType,
            "documents"=>$invoices
        ));
    }

    public function estimates(){

        $company=new company($this->adapter);
        $company=$company->getAll();
        $estimates=new documentsModel($this->adapter);
        $estimates=$estimates->getEstimates();
        $estimates=($estimates==false ? array():$estimates);
        $documentType="estimate";

        $this->view("index",array(
            "viewDashboard"=>'documents',
            "allOptions"=>$this->allOptions,
            "company"=>$company,
            "title"=>"Estimates",
            "documentType"=>$documentType,
            "documents"=>$estimates
        ));

    }

    public function delete () {
        $invoice_id=(isset($_GET["i"])?$_GET["i"]:"");
        $orderId=(isset($_GET["i2"])?$_GET["i2"]:"");
        $invoices=new documentsModel($this->adapter);
        $invoices=$invoices->deleteItem($invoice_id,$orderId);
        echo $invoices;
    }

    public function create(){
        $documentType=$_POST['documentType'];
        $companyId=$_POST['selectTemplate'];  
        $company=new company($this->adapter);
        $company=$company->getById($companyId);
        date_default_timezone_set('America/New_York');
        $date=date("Y-m-d");
 
        switch ($documentType) {
            case 'invoice':
                //creating a blank invoice header
                $invoice=new invoice_header($this->adapter);
                $invoice->setCompany($companyId);
                $invoice->setUser($_SESSION['id']);
                $invoice->setDateDocument($date); 
                $invoice->save();
                $invoice_id=$invoice->getId();
                $invoice=$invoice->getById($invoice_id);
                //
                $this->view("index",array(
                    "viewDashboard"=>'document',
                    "allOptions"=>$this->allOptions,
                    "company"=>$company,
                    "document_id"=>$invoice_id,
                    "document"=>$invoice,
                    "title"=>"New Invoice"
                ));

                break;
            case 'estimate':
                //creating a blank estimate header
                $estimate=new estimate_header($this->adapter);
                $estimate->setCompany($companyId);
                $estimate->setUser($_SESSION['id']);
                $estimate->setDateDocument($date); 
                $estimate->save();
                $estimate_id=$estimate->getId();
                $estimate=$estimate->getById($estimate_id);
                //estimate

                $this->view("index",array(
                    "viewDashboard"=>'document',
                    "allOptions"=>$this->allOptions,
                    "company"=>$company,
                    "document_id"=>$estimate_id,
                    "document"=>$estimate,
                    "title"=>"New Estimate"
                ));
                break;            
            default:
                # code...
                break;
        }


    }

    public function edit(){
        $documentType=(isset($_GET["i"])?$_GET["i"]:"");
        $document_id=(isset($_GET["i2"])?$_GET["i2"]:"");

        switch ($documentType) {
            case 'invoice':
                $document=new invoice_header($this->adapter);
                break;
            case 'estimate':
                $document=new estimate_header($this->adapter);
                break;            
            default:
                # code...
                break;
        }
        $document=$document->getById($document_id);

        //creating the company object
        $company=new company($this->adapter);
        $company=$company->getById($document["company"]);

        //getting the body
        $document_body=new documentsModel($this->adapter);
        $document_body=$document_body->getDocumentBody($document_id,$documentType.'_body');
        $this->view("index",array(
            "viewDashboard"=>'document',
            "allOptions"=>$this->allOptions,
            "company"=>$company,
            "documentType"=>$documentType,
            "document_id"=>$document_id,
            "document"=>$document,
            "document_body"=>$document_body,
            "title"=>"Edit"
        ));    
    }

    public function save(){
        

        //Getting all the elements from the form to the variables
        $id=filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $company=filter_input(INPUT_POST, 'company', FILTER_SANITIZE_STRING);
        $client_to=filter_input(INPUT_POST, 'client_to', FILTER_SANITIZE_STRING);
        $client_address=filter_input(INPUT_POST, 'client_address', FILTER_SANITIZE_STRING);
        $date_due=filter_input(INPUT_POST, 'date_due', FILTER_SANITIZE_STRING);
        $date_due=date("Y-m-d", strtotime($date_due));
        //echo $date_due;
        $observations=filter_input(INPUT_POST, 'observations', FILTER_SANITIZE_STRING);
        $subtotal=filter_input(INPUT_POST, 'subtotal', FILTER_SANITIZE_STRING);
        $tax=filter_input(INPUT_POST, 'tax', FILTER_SANITIZE_STRING);
        $taxAmount=$tax/100*$subtotal;
        $total=$subtotal+$taxAmount;

        date_default_timezone_set('America/New_York');
        $date=date("Y-m-d");

        //saving header data
        $invoice=new invoice_header($this->adapter);
        $invoice->setId($id); 
        $invoice->setCompany($company); 
        $invoice->setClient_to($client_to); 
        $invoice->setClient_address($client_address);
        $invoice->setDate_due($date_due);
        $invoice->setObservations($observations); 
        $invoice->setSubtotal($subtotal);  
        $invoice->setTax($tax);    
        $invoice->setTaxAmount($taxAmount); 
        $invoice->setTotal($total);  
        $invoice->setDateDocument($date);  
        $invoice->setUser($_SESSION['id']); 
        $invoice->save();
        //saving body data
        $tableItems=json_decode(stripslashes($_POST['tableItems']));
        $invoices=new documentsModel($this->adapter);
        $invoices=$invoices->saveDocumentBody($tableItems);
        //var_dump($tableItems);

        $this->redirect("document", "invoices");
       
    }
     
       
}
?>