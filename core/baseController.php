<?php
class ControladorBase{
 
    public function __construct() {
        require_once 'baseIdentity.php';
        require_once 'baseModel.php';
         
        //Including all the models
        //TODO : make the controller load variable
        foreach(glob("model/*.php") as $file){
            require_once $file;
        }
    }
     
    //Plugins and utilities
     
/*
* Este método lo que hace es recibir los datos del controlador en forma de array
* los recorre y crea una variable dinámica con el indice asociativo y le da el 
* valor que contiene dicha posición del array, luego carga los helpers para las
* vistas y carga la vista que le llega como parámetro. En resumen un método para
* renderizar vistas.
*/
    public function view($view,$data){
        foreach ($data as $id_asso => $value) {
            // $id_asso takes the current element which is an id i.e. 1
            //$1 takes the value $1=1
            ${$id_asso}=$value; 
        }
         
        require_once 'core/viewHelp.php';
        $helper=new viewHelper();
     
        require_once 'view/'.$view.'View.php';
    }
     
    public function redirect($controller=defaultController,$action=defaultAction){
        header("Location:index.php?controller=".$controller."&action=".$action);
    }
     
    //Métodos para los controladores
 
}
?>