<?php include "session.php"; 

    $_SESSION["username"] = $account;?>

<?php
// Define variables and initialize with empty values
$username=$password=$usertype=$alertMessage="";
require_once "config.php";

//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //Assigning posted values to variables.
    $description = test_input($_POST['description']);
    $sku = test_input($_POST['sku']);


    // Check input errors before inserting in database
    if(empty($alertMessage)){
        //Check if the username is already in the database
        $sql_check = "SELECT sku FROM `product-model` WHERE sku ='$sku'";
        if($result = mysqli_query($link, $sql_check)){ //Execute query
                                 if(mysqli_num_rows($result) > 0){
                                    //If the username already exists
                                    //Try another username pop up
                                    echo "<script>alert('SKU already exist');</script>";
                                    mysqli_free_result($result);
                                 } else{
                                    //If the username doesnt exist in the database
                                    //Proceed adding to database

                                    //Prepare Date for custom ID
                                    $IDtype = "PM";
                                    $m = date('m');
                                    $y = date('y');
                                    $d = date('d');

                                    $qry = mysqli_query($link,"SELECT MAX(id) FROM `product-model`"); // Get the latest ID
                                    $resulta = mysqli_fetch_array($qry);
                                    $newID = $resulta['MAX(id)'] + 1; //Get the latest ID then Add 1
                                    $custID = str_pad($newID, 5, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
                                    $custnewID = $IDtype.$custID; //Prepare custom ID

                                    $query = "
                                    INSERT INTO `product-model` (custID, description, sku, type, status, created_by) 
                                    VALUES ('$custnewID', '$description', '$sku', 'retail', 'Active','$account')"; //Prepare insert query

                                    $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query
                                    
                                    
                                    if($result){
                                    $info = $_SESSION['username']." added new product-model";
                                    $info2 = "Details: ".$description.", ".$sku;
                                    $alertlogsuccess = $description.", ".$sku.": has been added succesfully!";
                                    include "logs.php";

                                    }else{
                                      //If execution failed
                                      $alertMessage = "<div class='alert alert-danger' role='alert'>
                                      Error adding data.
                                      </div>";}
                                      mysqli_close($link);
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
                  <a href="product-manage.php">View all product model</a>
                </div>
              </div>

              <div class="card-body">
                <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                      <div class="form-group">
                        <label>Product Description</label>
                        <input type="text" class="form-control" placeholder="Product Description" name="description" oninput="upperCase(this)" maxlength="20" required>
                      </div>

                      <div class="form-group">
                        <label>Product SKU</label>
                        <input type="text" class="form-control" placeholder="SKU" name="sku" oninput="upperCase(this)" required>
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
