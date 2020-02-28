<?php include "session.php"; ?>

<?php
  $Admin_auth = 1;
  $Stock_auth = 1;
  $Area_Center_auth = 0;
 include('includes/user_auth.php');
?>

<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>
<?php require_once 'config.php'; ?>

<?php 
//Total In Stocks 
$stocksquery = "SELECT SUM(quantity) as TotalStocks FROM stocks WHERE status = 'In Stock' ";
$stocksresult = mysqli_query($link, $stocksquery) or die(mysqli_error($link));
if (mysqli_num_rows($stocksresult) > 0) {
  while($row = mysqli_fetch_array($stocksresult))

    $totalStocks = $row['TotalStocks'];
}
?>

<?php 
//Total Members 
$stocksquery = "SELECT SUM(quantity) as TotalStocks FROM stocks WHERE status = 'In Stock' ";
$stocksresult = mysqli_query($link, $stocksquery) or die(mysqli_error($link));
if (mysqli_num_rows($stocksresult) > 0) {
  while($row = mysqli_fetch_array($stocksresult))

    $totalStocks = $row['TotalStocks'];
}
?>


<?php 
//Total Members 
$query = "SELECT COUNT(model) as TotalModel FROM product_model WHERE type = 'retail' ";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_array($result))

    $totalModel = $row['TotalModel'];
}
?>

<?php 
//Total Members 
$query = "SELECT COUNT(member_id) as TotalMembers FROM customers";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_array($result))

    $totalMembers = $row['TotalMembers'];
}
?>

<?php 
//Total Members 
$query = "SELECT  COUNT(ob_tx_id) as TotalInvoice
FROM    outboundtb
WHERE   ob_date = curdate()";

$result = mysqli_query($link, $query) or die(mysqli_error($link));
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_array($result))

    $totalInvoice = $row['TotalInvoice'];
}
?>


