<?php 
include_once 'db_connect.php';
include_once 'functions.php';

sec_session_start();//inicializa la sesion

if(isset($_POST['email'],$_POST['p'])){
	$email=$_POST['email'];
	$password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
	if(login($email,$password,$mysqli)==true){
		header('LOCATION:../u/protected_page.php');
	}else{
		header('LOCATION:../login.php?error=1');
	}
}else{//no llego el post
	echo 'INVALID REQUEST';
}
 ?>