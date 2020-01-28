<?php include "session.php"; ?>
<?php include "config.php"; ?>

<?php
//get invoice id
$get_ob_tx_id = $_GET['ob_tx_id'];

$ob_custName="";
// Attempt select query execution
$Getquery = "SELECT * FROM outboundtb WHERE ob_tx_id = '$get_ob_tx_id'";
if($Getresult = mysqli_query($link, $Getquery)){
  if(mysqli_num_rows($Getresult) > 0){
    while($row = mysqli_fetch_array($Getresult)){

      $ob_tx_id = $row['ob_tx_id'];
      $ob_custName = $row['ob_custName'];
      $ob_warehouse = $row['ob_warehouse'];
      $ob_date = $row['ob_date'];
      $ob_remarks = $row['ob_remarks'];
      $ob_status = $row['ob_status'];
      $ob_mot = $row['ob_mot'];
      $ob_received_by = $row['ob_received_by'];
      $ob_created_by = $row['ob_created_by'];
      $ob_created_at = $row['ob_created_at'];


    }
    // Free result set
    mysqli_free_result($Getresult);
  }
} else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include "includes/navbar.php"; ?>
    <?php include "includes/sidebar.php"; ?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">VIP Inventory Management System</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">View Invoice # <?php echo $get_ob_tx_id; ?></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" width="50px" height="auto"class="brand-image img-circle elevation-1"> VIP International
                    <small class="float-right"><b>Invoice #<?php echo $get_ob_tx_id; ?></b></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>VIP International, Inc.</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (804) 123-5432<br>
                    Email: vipsupport@gmail.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong><?php echo $ob_custName; ?></strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (555) 539-1037<br>
                    Email: john.doe@example.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                
                  <b>Order Status:</b> <?php echo $ob_status; ?><br><br>
                  <b>Date:</b> <?php echo $ob_date; ?><br>
                  <b>Warehouse:</b> <?php echo $ob_warehouse; ?><br>
                  <b>Mode of Transfer:</b> <?php echo $ob_mot; ?><br>
                  <b>Note:</b> <?php echo $ob_received_by; ?>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table id="" class="table table-striped">
                    <thead>
                      <tr>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">No.</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Products</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Quantity</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // Attempt select query execution
                      $query = "SELECT * FROM obdatatb WHERE ob_tx_id = '$get_ob_tx_id'";
                      if($result = mysqli_query($link, $query)){
                        if(mysqli_num_rows($result) > 0){
                          $ctr = 0;
                          while($row = mysqli_fetch_array($result)){
                            $ctr++;
                            echo "<tr>";
                            echo "<td>" . $ctr . "</td>";
                            echo "<td>" . $row['obdata_products'] . "</td>";
                            echo "<td>" . $row['obdata_qty'] . "</td>";
                            echo "</tr>";
                          }
                          // Free result set
                          mysqli_free_result($result);
                        } else{
                          echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                      } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                      }

                      // Close connection
                      mysqli_close($link);
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <br><br>
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-12">
                  <p class="lead">Remarks:</p>
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    <textarea class="form-control" width="100%" rows="5" style="resize: none;" placeholder="Remarks" name="invRemarks" value="<?php echo $ob_remarks; ?>"></textarea>
                  </p>
                </div>
                <!-- /.col -->
     
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  
                  <a onclick="Print()" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <!--
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                -->
                </div>
              </div>
            </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <?php include "includes/footer.php"; ?>
  </div>
  <!-- ./wrapper -->

  <?php include "includes/js.php"; ?>


<script>
//print function
function Print() {
  window.print();
}
</script>

</body>
</html>