<?php 
//Total Members 
$query = "SELECT COUNT(id) as TotalUnpaid FROM outboundtb WHERE ob_status='Unpaid'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_array($result))
    $totalUnpaid = $row['TotalUnpaid'];
}
?>

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
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
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
              <div class="card-header border-0">
                <h3>Welcome to VIP Inventory Management Dashboard! BETA TESTING</h3>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h3><?php echo $totalModel; ?></h3>
                        <p>Total Products</p>

                      </div>
                      <div class="icon">
                        <i class="ion ion-bag"></i>
                      </div>
                      <a href="product-manage.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                      <div class="inner">

                        <h3><?php echo $totalInvoice; ?></h3>

                        <p>Invoice Issued Today</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="invoice-manage.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                      <div class="inner">
                        <h3><?php echo $totalMembers; ?></h3>

                        <p>Total Members</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-person-add"></i>
                      </div>
                      <a href="members-manage.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <?php 

                    if($totalUnpaid==0){
                      echo "<div class='small-box bg-success'>";
                    } else {
                      echo "<div class='small-box bg-danger'>";
                    }
                    ?>
                    
                      <div class="inner">
                        <h3><?php echo $totalUnpaid; ?></h3>

                        <p>Unpaid Invoice</p>
                      </div>
                      <div class="icon">

                      </div>
                      <a href="invoice-unpaid.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                </div>
                <hr>
                <!-- Quick Access > L -->
                <label>Quick Access:</label><br>
                <a class="btn btn-primary" href="members-add.php"><i class="nav-icon fas fa-users"></i> New Member</a>
                <a class="btn btn-primary" href="product-add.php"><i class="nav-icon fas fa-cubes"></i> New Product Model</a>
                <a class="btn btn-primary" href="stock-add.php"><i class="nav-icon fas fa-cubes"></i> Add New Stocks</a>
                <a class="btn btn-success" href="invoice-add.php"><i class="nav-icon fas fa-copy"></i> Add New Invoice</a>



              </div>
            </div>
          </div>
        </div>



        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Recent Added Members</h3>
                <div class="card-tools">
                  <a href="customer-add.php" class="btn btn-tool btn-sm">
                    <i class="fas fa-plus"></i>
                  </a>
                  <a href="customer-manage.php" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Ref ID</th>
                      <th>Name</th>
                    </tr>
                  </thead>
                  <?php
                        // Include config file
                        //require_once 'config.php';

                        // Attempt select query execution
                  $cust_qry = "SELECT * FROM customers ORDER BY member_id DESC LIMIT 5";
                  if($cust_result = mysqli_query($link, $cust_qry)){
                    if(mysqli_num_rows($cust_result) > 0){
                      $cust_ctr = 0;
                      while($cust_row = mysqli_fetch_array($cust_result)){
                        $cust_ctr++;
                        echo "<tr>";
                        echo "<td>" . $cust_ctr . "</td>";
                        echo "<td>" . $cust_row['refID'] . "</td>";
                        echo "<td>" . $cust_row['name'] . "</td>";
                        echo "</tr>";
                      }
                            // Free result set
                      mysqli_free_result($cust_result);
                    } else{
                      echo "<p class='lead'><em>No records were found.</em></p>";
                    }
                  } else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                  }

                        // Close connection
                        //mysqli_close($link);
                  ?>
                </tbody>
              </table>
            </div>
          </div>

          <!-- /.card -->


          <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">Pending Stock Requests</h3>
              <div class="card-tools">
   
                <a href="stock-request-manage.php" class="btn btn-tool btn-sm">
                  <i class="fas fa-bars"></i>
                </a>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped table-valign-middle">
                <thead>
                  <tr>
                   
                    <th>Warehouse</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <?php
                        // Include config file
                        //require_once 'config.php';

                $query1 = "SELECT * FROM area_center";
                        if($result1 = mysqli_query($link, $query1)){
                          if(mysqli_num_rows($result1) > 0){
                            while($row1 = mysqli_fetch_array($result1)){
                              $ac_warehouse = $row1['warehouse'];

                        // Attempt select query execution
                $cust_qry = "SELECT * FROM stock_request WHERE warehouse = '$ac_warehouse' AND status = 'Pending' ORDER BY id DESC ";
                if($cust_result = mysqli_query($link, $cust_qry)){
                  if(mysqli_num_rows($cust_result) > 0){
                    $cust_ctr = 0;
                    while($cust_row = mysqli_fetch_array($cust_result)){
                      $cust_ctr++;
                      $id = $cust_row['warehouse'];
                      echo "<tr>";
                      
                      echo "<td><a href='warehouse-view.php?id=$id'>" . $cust_row['warehouse'] . "</a></td>";
                      echo "<td>" . $cust_row['product'] . "</td>";
                      echo "<td>" . $cust_row['qty'] . "</td>";
                      echo "<td>";
                      echo " &nbsp; <a href='request-approve.php?id=".$cust_row['id']."' title='Approve Request' data-toggle='tooltip'><span class='fas fa fa-check'></span></a>";
                      echo "</td>";
                      echo "</tr>";
                    }
                            // Free result set
                    mysqli_free_result($cust_result);
                  } else{
                    echo "<p class='lead'><em>No records were found.</em></p>";
                  }
                } else{
                  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                }
              }}}

                        // Close connection
                        //mysqli_close($link);
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col-md-6 -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header border-0">
            <h3 class="card-title">Unpaid Invoices</h3>
            <div class="card-tools">
              <a href="invoice-add.php" class="btn btn-tool btn-sm">
                <i class="fas fa-plus"></i>
              </a>
              <a href="invoice-unpaid.php" class="btn btn-tool btn-sm">
                <i class="fas fa-bars"></i>
              </a>
            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-striped table-valign-middle">
              <thead>
                <tr>
                  <th>No</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Date</th>
                </tr>
              </thead>
              <?php
                        // Include config file
                        //require_once 'config.php';

                        // Attempt select query execution
              $cust_qry = "SELECT * FROM outboundtb WHERE ob_status ='Unpaid' ORDER BY ob_tx_id DESC LIMIT 5";
              if($cust_result = mysqli_query($link, $cust_qry)){
                if(mysqli_num_rows($cust_result) > 0){
                  $cust_ctr = 0;
                  while($cust_row = mysqli_fetch_array($cust_result)){
                    $cust_ctr++;
                    echo "<tr>";
                    echo "<td>" . $cust_ctr . "</td>";
                    echo "<td><span class='text-danger'>" . $cust_row['ob_tx_id'] . "</span></td>";
                    echo "<td>" . $cust_row['ob_custName'] . "</td>";
                    echo "<td>" . $cust_row['ob_date'] . "</td>";
                    echo "</tr>";
                  }
                            // Free result set
                  mysqli_free_result($cust_result);
                } else{
                  echo "<p class='lead'><em>No records were found.</em></p>";
                }
              } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
              }

                        // Close connection
                        //mysqli_close($link);
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.card -->

      <div class="card">
        <div class="card-header border-0">
          <h3 class="card-title">Packages</h3>
          <div class="card-tools">
            <a href="package-add.php" class="btn btn-tool btn-sm">
              <i class="fas fa-plus"></i>
            </a>
            <a href="package-manage.php" class="btn btn-tool btn-sm">
              <i class="fas fa-bars"></i>
            </a>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped table-valign-middle">
            <thead>
              <tr>
                <th>No</th>
                <th>Package name</th>   
              </tr>
            </thead>
            <tbody>
                  <?php //ETO BRO
                        // Include config file
                        //require_once 'config.php';

                        // Attempt select query execution
                  $pkg_qry = "SELECT * FROM `product_model` WHERE type = 'package' ORDER BY model_id DESC LIMIT 5";
                  if($pkg_result = mysqli_query($link, $pkg_qry)){
                    if(mysqli_num_rows($pkg_result) > 0){
                      $pkg_ctr = 0;
                      while($pkg_row = mysqli_fetch_array($pkg_result)){
                        $pkg_ctr++;
                        echo "<tr>";
                        echo "<td>" . $pkg_ctr . "</td>";
                        echo "<td>" . $pkg_row['model'] . "</td>";
                        echo "</tr>";
                      }
                            // Free result set
                      mysqli_free_result($pkg_result);
                    } else{
                      echo "<p class='lead'><em>No records were found.</em></p>";
                    }
                  } else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                  }


                  ?>


                </tbody>
              </table>
            </div>
          </div>

          <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">Recent Logs</h3>
              <div class="card-tools">

                <a href="logs-manage.php" class="btn btn-tool btn-sm">
                  <i class="fas fa-bars"></i>
                </a>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped table-valign-middle">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Info</th>
                    <th>Details</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <?php
                        // Include config file
                        //require_once 'config.php';

                        // Attempt select query execution
                $cust_qry = "SELECT * FROM logs ORDER BY id DESC LIMIT 5";
                if($cust_result = mysqli_query($link, $cust_qry)){
                  if(mysqli_num_rows($cust_result) > 0){
                    $cust_ctr = 0;
                    while($cust_row = mysqli_fetch_array($cust_result)){
                      $cust_ctr++;
                      echo "<tr>";
                      echo "<td>" . $cust_ctr . "</td>";
                      echo "<td>" . $cust_row['info'] . "</td>";
                      echo "<td>" . $cust_row['info2'] . "</td>";
                      echo "<td>" . $cust_row['created_at'] . "</td>";
                      echo "</tr>";
                    }
                            // Free result set
                    mysqli_free_result($cust_result);
                  } else{
                    echo "<p class='lead'><em>No records were found.</em></p>";
                  }
                } else{
                  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                }

                        // Close connection
                        //mysqli_close($link);
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.col-md-6 -->
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

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="dist/js/pages/dashboard3.js"></script>
</body>
</html>
