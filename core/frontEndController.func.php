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
        //header('LOCATION:error.php?error=launchAction');  
        echo "Error no  load action";                  
    }
}

//Executes Third 
function loadAction($controllerObj,$actionParam){
    //when the action is loaded means that the action will trigger a function with the sane name in the controller.php file
    $action=$actionParam;
    $controllerObj->$action();
}
 
function sec_session_start(){
    define("SECURE",false);//desarrollo
    $session_name='sec_session_id'; 

    $secure=SECURE; 
    $httponly=true; 

    //session a usar cookies
    if(ini_set('session.use_only_cookies',1)===FALSE){
        header("LOCATION:../error.php?err=no se poudo iniciar una sesion segura(ini_set)");
        exit();
    }
    
    $cookieParams=session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"],
        $cookieParams["domain"],
        $secure,
        $httponly);

    //inicializando sesion
    session_name($session_name);
    session_start();
    session_regenerate_id();//regenera siempre
}
 
?>