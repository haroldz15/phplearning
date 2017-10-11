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
        echo 'index';
    }

    public function invoices(){
        $company=new company($this->adapter);
        $company=$company->getAll();
        $this->view("index",array(
            "viewDashboard"=>'invoice',
            "allOptions"=>$this->allOptions,
            "company"=>$company,
            "title"=>"Invoices"
        ));
    }

    public function newInvoice(){   
        $companyId=$_POST['selectTemplate'];  
        $company=new company($this->adapter);
        $company=$company->getById($companyId);
        $this->view("index",array(
            "viewDashboard"=>'newInvoice',
            "allOptions"=>$this->allOptions,
            "company"=>$company,
            "title"=>"New Invoice"
        ));
    }

    public function saveInvoice(){
        $tableItems=json_decode(stripslashes($_POST['tableItems']));

        //Getting all the elements from the form to the variables
        $companyId=filter_input(INPUT_POST, 'companyId', FILTER_SANITIZE_STRING);
        $customerTo=filter_input(INPUT_POST, 'customerTo', FILTER_SANITIZE_STRING);
        $customerAddress=filter_input(INPUT_POST, 'customerAddress', FILTER_SANITIZE_STRING);
        $customerPaymetDate=filter_input(INPUT_POST, 'customerPaymetDate', FILTER_SANITIZE_STRING);
        $invoiceObservations=filter_input(INPUT_POST, 'invoiceObservations', FILTER_SANITIZE_STRING);
        $invoiceSubtotal=filter_input(INPUT_POST, 'invoiceSubtotal', FILTER_SANITIZE_STRING);
        $invoiceTax=filter_input(INPUT_POST, 'invoiceTax', FILTER_SANITIZE_STRING);
        $taxAmount=$invoiceTax/100*$invoiceSubtotal;
        $totalAmount=$invoiceSubtotal+$taxAmount;
        date_default_timezone_set('America/New_York');
        $date=date("m/d/y");

        $invoice_header=new invoice_header($this->adapter);

        //saving header data
        $invoice_header->setCompany($companyId); 
        $invoice_header->setClient_to($customerTo); 
        $invoice_header->setClient_address($customerAddress);
        $invoice_header->setDate_due($customerPaymetDate);
        $invoice_header->setObservations($invoiceObservations); 
        $invoice_header->setSubtotal($invoiceSubtotal);  
        $invoice_header->setTax($invoiceTax);    
        $invoice_header->setTaxAmount($taxAmount); 
        $invoice_header->setTotal($totalAmount);  
        $invoice_header->setDate($date);  
        $invoice_header->setUser($_SESSION['id']); 

        $invoice_header->save();
      
        
        //echo $companyId.'-'.$customerTo.'-'.$customerPaymetDate.'-'.$invoiceObservations.'-'.$invoiceSubtotal.'-'.$invoiceTax.'-'.$taxAmount.'-'.$totalAmount;
        //var_dump($tableItems);
        //invoices();

    }
     
       
}
?>