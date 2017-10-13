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
        $company=new company($this->adapter);
        $company=$company->getAll();
        $invoices=new documentsModel($this->adapter);
        $invoices=$invoices->getInvoices();
        $invoices=($invoices==false ? array():$invoices);
        //var_dump($invoice_header);
        $this->view("index",array(
            "viewDashboard"=>'invoices',
            "allOptions"=>$this->allOptions,
            "company"=>$company,
            "title"=>"Invoices",
            "invoices"=>$invoices
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
        //Get the company info for the template   
        $companyId=$_POST['selectTemplate'];  
        $company=new company($this->adapter);
        $company=$company->getById($companyId);

        //creating a blank invoice header
        $invoice=new invoice_header($this->adapter);
        $invoice->setCompany($companyId);
        $invoice->setUser($_SESSION['id']);
        date_default_timezone_set('America/New_York');
        $date=date("Y-m-d");
        $invoice->setDateInvoice($date); 
        $invoice->save();
        $invoice_id=$invoice->getId();
        $invoice=$invoice->getById($invoice_id);
        //
        $this->view("index",array(
            "viewDashboard"=>'invoice',
            "allOptions"=>$this->allOptions,
            "company"=>$company,
            "invoice_id"=>$invoice_id,
            "invoice"=>$invoice,
            "title"=>"New Invoice"
        ));
    }

    public function edit(){
        //get the id for the url
        $invoice_id=(isset($_GET["i"])?$_GET["i"]:"");

        //creating the invoice object
        $invoice=new invoice_header($this->adapter);
        $invoice=$invoice->getById($invoice_id);

        //creating the company object
        $company=new company($this->adapter);
        $company=$company->getById($invoice["company"]);

        //getting the body
        $document_body=new documentsModel($this->adapter);
        $document_body=$document_body->getDocumentBody($invoice_id);
        $this->view("index",array(
            "viewDashboard"=>'invoice',
            "allOptions"=>$this->allOptions,
            "company"=>$company,
            "invoice_id"=>$invoice_id,
            "invoice"=>$invoice,
            "document_body"=>$document_body,
            "title"=>"Edit Invoice"
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
        $invoice->setDateInvoice($date);  
        $invoice->setUser($_SESSION['id']); 
        $invoice->save();
        //saving body data
        $tableItems=json_decode(stripslashes($_POST['tableItems']));
        $invoices=new documentsModel($this->adapter);
        $invoices=$invoices->saveDocumentBody($tableItems);
        //var_dump($tableItems);

        $this->redirect("document", "index");
       
    }
     
       
}
?>