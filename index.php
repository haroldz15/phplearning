<?php
//Global configutarion
require_once 'config/global.php';
 
//base class for controllers
require_once 'core/baseController.php';
 
//functions for the frontal controller
require_once 'core/frontEndController.func.php';

//Declaring variables
sec_session_start();
$actionURL="";
$controllerURL="";

if ($_SERVER['REQUEST_METHOD']=="POST")
{
	$controllerURL=(isset($_POST['controller'])?$_POST["c"]:defaultController);
	$actionURL=(isset($_POST["a"])?$_POST["a"]:"");	
}
elseif($_SERVER['REQUEST_METHOD']=="GET")
{
	$controllerURL=(isset($_GET["c"])?$_GET["c"]:defaultController);
	$actionURL=(isset($_GET["a"])?$_GET["a"]:"");
}

$controllerObj=loadController($controllerURL);
$actionURL=($actionURL==""?$controllerObj->defaultAction:$actionURL);
launchAction($controllerObj,$actionURL);

?>