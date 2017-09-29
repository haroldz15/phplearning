<?php
class viewHelper{
     
    public function url($controller=defaultController,$action=defaultAction){
        $urlString="index.php?controller=".$controller."&action=".$action;
        return $urlString;
    }
     
    //Helpers para las vistas
}
?>