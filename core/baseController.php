<?php
class baseController{
 
    public function __construct() {
        require_once 'connect.php';
        require_once 'baseIdentity.php';
        require_once 'baseModel.php';
         
        //Including all the models
        //TODO : make the controller load variable
        foreach(glob("model/*.php") as $file){
            require_once $file;
        }
    }
     
    //Plugins and utilities
     
    public function view($view,$data){
        //var_dump(json_encode($data));
        if($data){
            foreach ($data as $id_asso => $value) {
                //echo "<br>".$id_asso."<br>";
                //var_dump($value);
                // $id_asso takes the current element which is an id i.e. 1
                //$1 takes the value $1=1
                ${$id_asso}=$value; 
                //echo "<br>".var_dump($id_asso)."<br>";
            }
        }
        require_once 'core/viewHelper.php';
        $helper=new viewHelper();
     
        require_once 'view/'.$view.'View.php';
    }
     
    public function redirect($controller=defaultController,$action=defaultAction){
        header("Location:index.php?controller=".$controller."&action=".$action);
    }
     
    //Métodos para los controladores
 
}
?>