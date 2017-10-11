<?php
class company extends baseIdentity{
    private $id;
    private $name;
    private $address;
    private $email;
    private $phones;
     
    public function __construct($adapter) {
        $table="companies";
        parent::__construct($table,$adapter);
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
 
    public function getAddress() {
        return $this->address;
    }
 
    public function setAddress($Address) {
        $this->address = $address;
    }
 
    public function getEmail() {
        return $this->email;
    }
 
    public function setEmail($email) {
        $this->email = $email;
    }
 
    public function getPhones() {
        return $this->phones;
    }
 
    public function setPhones($Phones) {
        $this->phones = $phones;
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