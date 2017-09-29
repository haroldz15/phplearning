<?php 

include_once 'psl_config.php';
include_once 'db_connect.php';
include_once 'session.php';

sec_session_start();
//read the querystring parameter
$q = filter_var($_REQUEST["q"], FILTER_SANITIZE_STRING);
$error_msg="";


if($q=="assignRoles"){
    $prep_stmt = "INSERT INTO  user_role(user_id,role_id) VALUES(?,?)";
    $stmt = $mysqli->prepare($prep_stmt);
    if ($stmt) {
        $stmt->bind_param('ii', $_POST["usersSelect"], $_POST["rolesSelect"]);
        $stmt->execute();
        $stmt->store_result();
                if ($stmt->affected_rows>0) {
                        // Get all the user roles to the array user_roles
                }else{
                    $error_msg .= '<p class="error">Insert Error</p>';    
                }
                $stmt->close();
        } else {
                $error_msg .= '<p class="error">Database error line 45</p>';
        }

    if (empty($error_msg)) {
        $htmltext="Data Saved Succesfully";
        print $htmltext;
        return $htmltext;
    } else {
        print $error_msg;
        return $error_msg;
    }
}

 ?>