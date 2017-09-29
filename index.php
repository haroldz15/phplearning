<?php
//Global configutarion
require_once 'config/global.php';
 
//base class for controllers
require_once 'core/baseController.php';
 
//functions for the frontal controller
require_once 'core/frontEndController.func.php';
 
//load controllers and actions
if(isset($_GET["controller"])){
    $controllerObj=loadController($_GET["controller"]);
    launchAction($controllerObj);
}else{
    $controllerObj=loadController(defaultController);
    launchAction($controllerObj);
}
?>