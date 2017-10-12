<?php
class viewHelper{
     
    public function parameters($controller=defaultController,$action=defaultAction){
        $inputStream='<input type="hidden" value="'.$controller.'" name="c"><input type="hidden" value=
        "'.$action.'" name="a">';
        return $inputStream;
    }

      public function linkCustom($controller=defaultController,$action=defaultAction,$i=1,$text){
        $link='<a href="'.baseReference.$controller.'/'.$action.'/'.$i.'" class="btn btn-primary">'.$text.'</a>';
        return $link;
    }

     public function definedVar($element,$parameter){
        //var_dump($invoice);
       echo  (isset($element) ? $element[$parameter]: "");
     }
     
}
?>