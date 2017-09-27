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


function login($email,$password,$mysqli){
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

function checkBrute($user_id,$mysqli){
	$now=time();
	//rango de tiempo 2 horas
	$valid_attempts=$now-(2*60*60);

	if($stmt= $mysqli->prepare("SELECT time * from login_attempts where user_id=? and time>'$valid_attempts'")){
		//i o s se refiere al tipo de dato i int s string
		$stmt->bind_param('i',$user_id);

		$stmt->execute();
		$stmt->store_result();

		if($stmt->num_rows>5){
			return true;
		}else{
			return false;
		}
	}
}

function loginCheck($mysqli){
	if(isset($_SESSION['user_id'],$_SESSION['username'],$_SESSION['login_string'])){

		$user_id=$_SESSION['user_id'];
		$username=$_SESSION['username'];
		$login_string=$_SESSION['login_string'];

		//obtener datos del agente
		$user_browser=$_SERVER['HTTP_USER_AGENT'];

		if($stmt=$mysqli->prepare("SELECT password from users where user_id=? limit 1")){
			$stmt->bind_param("i",$user_id);
			$stmt->execute();
			$stmt->store_result();

			if($stmt->num_rows==1){
				$stmt->bind_result($password);
				$stmt->fetch();
				$login_check=hash('sha512',$password.$user_browser);

				if(hash_equals($login_check,$login_string)){
					//esta bien 
					return true;
				}else{
					//no coincide
					return false;
				}
			}else{
				//no encontro
				return false;
			}
		}else{
			//no se obtiene el stmt
			return false;
		}
	}else{
		//no hay datos de sesion
		return false;
	}
}


function esc_url($url){
	//evitar cross encripting

	if(''==$url){
		return $url;
	}

	$url=preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
	$strip=array('%0d', '%0a', '%0D', '%0A');
	$url=(string)$url;

	$count=1;
	while($count){
		$url=str_replace($strip, '', $url, $count);		
	}
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);

    if ($url[0] !== '/') {
        return '';
    } else {
        return $url;
    }

}


function getOptions($mysqli){
	$error_msg="";	
	$user_id=$_SESSION['user_id'];
	$flags=$_SESSION['flags'];
	$flagsArray = explode(" ", $flags);
    $prep_stmt = "SELECT name,action,flags_id FROM `options`";
    $stmt = $mysqli->prepare($prep_stmt);
    if ($stmt) {
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($name,$action,$flags_id);
        $user_options = array();
                while ($stmt->fetch()) {
                        // Get all the user roles to the array user_roles
                		for ($i=0; $i < sizeof($flagsArray); $i++) { 
                			if(strpos($flags_id,$flagsArray[$i])!==false){
                				$user_options[]=$name;
                				continue 2;
                			}
                		}
                }
                $stmt->close();
        } else {
                $error_msg .= '<p class="error">Database error line 176</p>';
                $stmt->close();
        }

    if (empty($error_msg)) {
 		foreach($user_options as $key => $value)
		{
print <<< HTML
            <li class="nav-item">
              <form  action="{$_SERVER['PHP_SELF']}" method="POST">
				<a href="javascript:;" onclick="parentNode.submit();" class="nav-link" >{$value}</a>
				<input type="hidden" value="{$value}" name="contentType">
			   </form>
            </li>
HTML;
		}
    }
}



?>