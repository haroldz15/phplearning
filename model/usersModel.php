<?php
class usersModel extends baseModel{
    private $table;
     
    public function __construct(){
        $this->table="users";
        parent::__construct($this->table);
    }
     
    //Metodos de consulta
    public function getAUser(){
        $query="SELECT * FROM users WHERE email='victor@victor.com'";
        $usuario=$this->ejecutarSql($query);
        return $usuario;
    }
}
?>