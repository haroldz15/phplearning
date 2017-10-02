<?php
//FUNCIONES PARA EL CONTROLADOR FRONTAL
 
 //Executes First
function loadController($control){
    $controller=$control.'Controller';
    $strFileController='controller/'.$controller.'.php';
    //Calls de controller file ;
    if(!is_file($strFileController)){
        $strFileController='controller/'.defaultController.'Controller.php';   
    }
    require_once $strFileController;
    //the controller object is instantiated
    $controllerObj=new $controller();
    return $controllerObj;
}


//Executes Second 
function launchAction($controllerObj,$action){
    if(method_exists($controllerObj,$action)){
        loadAction($controllerObj, $action);
    }else{
        header('LOCATION:error.php?error=1');                    
    }
}

//Executes Third 
function loadAction($controllerObj,$actionParam){
    //when the action is loaded means that the action will trigger a function with the sane name in the controller.php file
    $action=$actionParam;
    $controllerObj->$action();
}
 

 
?>