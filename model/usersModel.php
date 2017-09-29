<?php
class usersModel extends baseModel{
    private $table;
     
    public function __construct($adapter){
        $this->table="users";
        parent::__construct($this->table,$adapter);
    }
     
    //Metodos de consulta
    public function getAUser(){
        $query="SELECT * FROM users WHERE email='haroldzuniga15@gmail.com'";
        $usuario=$this->executeSql($query);
        return $usuario;
    }
}
?>