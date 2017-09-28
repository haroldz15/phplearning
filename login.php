<?php 
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

if(loginCheck($mysqli)==true){
	$logged='in';
	header('LOCATION:u/protected_page.php');
}else{
	$logged='out';
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
    <script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script> 
    <link href="dist/bootstrap/css/bootstrap.css" rel="stylesheet">	
    <link href="dist/css/auth.css" rel="stylesheet">	
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<?php 
	if(isset($_GET['error'])){
		echo '<p class="error"> error Loging in</p>';
	}
?>
     <div class="container">
       <div class="authBox login">
          <form class="form-signin"  action="includes/loginclass.php" method="POST" name="login_form_a" autocomplete="false" onsubmit="formhash(this, this.password)" >
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required  autocomplete="false" >
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="password" name="apassword" class="form-control" placeholder="Password" required autocomplete="false" readonly onfocus="this.removeAttribute('readonly');"><br>
            <button type="submit"   class="btn btn-lg btn-primary btn-block" />Sign In</button>
          </form>
  <?php
          echo '<p>Currently logged ' . $logged . '.</p>';
          echo "<p>If you don't have a login, please <a href='registration.php'>register</a></p>"; 
  ?>
        </div>
      </div>
</body>
</html>