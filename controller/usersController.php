<?php
class usersController extends baseController{
     
    public function __construct() {
        parent::__construct();
        $this->connect=new connect();
        $this->adapter=$this->connect->connection();
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
     

    public function login(){
         
        //creates a user object
        // $user=new user($this->adapter);
         
         // get the array of users with the method get all 
        //Conseguimos todos los usuarios
        //$allusers=$user->getAll();
        
        //Cargamos la vista index y le pasamos valores
        $this->view("login",'');
    }
     
    public function create(){
        if(isset($_POST["name"])){
             
            //Creamos un usuario
            $user=new user($this->adapter);
            $user->setName($_POST["name"]);
            $user->setLastname($_POST["lastname"]);
            $user->setEmail($_POST["email"]);
            $user->setPassword(sha1($_POST["password"]));
            $save=$user->save();
        }
        $this->redirect("users", "index");
    }
     
    public function delete(){
        if(isset($_GET["id"])){ 
            $id=(int)$_GET["id"];
             
            $user=new user($this->adapter);
            $user->deleteById($id); 
        }
        $this->redirect();
    }
     
     
    public function hello(){
        $users=new usersModel($this->adapter);
        $usu=$users->getAUser();
        var_dump($usu);
    }
 
}
?>