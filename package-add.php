   <?php 
   include "session.php";

   ?>

   <?php
  //Connection
   require_once "config.php";
  // Define variables and initialize with empty values
   $pname=$account=$alertMessage="";


  //loggedin username
   $account = $_SESSION["username"];
   ?>



   <?php
  //If the form is submitted
   if($_SERVER['REQUEST_METHOD'] == "POST"){
    $packname = validation($_POST['package_name']);
    $dateCreated = validation($_POST['startDate']);

    //if empty required fields
    if(empty($packname) || empty($dateCreated)){

      echo "<script>alert('Please input required fields.')</script>";
      
    }else {


    //Check if the package name is already in the database
      $sql_check = "SELECT model FROM `product_model` WHERE model ='$packname' ";
      if($result = mysqli_query($link, $sql_check)){
           //Execute query
       if(mysqli_num_rows($result) > 0){
                                      //If the username already exists
                                      //Try another username pop up
        echo "<script>alert('Package name already exist');</script>";
        mysqli_free_result($result);
      } else{
                  //If the username doesnt exist in the database
                  //Proceed adding to database
                  //INSERT query to product_model table
        $packageQuery = "
        INSERT INTO `product_model` (model, sku, type, status, created_by, created_at)
        VALUES ('$packname', 'PKG', 'package', 'Active','$account', '$dateCreated') ";
        $packageResult = mysqli_query($link, $packageQuery) or die(mysqli_error($link));

        if ($packageResult === TRUE) {

          $j = 0;

      //Counts the elements in array
          $count = count($_POST['product-model']);


      // Use insert_id property to get the model_id of previous table (product_model)
          $model_id = $link->insert_id;

          for ($j = 0; $j < $count; $j++) {

            if(empty($_POST['product-model'][$j]) || empty($_POST['modelQty'][$j])){

           echo "<script>alert('Please input required fields.')</script>";
          }
            else {

               $listquery = "INSERT INTO package_list (model_id, pack_list_model, pack_list_qty) VALUES (
            '".$model_id."',
            '".$_POST['product-model'][$j]."',
            '".$_POST['modelQty'][$j]."')";

            $listresult = mysqli_multi_query($link, $listquery) or die(mysqli_error($link));

             if($listresult === TRUE){
          //logs
            $info = $_SESSION['username']." added new package";
            $info2 = "Details: ".$packname.", ".$model_id;
            $alertlogsuccess = $packname.": has been added succesfully!";
            include "logs.php";
            echo "<script>window.location.href='package-manage.php'</script>";

            }// ./listResult 
            else{
              //echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }

            }

            
          }

         


        }// ./packageResult
        else{
          $alertMessage = "<script>alert('Error Creating Package.')</script>";
        }

          }// end of result
        } else{
          //echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
          }//end of checking duplicate package name

      } // ./validation
    }// ./post


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
                    <!-- ./card=header -->
                    <div class="card-body">
                      <?php echo $alertMessage; ?>
                      <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Package Name<span style="color: Red;">*</span></label>
                              <input type="text" class="form-control" placeholder="Package Name" name="package_name" oninput="upperCase(this)" maxlength="20" required><br>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Date</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" name="startDate" onkeydown="return false" required>
                              </div>
                            </div>
                          </div>

                        </div>

                        <table class="table" role="grid" aria-describedby="example2_info" id="productModelTable">
                          <thead>
                            <tr>
                              <th width="60%">Product Model</th>
                              <th width="30%">Quantity</th>
                              <th></th>
                              
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $arrayNumber = 0;
                            for($x =1; $x < 2; $x++){ ?> <!-- == loop start == -->
                            <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
                              <td>
                                <div class="from-group">
                                  <select class="form-control" style="width: 100%;" name="product-model[]" id="prod-mod<?php echo $x; ?>" onchange="get-prod-model-data(<?php echo $x;?>)" required>
                                    <option value="">Select Product</option>
                                    <?php
                                // Include config file
                                    require_once "config.php";
                                // Attempt select query executions
                                    $query = "";
                                    $query = "SELECT * FROM `product_model` WHERE type = 'retail' ORDER BY model_id DESC";
                                // $query = "SELECT * FROM orders WHERE name LIKE '%$name%' AND item LIKE '%$item%' AND status LIKE '%$status%'";
                                    if($result = mysqli_query($link, $query)){
                                      if(mysqli_num_rows($result) > 0){

                                        while($row = mysqli_fetch_array($result)){

                                          echo "<option value='".$row['model']."' id='changeProduct".$row['model']."'>" . $row['model'] .  "</option>";
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
                                </div>
                              </td>
                              
                              <td>
                                <input type="text" class="form-control" placeholder="Quantity" name="modelQty[]" id="moddQty<?php echo $x; ?>" onkeypress="return isNumberKey(event)" required>
                              </td>
                              <td>
                                <button class="btn btn-sm btn-danger removeModelRowBtn" type="button" id="removeModelRowBtn" onclick="removeModelRow(<?php echo $x; ?>)"><i class="nav-icon fas fa-minus"></i></button>
                              </td>
                            </tr>

                            <?php $arrayNumber++; } ?> <!-- == loop end == -->
                          </tbody>
                          <tfoot>
                            <tr>

                              <td colspan="3" align="center" width="20%"><button type="button" class="btn btn-sm btn-success" onclick="modelAddRow()" id="modelAddRowBtn" data-loading-text="Loading..."><i class="nav-icon fas fa-plus"></i> Add Row</button></td>
                            </tr>
                          </tfoot>
                        </table>


                    
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();" >Save</button>
                      </form>

                    </div>
                    
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col-lg-12 -->
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
