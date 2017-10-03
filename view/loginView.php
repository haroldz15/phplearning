<!DOCTYPE html>
<html>
<head>
    <title>Log In</title>
    <script type="text/JavaScript" src="/phplearning/dist/js/sha512.js"></script> 
    <script type="text/JavaScript" src="/phplearning/dist/js/forms.js"></script> 
    <link href="/phplearning/dist/bootstrap/css/bootstrap.css" rel="stylesheet"> 
    <link href="/phplearning/dist/css/auth.css" rel="stylesheet">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <?php echo $_SESSION['id'];?>
     <div class="container">
       <div class="authBox login">
          <form class="form-signin"  action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" name="login_form_a" autocomplete="off" onsubmit="formhash(this, this.password)" >
            <h2 class="form-signin-heading">Please sign in</h2><hr>
            <i class="inside fa fa-user"></i>
              <input type="email" id="email" name="email" class="inp form-control" placeholder="Email address" required  autocomplete="off" >
            <i class="inside fa fa-lock"></i>
              <input type="password" id="password" name="dist/password" class="inp form-control" placeholder="Password" required autocomplete="off" readonly onfocus="this.removeAttribute('readonly');"><br>
            <?php 
            if(!empty($errors)){
echo <<<HTML
<div class="alert alert-danger" role="alert">
<strong>Error!</strong> $errors
</div>
HTML;
}
?>                    
            <?php echo $helper->url('auth','login'); ?>
            <button type="submit"   class="btn btn-lg btn-primary btn-block" />Sign In</button>
          </form>
        </div>
      </div>
</body>
</html>