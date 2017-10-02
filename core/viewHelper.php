<?php
class viewHelper{
     
    public function url($controller=defaultController,$action=defaultAction){
        $inputStream='<input type="hidden" value="'.$controller.'" name="controller"><input type="hidden" value=
        "'.$action.'" name="action">';
        return $inputStream;
    }
     
    //Helpers para las vistas
}
?>