<?php include "session.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>
<?php require_once 'config.php'; ?>

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
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Online Store Visitors</h3>
                  <a href="javascript:void(0);">View Report</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">820</span>
                    <span>Visitors Over Time</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 12.5%
                    </span>
                    <span class="text-muted">Since last week</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="visitors-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This Week
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last Week
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Recent Added Customer</h3>
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
                    <th>ID</th>
                    <th>Ref ID</th>
                    <th>Name</th>
                  </tr>
                  </thead>
                  <?php
                        // Include config file
                        //require_once 'config.php';

                        // Attempt select query execution
                        $cust_qry = "SELECT * FROM customers ORDER BY custID DESC LIMIT 5";
                        if($cust_result = mysqli_query($link, $cust_qry)){
                          if(mysqli_num_rows($cust_result) > 0){
                            $cust_ctr = 0;
                            while($cust_row = mysqli_fetch_array($cust_result)){
                              $cust_ctr++;
                              echo "<tr>";
                              echo "<td>" . $cust_ctr . "</td>";
                              echo "<td>" . $cust_row['custID'] . "</td>";
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
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Unpaid</h3>
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
                        $pkg_qry = "SELECT * FROM packages ORDER BY packId DESC LIMIT 5";
                        if($pkg_result = mysqli_query($link, $pkg_qry)){
                          if(mysqli_num_rows($pkg_result) > 0){
                            $pkg_ctr = 0;
                            while($pkg_row = mysqli_fetch_array($pkg_result)){
                              $pkg_ctr++;
                              echo "<tr>";
                              echo "<td>" . $pkg_ctr . "</td>";
                              echo "<td>" . $pkg_row['package_name'] . "</td>";
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

                        // Close connection
                        mysqli_close($link);
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
