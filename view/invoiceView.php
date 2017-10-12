    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo  $title ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">New Invoice</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="invoice">
      <form action="<?php echo $_SERVER['PHP_SELF']?>" onsubmit="cargaTabla(this)" method="POST">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> <?php echo $company["name"];?>
            <small class="pull-right">Date: <?php date_default_timezone_set('America/New_York');echo date("m/d/y"); ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong><?php echo $company["name"];?></strong><br>
            <?php echo $company["address"];?><br>
            <?php echo $company["city"].' , '.$company["state"].' '.$company["zipcode"];?><br>
            Phone: <?php echo $company["phones"];?><br>
            Email: <?php echo $company["email"];?>
            <input type="hidden" name="company" value='<?php echo $company["id"];?>'>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">          
          <div class="col-sm-9">To<input type="text" class="form-control" style=" resize: none;" name='client_to' value="<?php $helper->definedVar($invoice,'client_to')?>"> Address:<textarea class="form-control" rows="3" style=" resize: none;" name="client_address"><?php $helper->definedVar($invoice,'client_address')?></textarea></div>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #<?php echo sprintf('%06d',$invoice_id);?></b><br>
          <input type="hidden" name="id" value='<?php echo $invoice_id?>'>
          <br>
          <b>Payment Due:</b><input class="form-control" type="date"  style="width: unset" name="date_due" value="<?php $helper->definedVar($invoice,'date_due')?>"><br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
          <div class="col-md-2">
              <button  type="button" class="btn btn-primary" onclick="addNewRow('tableItems')">Add New Item</button>
          </div>
      </div>
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped" id="tableItems">
            <thead>
            <tr>
              <th class="text-center">Qty</th>
              <th>Product Description</th>
              <th class="text-center">Options</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td style="width: 10%"><input type="number" class="form-control text-center"></td>
              <td style="width: 70%"><textarea class="form-control"  onkeyup="textAreaAdjust(this)" style="overflow:hidden;resize: none;" rows="1"></textarea></td>
              <td style="width: 20%"  class="text-center">
                <button type="button" class="btn btn-danger" onclick="deleteRow(this)">
                  <span class="fa fa-remove"></span>
                </button>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>
          <img src="<?php echo baseReference?>dist/img/credit/visa.png" alt="Visa">
          <img src="<?php echo baseReference?>dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="<?php echo baseReference?>dist/img/credit/american-express.png" alt="American Express">
          <img src="<?php echo baseReference?>dist/img/credit/paypal2.png" alt="Paypal">
          <h5>Observations<h5>
          <textarea class="form-control" style="margin-top: 5px;resize: none" rows="5" name="observations"><?php $helper->definedVar($invoice,'observations')?>
          </textarea>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%;vertical-align: middle !important">Subtotal:</th>
                <td><input type="number" id="subtotalPayment" class="form-control" style="width: unset" onkeyup="calculatePayment()" onchange="calculatePayment()"name="subtotal" value="<?php $helper->definedVar($invoice,'subtotal')?>"></td>
              </tr>
              <tr>
                <th>Tax &nbsp&nbsp<input type="number" name="tax"  id="taxInput" class="form-control" style="width: 80px;display: inline" onkeyup="calculatePayment()" onchange="calculatePayment()" value="<?php $helper->definedVar($invoice,'tax')?>">&nbsp%</th>
                <td style="vertical-align: middle !important" id="tax"><?php $helper->definedVar($invoice,'taxAmount')?></td>
              </tr>
              <tr>
                <th>Total:</th>
                <td id="totalPayment"><?php $helper->definedVar($invoice,'total')?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <?php  echo $helper->parameters("document","save") ?>
          <button type="submit" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Save
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;" onclick="cargaTabla(this)">
            <i class="fa fa-download"></i> Generate PDF
          </button>
        </div>
      </div>
      </form>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>