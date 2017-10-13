<?php
class usersModel extends baseModel{
    private $table;
     
    public function __construct($adapter){
        $this->table="users";
        parent::__construct($this->table,$adapter);
    }
     
    //Metodos de consulta
    public function loginUser($email,$password){
        //$query="SELECT * FROM users WHERE email='haroldzuniga15@gmail.com'";
        $user=$this->getBy('email',$email);
        if(isset($user['email'])){
            $password = hash("sha512", $password . $user['salt']);
            $_SESSION['username']="asd";
                    //check if the password is correct
                    if($user['password'] == $password){
                        //correct user
                        $user_browser=$_SERVER['HTTP_USER_AGENT'];
                        $user_id=preg_replace("/[^0-9]+/", "", $user['id']);
                        $_SESSION['id']=$user['id'];
                        $username=preg_replace("/[^a-zA-Z0-9_\-]+/", "",$user['username']);
                        $_SESSION['username']=$user['username'];
                        $_SESSION['flags']=$user['flags'];
                        $_SESSION['login_string']=hash('sha512',$user['password'].$user_browser);
                        //hashed string 
                        return true;
                    }else{
                        //incorrect password
                        return "Incorrect Password";
                    }
        }else{
          //incorrect email
          return "Incorrect Email";  
        }       
    }


//Check Login
    public function loginCheck(){
        if(isset($_SESSION['id'],$_SESSION['username'],$_SESSION['login_string'])){
            $id=$_SESSION['id'];
            $username=$_SESSION['username'];
            $login_string=$_SESSION['login_string'];
            $user_browser=$_SERVER['HTTP_USER_AGENT'];
            $user=$this->getById($id);

            if(isset($user['email'])){
                $login_check=hash('sha512',$user['password'].$user_browser);
                    if(hash_equals($login_check,$login_string)){
                        return true;
                    }else{
                        //no coincide
                        return false;
                    }
            }else{
              //incorrect email
              return false;  
            } 
        }else{
            //no hay datos de sesion
            return false;
        }
    }
}
?>