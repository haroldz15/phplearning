<?php
class appController extends baseController{
     
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
        $this->allOptions=$options->getOptions($flags);   
    }
     

     //this action is called so it creates a user that is being refered in the base controller wich load all the models
    public function index(){
        $this->view("index",array(
            "viewDashboard"=>'blank',
            "allOptions"=>$this->allOptions
        ));
    }

    public function invoices(){
        $this->redirect("document", "index");
    }
/*
    public function newInvoice(){
        $company=new company($this->adapter);
        $company=$company->getAll();
        $this->view("index",array(
            "viewDashboard"=>'newInvoice',
            "allOptions"=>$this->allOptions,
            "company"=>$company
        ));
    }*/
     
       
}
?>