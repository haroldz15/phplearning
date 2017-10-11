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
    }
     

    public function login(){
        $method=$_SERVER['REQUEST_METHOD'];

        if($method=="GET"){          
            $this->view("login",array("errors"=>"")); 
        }
        if($method=="POST"){
            $email=filter_input(INPUT_POST, 'email',FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
            $users=new usersModel($this->adapter);
            $usu=$users->loginUser($email,$password);
            if($usu===true){
                $this->redirect("app", "index");
            }else{
                $this->view("login",array("errors"=>$usu)); 
            }       
        }
    }
     
    public function logout(){
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
     
    public function checkState(){
        if(isset($_GET["id"])){ 
            $id=(int)$_GET["id"];
             
            $user=new user($this->adapter);
            $user->deleteById($id); 
        }
        $this->redirect();
    }
         
}
?>