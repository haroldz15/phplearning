<?php 
require_once 'dist/includes/header.php';
?>
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo baseReference?>dist/img/users/<?php echo $_SESSION['id']?>.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <?php
        foreach ($allOptions as $key => $option) {
        echo '<li>
          <a href="'.baseReference.'app/'.$option['action'].'">
            <i class="fa '.$option['icon'].'"></i> <span>'.$option['name'].'</span>
          </a>
        </li>';
        }
        ?>   
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php require_once $viewDashboard.'View.php'; ?>
  </div>
  <!-- /.content-wrapper -->
<?php 
require_once 'dist/includes/footer.php';
 ?>