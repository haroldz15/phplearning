<?php
//Global configutarion
require_once 'config/global.php';
 
//base class for controllers
require_once 'core/baseController.php';
 
//functions for the frontal controller
require_once 'core/frontEndController.func.php';


if ($_SERVER['REQUEST_METHOD']=="POST"){

	if(isset($_POST['controller']))
	{
		$controllerURL=$_POST['controller'];
	}else{
		$controllerURL=defaultController;
	}

	if(isset($_POST['action'])){
		$actionURL=$_POST['action'];
	}

}elseif($_SERVER['REQUEST_METHOD']=="GET")
{
$requestUri = $_SERVER['REQUEST_URI'];
echo $requestUri;

}



//$controllerObj=loadController($controllerURL);
//launchAction($controllerObj,$controllerObj->defaultAction);

?>