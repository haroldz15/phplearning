<?php
//Global configutarion
require_once 'config/global.php';
 
//base class for controllers
require_once 'core/baseController.php';
 
//functions for the frontal controller
require_once 'core/frontalController.func.php';
 
//load controllers and actions
if(isset($_GET["controller"])){
    $controllerObj=loadController($_GET["controller"]);
    launchController($controllerObj);
}else{
    $controllerObj=loadController(defaultController);
    launchController($controllerObj);
}
?>