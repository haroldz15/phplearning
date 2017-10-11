<?php
class option extends baseIdentity{
    private $id;
    private $name;
    private $lastname;
    private $email;
    private $password;
     
    public function __construct($adapter) {
        $table="options";
        parent::__construct($table,$adapter);
    }
     
    public function getId() {
        return $this->id;
    }
 
    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->id;
    }
 
    public function setName($id) {
        $this->id = $id;
    }

    public function getAction() {
        return $this->id;
    }
 
    public function setAction($id) {
        $this->id = $id;
    }

    public function getFlags() {
        return $this->id;
    }
 
    public function setFlags($id) {
        $this->id = $id;
    }

    public function getStatus() {
        return $this->id;
    }
 
    public function setStatus($id) {
        $this->id = $id;
    }     
 
}
?>