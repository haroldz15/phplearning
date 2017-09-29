
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
     <div class="container">
       <div class="authBox login">
          <form class="form-signin"  action="" method="POST" name="login_form_a" autocomplete="false" onsubmit="formhash(this, this.password)" >
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required  autocomplete="false" >
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="password" name="apassword" class="form-control" placeholder="Password" required autocomplete="false" readonly onfocus="this.removeAttribute('readonly');"><br>
            <button type="submit"   class="btn btn-lg btn-primary btn-block" />Sign In</button>
          </form>
        </div>
      </div>
</body>
</html>