<?php
//FUNCIONES PARA EL CONTROLADOR FRONTAL
 
function loadController($control){
    $controller=ucwords($control).'Controller';
    $strFileController='controller/'.$controller.'.php';
     
    if(!is_file($strFileController)){
        $strFileController='controller/'.ucwords(defaultController).'Controller.php';   
    }
     
    require_once $strFileController;
    $controllerObj=new $controller();
    return $controllerObj;
}
 
function loadAction($controllerObj,$actionParam){
    $action=$actionParam;
    $controllerObj->$action();
}
 
function launchAction($controllerObj){
    if(isset($_GET["action"]) && method_exists($controllerObj, $_GET["action"])){
        loadAction($controllerObj, $_GET["action"]);
    }else{
        loadAction($controllerObj, defaultAction);
    }
}
 
?>