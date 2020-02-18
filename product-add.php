
<?php
include "session.php";
$Admin_auth = 1;
$Stock_auth = 0;
$Area_Center_auth = 0;
include('includes/user_auth.php');
?>

  <?php
  
  require_once "config.php";
  // Define variables and initialize with empty values
  $username=$password=$usertype=$alertMessage="";

  $account = $_SESSION["username"];?>

  <?php
  //If the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
      //Assigning posted values to variables.
    $description = test_input($_POST['model']);
    $sku = test_input($_POST['sku']);
    $dateCreated = test_input($_POST['dateCreated']);

    if(empty($description) || empty($sku) || empty($dateCreated)){
        echo "<script>alert('Please enter required fields');</script>";
    }


      // Check input errors before inserting in database
    if(!empty($description) && !empty($sku) && !empty($dateCreated)){
      //Check if the username is already in the database
      $sql_check = "SELECT model, sku FROM `product_model` WHERE model ='$description' OR sku = '$sku' ";
          if($result = mysqli_query($link, $sql_check)){ //Execute query
           if(mysqli_num_rows($result) > 0){
                                      //If the username already exists
                                      //Try another username pop up
            echo "<script>alert('Product Model or SKU already exist');</script>";
            mysqli_free_result($result);
          } else{
                                      //If the username doesnt exist in the database
                                      //Proceed adding to database

            $query = "
            INSERT INTO `product_model` (model, sku, type, status, created_by, created_at)
                                      VALUES ('$description', '$sku', 'retail', 'Active','$account', '$dateCreated')"; //Prepare insert query

                                      $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query


                                      if($result){
                                        $info = $_SESSION['username']." added new product model";
                                        $info2 = "Details: ".$description.", ".$sku;
                                        $alertlogsuccess = $description.", ".$sku.": has been added succesfully!";
                                        include "logs.php";
                                        echo "<script>window.location.href='product-manage.php'</script>";

                                      }else{
                                        //If execution failed
                                        $alertMessage = "<div class='alert alert-danger' role='alert'>
                                        Error adding data.
                                        </div>";}
                                        //mysqli_close($link);
                                      }
                                    } else{
                                     echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                   }

                                   mysqli_close($link);

                                 }
                               }

                               function test_input($data) {
                                $data = trim($data);
                                $data = stripslashes($data);
                                $data = htmlspecialchars($data);
                                return $data;
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
                                              <li class="breadcrumb-item active">Add Product Model</li>
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
                                              <div class="card-header">
                                                <div class="d-flex justify-content-between">
                                                  <h3 class="card-title">Add Product Model</h3>
                                                  <a href="product-manage.php">Manage Product Models</a>
                                                </div>
                                              </div>

                                              <div class="card-body">
                                                <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                                  <div class="form-group">
                                                    <label>Product Model</label>
                                                    <input type="text" class="form-control" placeholder="Product Model" name="model" oninput="upperCase(this)" maxlength="20" required>
                                                  </div>

                                                  <div class="form-group">
                                                    <label>Product SKU</label>
                                                    <input type="text" class="form-control" placeholder="SKU" name="sku" oninput="upperCase(this)" required>
                                                  </div>

                                                  <div class="form-group">
                                                    <label>Date Created</label>
                                                    <div class="input-group">
                                                      <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                      </div>
                                                      <input type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" name="dateCreated" required>
                                                    </div>
                                                  </div>

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
