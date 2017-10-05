<?php
class authController extends baseController{
     
    public function __construct() {
        parent::__construct();
        $this->connect=new connect();
        $this->adapter=$this->connect->connection();
        $this->defaultAction="login";
    }
     

     //this action is called so it creates a user that is being refered in the base controller wich load all the models
    public function index(){
                 //creates a user object
        $user=new user($this->adapter);
         
         // get the array of users with the method get all 
        //Conseguimos todos los usuarios
        $allusers=$user->getAll();
        
        //Cargamos la vista index y le pasamos valores
        $this->view("index",array(
            "allusers"=>$allusers,
            "Hola"    =>"Soy Víctor Robles"
        ));
    }
     
       
}
?>