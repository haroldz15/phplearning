<?php
class viewHelper{
     
    public function url($controller=defaultController,$action=defaultAction){
        $inputStream='<input type="hidden" value="'.$controller.'" name="c"><input type="hidden" value=
        "'.$action.'" name="a">';
        return $inputStream;
    }
     
    //Helpers para las vistas
}
?>