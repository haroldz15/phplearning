<?php
class usersModel extends baseModel{
    private $table;
     
    public function __construct($adapter){
        $this->table="users";
        parent::__construct($this->table,$adapter);
    }
     
    //Metodos de consulta
    public function getAUser($email,$password){
        //$query="SELECT * FROM users WHERE email='haroldzuniga15@gmail.com'";
        $usuario=$this->getBy('email',$email);
        if(isset($usuario['email'])){
            $password = hash("sha512", $password . $usuario['salt']);
            $_SESSION['username']="asd";
                    //check if the password is correct
                    if($usuario['password'] == $password){
                        //correct user
                        $user_browser=$_SERVER['HTTP_USER_AGENT'];
                        $user_id=preg_replace("/[^0-9]+/", "", $usuario['id']);
                        $_SESSION['user_id']=$usuario['id'];
                        $username=preg_replace("/[^a-zA-Z0-9_\-]+/", "",$usuario['username']);
                        $_SESSION['username']=$usuario['username'];
                        $_SESSION['flags']=$usuario['flags'];
                        $_SESSION['login_string']=hash('sha512',$usuario['password'].$user_browser);
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

}
?>