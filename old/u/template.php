<?php 
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';

sec_session_start();

  if (loginCheck($mysqli) == true) : 
    include_once '../includes/header.php';
    ?>
      <div class="row">
        <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
          <ul class="nav nav-pills flex-column">
            <?php getOptions($mysqli) ?>
          </ul>
        </nav>

        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
            <p>
            </p>
            <?php getContent($mysqli) ?>
        </main>
      </div>
    <?php 
    include_once '../includes/footer.php';
    else : 
    HEADER("LOCATION:../login.php");
    endif; 

?>