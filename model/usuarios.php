<?php
class Usuario extends baseIdentity{
    private $id;
    private $name;
    private $lastname;
    private $email;
    private $password;
     
    public function __construct() {
        $table="users";
        parent::__construct($table);
    }
     
    public function getId() {
        return $this->id;
    }
 
    public function setId($id) {
        $this->id = $id;
    }
     
    public function getName() {
        return $this->name;
    }
 
    public function setName($name) {
        $this->name = $name;
    }
 
    public function getLastname() {
        return $this->lastname;
    }
 
    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }
 
    public function getEmail() {
        return $this->email;
    }
 
    public function setEmail($email) {
        $this->email = $email;
    }
 
    public function getPassword() {
        return $this->password;
    }
 
    public function setPassword($password) {
        $this->password = $password;
    }
 
    public function save(){
        /*$query="INSERT INTO users (id,name,apellido,email,password)
                VALUES(NULL,
                       '".$this->name."',
                       '".$this->apellido."',
                       '".$this->email."',
                       '".$this->password."');";
        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;*/
    }
 
}
?>