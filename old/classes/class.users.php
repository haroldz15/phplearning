<?php 
include_once 'db_connect.php';

class User(){
	public $db;
	$error_msg="";

	public function __construct(){
		$this->$db=$mysqli;
	}

	public function registerUser($username,$email,$p){
		$username = filter_var($username, FILTER_SANITIZE_STRING);
	    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
	    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
	    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
	    }

	    $password = filter_var('$p', FILTER_SANITIZE_STRING);
	    if (strlen($password) != 128) {
	        // The hashed pwd should be 128 characters long.
	        $error_msg .= '<p class="error">Invalid password configuration.</p>';
	    }

	    $prep_stmt = "SELECT user_id FROM users WHERE email = ? LIMIT 1";
	    $stmt = $mysqli->prepare($prep_stmt);
	    if ($stmt) {
	        $stmt->bind_param('s', $username);
	        $stmt->execute();
	        $stmt->store_result();

	                if ($stmt->num_rows == 1) {
	                        // A user with this username already exists
	                        $error_msg .= '<p class="error">A user with this username already exists</p>';
	                        $stmt->close();
	                }

	        } else {
	                $error_msg .= '<p class="error">Database error line 29</p>';
	                $stmt->close();
	        }

	    if (empty($error_msg)) {
	 
	        $prev_salt=uniqid(mt_rand(1, mt_getrandmax()), true);
	        $random_salt = hash('sha512', $prev_salt);
	        $password = hash('sha512', $password . $random_salt);
	        $user_flags='2';
	        // Insert the new user into the database 
	        if ($insert_stmt = $mysqli->prepare("INSERT INTO users (username, email, password,salt) VALUES (?, ?, ?, ?)")) {
	            $insert_stmt->bind_param('ssss', $username, $email, $password,$random_salt);
	            // Execute the prepared query.
	            if (! $insert_stmt->execute()) {
	                //header('Location: ../error.php?err=Registration failure: INSERT');
	                $error_ms .="Error Inserting";
	                return $error_msg;;
	            }
	        }
	        return true;
	        //header('Location: registration_success.php');
	    }else{
	    	return $error_msg;
	    }		

	}

	function loginUser($email,$password){
		//flecha es cuando se usa una funcion de un objeto , en este caso el prepare de mysqli
		if($stmt=$mysqli->prepare("SELECT user_id,username,password,salt,flags from users where email=? Limit 1")){
			$stmt->bind_param('s',$email);
			$stmt->execute();
			$stmt->store_result();

	        $stmt->bind_result($user_id, $username, $db_password, $salt,$flags);
	        $stmt->fetch();
	 
	        // Hace el hash de la contraseña con una sal única.
	        $password = hash("sha512", $password . $salt);

			if($stmt->num_rows==1){
				//existe , verificar estado actual del usuario
				if(checkBrute($user_id,$mysqli)==1){
					//cuenta bloqueada por forzar intentos
					return false;
				}else{
					$_SESSION['username']="asd";
					// verificar si la contrasena existe
					if($db_password == $password){
						//todo correcto, obtener datos del user agent
						$user_browser=$_SERVER['HTTP_USER_AGENT'];
						$user_id=preg_replace("/[^0-9]+/", "", $user_id);
						$_SESSION['user_id']=$user_id;

						$username=preg_replace("/[^a-zA-Z0-9_\-]+/", "",$username);
						$_SESSION['username']=$username;
						$_SESSION['flags']=$flags;
						$_SESSION['login_string']=hash('sha512',$db_password.$user_browser);
						//crea una linea encriptada de la contrasena y el browser
						return true;
					}else{
						//no coincide contrasena
						$now=time();
						$mysqli->query("INSERT INTO login_attempts (user_id,time) VALUES ('$user_id','$now')");
						return false;
					}
				}
			}else{
				//no existe usuario
				return false;
			}
		}
	}

	function logoutUser(){
		$_SESSION=array();

		$params=session_get_cookie_params();

		setcookie(session_name(),'',time()-42000,
		        $params["path"], 
		        $params["domain"], 
		        $params["secure"], 
		        $params["httponly"]);

		session_destroy();
	}

}
 ?>
