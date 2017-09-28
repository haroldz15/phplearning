<?php 
include '../classes/class.user.php';
include_once 'functions.php';
sec_session_start();//inicializa la sesion


$user = new User();

if (isset($_POST['email'],$_POST['p'])) {
$email=$_POST['email'];
$password=$_POST['p'];
$login = $user->loginUser($email, $password);
if ($login) {
	// Registration Success
		header('LOCATION:../u/protected_page.php');
	}else{
		header('LOCATION:../login.php?error=1');
	}
}else{
echo 'INVALID REQUEST';
}
 ?>
