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
      $ob_date = $row['ob_date'];
      $ob_remarks = $row['ob_remarks'];
      $ob_status = $row['ob_status'];
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
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">Invoice # <?php echo $get_ob_tx_id; ?></h3>
                    <a href="product-add.php">+ Add new invoice</a>
                  </div>
                </div>


                <div class="card-body">
                  <div class="row">

                    <div class="col-md-6">
                      <label>Customer Name</label>
                      <input type="text" class="form-control" value="<?php echo $ob_custName; ?>" disabled>
                      <label>Status</label>
                      <input type="text" class="form-control" value="<?php echo $ob_status; ?>" disabled>
                    </div>

                    <div class="col-md-6">
                      <label>Date</label>
                      <input type="text" class="form-control" value="<?php echo $ob_date; ?>" disabled>
                      <label>Created by</label>
                      <input type="text" class="form-control" value="<?php echo $ob_created_by; ?>" disabled>
                    </div>

                    <div class="col-md-12">
                      <label>Remarks</label>
                      <textarea type="text" class="form-control" disabled><?php echo $ob_remarks; ?></textarea>
                  </div>
                  </div>
                  <br>
                  <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                    <thead>
                      <tr>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">No.</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Customer Name</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Transaction Date</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Status</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Created By</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Remarks</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // Attempt select query execution
                      $query = "SELECT * FROM outboundtb WHERE ob_tx_id = '$get_ob_tx_id'";
                      if($result = mysqli_query($link, $query)){
                        if(mysqli_num_rows($result) > 0){
                          $ctr = 0;
                          while($row = mysqli_fetch_array($result)){
                            $ctr++;
                            echo "<tr>";
                            echo "<td>" . $ctr . "</td>";
                            echo "<td>" . $row['ob_custName'] . "</td>";
                            echo "<td>" . $row['ob_date'] . "</td>";
                            echo "<td>" . $row['ob_status'] . "</td>";
                            echo "<td>" . $row['ob_created_by'] . "</td>";
                            echo "<td>" . $row['ob_remarks'] . "</td>";
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

                <div class="card-footer">

                </div>
              </div>
            </div>

          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <?php include "includes/footer.php"; ?>
  </div>
  <!-- ./wrapper -->

  <?php include "includes/js.php"; ?>

</body>
</html>
