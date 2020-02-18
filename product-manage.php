<?php include "session.php"; ?>
<?php
$Admin_auth = 1;
$Stock_auth = 0;
$Area_Center_auth = 0;
include('includes/user_auth.php');
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
              <li class="breadcrumb-item active">Manage Product Model</li>
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
                  <h3 class="card-title">Manage Product Model</h3>
                  <a href="product-add.php">add new Product Model</a>
                </div>
              </div>

              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">No.</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Model</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">SKU</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Created By</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Date Created</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Include config file
                        require_once 'config.php';

                        // Attempt select query execution
                        $query = "SELECT * FROM `product_model` WHERE type = 'retail' ORDER BY model_id DESC";
                        if($result = mysqli_query($link, $query)){
                          if(mysqli_num_rows($result) > 0){
                            $ctr = 0;
                            while($row = mysqli_fetch_array($result)){
                              $ctr++;
                              echo "<tr>";
                              echo "<td>" . $ctr . "</td>";
                              echo "<td>" . $row['model'] . "</td>";
                              echo "<td>" . $row['sku'] . "</td>";
                              echo "<td>" . $row['created_by'] . "</td>";
                              echo "<td>" . $row['created_at'] . "</td>";
                              echo "<td>";
                              //echo "<a href='user-update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='fas fa fa-pen'></span></a>";
                              /*echo " &nbsp; <a href='product-update.php?model_id=". $row['model_id'] ."' title='Update Record' data-toggle='tooltip'><span class='fas fa-pen'></span></a>";*/
                              echo " &nbsp; <a href='product-delete.php?model_id=". $row['model_id'] ."&&model=".$row['model']." ' title='Delete Record' data-toggle='tooltip' onclick='return checkDelete()'><span class='fas fa fa-trash'></span></a>";
                              //echo " &nbsp; <a href='user-delete.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='fas fa fa-eye'></span></a>";
                              echo "</td>";
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
