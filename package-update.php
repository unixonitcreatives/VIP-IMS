<?php include "session.php"; ?>
<?php include "config.php"; ?>

<?php

$id = $_GET['custID'];

// Attempt select query execution
$Getquery = "SELECT * FROM product_model WHERE custID = '$id'";
if($Getresult = mysqli_query($link, $Getquery)){
  if(mysqli_num_rows($Getresult) > 0){
    while($row = mysqli_fetch_array($Getresult)){
      $custID = $row['custID'];
      $description = $row['description'];
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



 <?php


  //If the form is submitted
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $packname = validation($_POST['packName']);
    $sku = validation($_POST['sku']);

    //if empty required fields
    if(empty($packname) || empty($sku)){

      $alertMessage = "<div class='alert alert-danger' role='alert'>
          Please input required fields.
          </div>";
        }else{
      //UPDATE query to packages table
    $updatePackageQuery = "
    UPDATE `product_model` SET description = '$packName', sku = '$sku' WHERE custID = '$id' ";
    $packageResult = mysqli_query($link, $updatePackageQuery) or die(mysqli_error($link));

    if ($packageResult === TRUE) {

       echo "<script>alert('Insert 1 Updated')</script>";


      $j = 0;

      //Counts the elements in array
      $count = count($_POST['packlist']);

      
      for ($j = 0; $j < $count; $j++) {

        $listquery = "UPDATE package_list SET pack_list_model = '$packList[$j]', pack_list_qty = '$packQty[$j]' WHERE packId = '$id' ";
        $listresult = mysqli_multi_query($link, $listquery) or die(mysqli_error($link));

        }

        if($listresult === TRUE){
          //logs
          $info = $_SESSION['username']." update package";
          $info2 = "Details: ".$packname.", ".$id;
          $alertlogsuccess = $packname.": has been updated succesfully!";
          include "logs.php";
          echo "<script>window.location.href='package-manage.php'</script>";
                // Free result set
                //mysqli_free_result($result);
              } else{
                echo "<script>alert('Error creating logs')</script>";
              }


    }// ./pack result




    }// ./validation

  }// ./post
  else{
          $alertMessage = "<div class='alert alert-danger' role='alert'>
          Error Creating Package.
          </div>";
        }

    

      function validation($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
      // Close connection
      //mysqli_close($link);
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
                <li class="breadcrumb-item active">View Package # <?php echo $custID; ?></li>
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
                    <h3 class="card-title">Package # <?php echo $custID; ?></h3>
                    <a href="package-add.php">+ Add new package</a>
                  </div>
                </div>


                <div class="card-body">
                  <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?custID=<?php echo $id; ?>">
                  <div class="row">

                    <div class="col-md-6">
                       <div class="form-group">
                      <label>Package Name</label>
                      <input type="text" class="form-control" value="<?php echo $description; ?>" name="packName">
                    </div>

                     <div class="form-group">
                      <label>SKU</label>
                      <input type="text" class="form-control" value="<?php echo $sku; ?>" name="sku">
                      </div>

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
                      $query = "SELECT * FROM package_list WHERE packID = '$id' ";
                      if($result = mysqli_query($link, $query)){
                        if(mysqli_num_rows($result) > 0){
                          $ctr = 0;
                          while($row = mysqli_fetch_array($result)){
                            $packlist = $row['pack_list_model']; 
                            $packlistQty = $row['pack_list_qty'];

                            $ctr++;
                            echo "<tr>";
                            echo "<td>" . $ctr . "</td>";
                            echo "<td><input type='text' class='form-control' value=' $packlist ' name='packlist'></td>";
                            echo "<td><input type='text' class='form-control' value=' $packlistQty ' name='packlistQty'></td>";
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
                  <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();" >Save</button>
                  </form>
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
