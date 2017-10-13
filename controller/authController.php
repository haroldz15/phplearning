<?php
class authController extends baseController{
     
    public function __construct() {
        parent::__construct();
        $this->connect=new connect();
        $this->adapter=$this->connect->connection();
        $this->defaultAction="login";
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
        $_SESSION=array();

        $params=session_get_cookie_params();

        setcookie(session_name(),'',time()-42000,
                $params["path"], 
                $params["domain"], 
                $params["secure"], 
                $params["httponly"]);

        session_destroy();
        $this->redirect("auth", "login");
    }
           
}
?>