<?php 
include_once 'includes/registration.inc.php';
include_once 'includes/functions.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Registration Form</title>
    <script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script>	
    <link href="dist/bootstrap/css/bootstrap.css" rel="stylesheet"> 
    <link href="dist/css/auth.css" rel="stylesheet"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<!-- formulario  -->


<div class="container">
<div class="authBox reg">
<h1>Registro</h1>
<?php 
if(!empty($error_msg)){
    echo $error_msg;
}
?>
       <ul>
        <li>Usernames may contain only digits, upper and lowercase letters and underscores</li>
        <li>Emails must have a valid email format</li>
        <li>Passwords must be at least 6 characters long</li>
        <li>Passwords must contain
            <ul>
                <li>At least one number (0..9)</li>
            </ul>
        </li>
        <li>Your password and confirmation must match exactly</li>
    </ul>
    <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="POST" name="registration_form" onsubmit="return regformhash(this,this.username, this.email,this.password,this.confirmpwd)"">
        <div class="form-group row">
          <label for="example-text-input" class="col-sm-2 col-form-label">Username</label>
          <div class="col-sm-10">
            <input class="form-control" type="text"  id="username" name="username" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input class="form-control" type="email"  name="email" id="email" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="example-text-input" class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-10">
            <input class="form-control" type="password" name="password" id="password" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="example-text-input" class="col-sm-2 col-form-label">Confirm Password</label>
          <div class="col-sm-10">
            <input class="form-control" type="password" id="confirmpwd" name="confirmpwd" required>
          </div>
        </div>
        <button  type="submit"  class="btn btn-primary" > Register</button/> 
    </form>
    <p>Return to the <a href="login.php">login page</a>.</p>
</div>
</div>

	
</body>
</html>
