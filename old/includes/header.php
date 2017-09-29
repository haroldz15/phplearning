<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Billing System</title>

    <!-- Bootstrap core CSS -->
    <link href="../dist/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="../dist/CSS/dashboard.css" rel="stylesheet">
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">Web App</a>
      <div class="collapse navbar-collapse " id="navbarCollapse">

          <ul class="navbar-nav left-side">
          <li class="nav-item active">
            <a class="nav-link" href="#">Welcome <?php echo htmlentities($_SESSION['username']);?>!</a>
          </li>
        </ul>
          <a href="../includes/logout.php"  class="btn btn-outline-success left-side">Log Out</a>>
      </div>
    </nav>


    <!-- Begin page content -->
    <div class="container-fluid">


