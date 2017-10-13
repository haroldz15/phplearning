<?php
class usersController extends baseController{
     
    public function __construct() {
        parent::__construct();
        $this->connect=new connect();
        $this->adapter=$this->connect->connection();
        $this->defaultAction="index";

        $loginCheck=new usersModel($this->adapter);
        $loginCheck=$loginCheck->loginCheck();
        if(!$loginCheck){parent::redirect('auth','login');}
    }
     

     //this action is called so it creates a user that is being refered in the base controller wich load all the models
    public function index(){
         
        //creates a user object
        $userVar=new user($this->adapter);
         
         // get the array of users with the method get all 
        //Conseguimos todos los usuarios
        $allusers=$userVar->getAll();
        
        $users=new usersModel($this->adapter);
        $loginCheck=$users->loginCheck();
        
        $this->view("index",array(
            "allusers"=>$allusers,
            "Hola"    =>"Soy Víctor Robles"
        ));
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
     

 
}
?>