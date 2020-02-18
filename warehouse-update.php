<?php include "session.php"; ?>
<?php
  $Admin_auth = 1;
  $Stock_auth = 1;
  $Area_Center_auth = 0;
 include('includes/user_auth.php');
?>


<?php
// Define variables and initialize with empty values
$name=$address=$alertMessage="";
require_once "config.php";
$get_warehouse_id = $_GET['warehouse_id'];
//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    //Assigning posted values to variables.
    $name = test_input($_POST['name']);
    $address = test_input($_POST['address']);

    if(empty($name)){
      $alertMessage = "Please enter a warehouse name.";
    }

    if(empty($address)){
      $alertMessage = "Please enter a warehouse address.";
    }

    // Check input errors before inserting in database
    if(empty($alertMessage)){
        //Check if the username is already in the database
        $sql_check = "SELECT name FROM warehouse WHERE name ='$name'";
        if($result = mysqli_query($link, $sql_check)){ //Execute query
                                 if(mysqli_num_rows($result) > 0){
                                    //If the username already exists
                                    //Try another username pop up
                                    //echo "<script>alert('Warehouse name already exist');</script>";
                                    //mysqli_free_result($result);

                                  //If the username doesnt exist in the database
                                    //Proceed to updating  database


                                    $account = $_SESSION["username"];//session name

                                    $query = "UPDATE warehouse SET name = '$name', address = '$address' WHERE warehouse_id='$get_warehouse_id'";
                                    $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query

                                    if($result){
                                    $info = $_SESSION['username']." updated warehouse: " .$name;
                                    $info2 = "Address Details: ".$address;
                                    $alertlogsuccess = $name.": has been updated succesfully!";
                                    include "logs.php";
                                    echo "<script>window.location.href='warehouse-manage.php'</script>";
                                    }else{
                                      //If execution failed
                                      $alertMessage = "<div class='alert alert-danger' role='alert'>
                                      Error updating data.
                                      </div>";}
                                      mysqli_close($link);
                                 } else{
                                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                 }
                             } else{
                                 echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                             }



        }

        //mysqli_close($link);
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
              <li class="breadcrumb-item active">Add warehouse</li>
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
                  <h3 class="card-title">Update warehouse</h3>
                  <a href="warehouse-manage.php">View all warehouse</a>
                </div>
              </div>

              <div class="card-body">
                <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?warehouse_id=<?php echo $get_warehouse_id; ?>">
                  <?php
                    $q = "SELECT name,address FROM warehouse WHERE warehouse_id='$get_warehouse_id'";
                    $r = mysqli_query($link,$q);
                    while($row = mysqli_fetch_assoc($r)){
                  ?>
                      <div class="form-group">
                        <label>Warehouse Name</label>
                        <input type="text" class="form-control" placeholder="Warehouse Name" name="name" oninput="upperCase(this)" maxlength="20" value='<?php echo $row['name'];?>' readonly>
                         <?php echo $alertMessage ?>
                      </div>

                      <div class="form-group">
                        <label>Warehouse Address</label>
                        <input type="text" class="form-control" placeholder="Address" name="address" oninput="upperCase(this)" value='<?php echo $row['address'];?>'>
                         <?php echo $alertMessage ?>
                      </div>
                    <?php } ?>
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
