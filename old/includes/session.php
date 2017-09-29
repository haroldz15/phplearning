<?php 
include_once 'psl_config.php';

function sec_session_start(){
	$session_name='sec_session_id'; //nombre defecto de la session

	$secure=SECURE; 
	//session no accedida por js
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