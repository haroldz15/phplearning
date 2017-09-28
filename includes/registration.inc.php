<?php 
include_once 'db_connect.php';
include_once 'psl_config.php';
 
$error_msg = "";
 
if (isset($_POST['username'],$_POST['email'],$_POST['p'])){

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }

    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
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
            $insert_stmt->bind_param('sssss', $username, $email, $password,$random_salt);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                return false;
            }
        }
        
        return true;
    }

} 



 ?>