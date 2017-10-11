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
                ${$id_asso}=$value; 
            }
        }

        require_once 'core/viewHelper.php';

        $helper=new viewHelper();
        require_once 'view/'.$view.'View.php';

    }
     
    public function redirect($controller=defaultController,$action=defaultAction){
        header("Location:http://".$_SERVER['HTTP_HOST'].'/phpLearning/'.$controller."/".$action);                 
    }
     
 
}
?>