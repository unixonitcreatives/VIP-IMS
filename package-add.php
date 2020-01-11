  <?php
  //Connection
  require_once "config.php";
  // Define variables and initialize with empty values
  $pname=$account=$alertMessage="";
  ?>

  <?php include "session.php";
      //loggedin username
      $account = $_SESSION["username"];
  ?>

  <?php


  //If the form is submitted
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $packname = validation($_POST['package_name']);

    //if empty required fields
    if(empty($packname)){

      $alertMessage = "<div class='alert alert-danger' role='alert'>
          Please input required fields.
          </div>";

    }else {

    //Prepare Date for custom ID
    $IDtype = "PM";
    $m = date('m');
    $y = date('y');
    $d = date('d');

    $qry = mysqli_query($link,"SELECT MAX(id) FROM `product_model`"); // Get the latest ID
    $resulta = mysqli_fetch_array($qry);
    $newID = $resulta['MAX(id)'] + 1; //Get the latest ID then Add 1
    $custID = str_pad($newID, 5, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
    $custnewID = $IDtype.$custID; //Prepare custom ID

    //INSERT query to packages table
    $packageQuery = "
    INSERT INTO `product_model` (custID, description, sku, type, status, created_by)
    VALUES ('$custnewID', '$packname', 'PKG', 'package', 'Active','$account')";
    $packageResult = mysqli_query($link, $packageQuery) or die(mysqli_error($link));


    if ($packageResult === TRUE) {
      $j = 0;

      //Counts the elements in array
      $count = count($_POST['product-model']);

      // Use insert_id property to get the id of previous table (packages table)
      $packages_id = $link->insert_id;

      //===========================================================================================
        //Prepare Date for custom ID
    $IDtype = "PCKID";
    $m = date('m');
    $y = date('y');
    $d = date('d');

    $qry = mysqli_query($link,"SELECT MAX(id) FROM `product_model`"); // Get the latest ID
    $resulta = mysqli_fetch_array($qry);
    $newID = $resulta['MAX(id)'] + 1; //Get the latest ID then Add 1
    $custID = str_pad($newID, 5, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
    $newPackID = $IDtype.$custID; //Prepare custom ID

      //===========================================================================================

      for ($j = 0; $j < $count; $j++) {

        $listquery = "INSERT INTO package_list (packId, pack_list_model, pack_list_qty) VALUES (
          '".$custnewID."',
          '".$_POST['product-model'][$j]."',
          '".$_POST['modelQty'][$j]."')";

          $listresult = mysqli_multi_query($link, $listquery) or die(mysqli_error($link));

        }

        if($listresult === TRUE){
          //logs
          $info = $_SESSION['username']." added new package";
          $info2 = "Details: ".$packname.", ".$custnewID;
          $alertlogsuccess = $packname.": has been added succesfully!";
          include "logs.php";
          echo "<script>window.location.href='package-manage.php'</script>";

           $query = "SELECT pack_list_model, pack_list_qty FROM package_list WHERE packId = '".$newPackID."' ";
          if($result = mysqli_query($link, $query)){
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                  $package_model = $package_qty = "";

                  $package_model = $row['pack_list_model'];
                  $package_qty  = $row['pack_list_qty'];

                  include ('pm-retail-checker.php');


                }
                // Free result set
                //mysqli_free_result($result);
              } else{
                //echo "<p class='lead'><em>No records were found.</em></p>";
              }
            } else{
              echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }


        }else{
          $alertMessage = "<div class='alert alert-danger' role='alert'>
          Error Creating Package.
          </div>";}
          //INSERT query to so_transactions table end

        }
      }

    } // ./validation

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
                <li class="breadcrumb-item active">Add Package</li>
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
                    <h3 class="card-title">Add Package</h3>
                    <a href="package-manage.php">View all packages</a>
                  </div>
                </div>

                <div class="card-body">
                  <?php echo $alertMessage; ?>
                  <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="form-group">
                          <label>Package Name<span style="color: Red;">*</span></label>
                          <input type="text" class="form-control" placeholder="Package Name" name="package_name" oninput="upperCase(this)" maxlength="20" required><br>

                        </div>

                        <table class="table table-bordered table-hover" role="grid" aria-describedby="example2_info" id="productModelTable">
                        <thead>
                          <tr>
                            <th width="50%">Product Model</th>
                            <th width="30%">Quantity</th>
                            <th width="20%"><button type="button" class="btn btn-success" onclick="modelAddRow()" id="modelAddRowBtn" data-loading-text="Loading..."><i class="nav-icon fas fa-plus">Add Row</i></button></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $arrayNumber = 0;
                          for($x =1; $x < 3; $x++){ ?> <!-- == loop start == -->
                          <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
                            <td>
                              <div class="from-group">
                              <select class="form-control select2" style="width: 100%;" name="product-model[]" id="prod-mod<?php echo $x; ?>" onchange="get-prod-model-data(<?php echo $x;?>)">
                              <option value="">Select Product</option>
                                <?php
                                // Include config file
                                require_once "config.php";
                                // Attempt select query executions
                                $query = "";
                                $query = "SELECT * FROM `product_model` WHERE type = 'retail' ";
                                // $query = "SELECT * FROM orders WHERE name LIKE '%$name%' AND item LIKE '%$item%' AND status LIKE '%$status%'";
                                if($result = mysqli_query($link, $query)){
                                if(mysqli_num_rows($result) > 0){

                                while($row = mysqli_fetch_array($result)){

                                echo "<option value='".$row['custID']."' id='changeProduct".$row['custID']."'>" . $row['description'] .  "</option>";
                                }

                                 // Free result set
                                mysqli_free_result($result);
                                } else{
                                echo "<p class='lead'><em>No records were found.</em></p>";
                                }
                                } else{
                                  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                }

                                ?>
                                </select>
                            </td>
                          </div>
                            <td>
                              <input type="number" class="form-control" placeholder="Quantity" name="modelQty[]" id="moddQty<?$php echo $x; ?>" required>
                            </td>
                            <td>
                              <button class="btn btn-danger removeModelRowBtn" type="button" id="removeModelRowBtn" onclick="removeModelRow(<?php echo $x; ?>)"><i class="nav-icon fas fa-minus"></i></button>
                            </td>
                          </tr>

                          <?php $arrayNumber++; } ?> <!-- == loop end == -->
                        </tbody>
                      </table>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();" >Save</button>
                  </form>
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
  <!-- REQUIRED SCRIPTS -->
   <?php include "includes/js.php"; ?>


  </body>
  </html>
