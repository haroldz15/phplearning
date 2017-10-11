    <section class="content-header">
       
      <h1>
        <?php echo  $title ?>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo  $title ?></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">
          

          <!-- /. box -->
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Template</h3>
            </div>
            <div class="box-body">
              <select class="form-control" name="selectTemplate">
                <option disabled selected></option>
                <?php foreach ($company as $key => $value) {
                 echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                } ?>
              </select>
               <br><input type="submit" name="" value="New Invoice" class="btn btn-success btn-block">
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->           
          <?php 
          echo $helper->parameters("document","newInvoice") ?>
          </form>
        </div>

        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo  $title ?></h3>

              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                    <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                    <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
                    </td>
                    <td class="mailbox-date">15 days ago</td>
                  </tr>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
    </section>
    <!-- /.content -->