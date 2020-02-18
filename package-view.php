<?php include "session.php"; ?>

<?php
$Admin_auth = 1;
$Stock_auth = 0;
$Area_Center_auth = 0;
include('includes/user_auth.php');
?>


<?php include "config.php"; ?>

<?php

$get_model_id = $_GET['model_id'];

// Attempt select query execution
$Getquery = "SELECT * FROM product_model WHERE model_id = '$get_model_id'";
if($Getresult = mysqli_query($link, $Getquery)){
  if(mysqli_num_rows($Getresult) > 0){
    while($row = mysqli_fetch_array($Getresult)){
      $model = $row['model'];
      $sku = $row['sku'];
      $created_by = $row['created_by'];
      $created_at = $row['created_at'];
      $type = $row['type'];

    }
    // Free result set
    //mysqli_free_result($Getresult);
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
    <?php include "includes/sidebar-manage.php"; ?>

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
                <li class="breadcrumb-item active">View Package</li>
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
                    <h3 class="card-title">Package Info</h3>
                    <a href="package-add.php">+ Add new package</a>
                  </div>
                </div>


                <div class="card-body">
                  <div class="row">

                    <div class="col-md-6">
                      <label>Package Name</label>
                      <input type="text" class="form-control" value="<?php echo $model; ?>" disabled>
                      <label>SKU</label>
                      <input type="text" class="form-control" value="<?php echo $sku; ?>" disabled>
                      <label>Type</label>
                      <input type='text' class='form-control' value="<?php echo $type; ?>" disabled>
                    </div>

                    <div class="col-md-6">
                      <label>Date</label>
                      <input type="text" class="form-control" value="<?php echo $created_at; ?>" disabled>
                      <label>Created by</label>
                      <input type="text" class="form-control" value="<?php echo $created_by; ?>" disabled>
                    </div>
                  </div>
                  <br>
                  <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                    <thead>
                      <tr>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">No.</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Package Model</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Package Quantity</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // Attempt select query execution
                      $query = "SELECT pack_list_model, SUM(pack_list_qty) as Qty FROM package_list WHERE model_id = '$get_model_id' GROUP BY pack_list_model ";
                      if($result = mysqli_query($link, $query)){
                        if(mysqli_num_rows($result) > 0){
                          $ctr = 0;
                          while($row = mysqli_fetch_array($result)){
                            $ctr++;
                            echo "<tr>";
                            echo "<td>" . $ctr . "</td>";
                            echo "<td>" . $row['pack_list_model'] . "</td>";
                            echo "<td>" . $row['Qty'] . "</td>";
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
