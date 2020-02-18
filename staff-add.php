<?php
include('session.php');
$account = $_SESSION['username'];
$type = $_SESSION['usertype'];
?>

<?php
  $Admin_auth = 1;
  $Stock_auth = 0;
  $Area_Center_auth = 0;
 include('includes/user_auth.php');
?>



<?php
// Define variables and initialize with empty values
$username=$password=$usertype=$alertMessage="";
require_once "config.php";

//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //Assigning posted values to variables.
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $usertype = test_input($_POST['usertype']);


    // Check input errors before inserting in database
    if(empty($alertMessage)){
        //Check if the username is already in the database
        $sql_check = "SELECT username FROM users WHERE username ='$username'";
        if($result = mysqli_query($link, $sql_check)){ //Execute query
                                 if(mysqli_num_rows($result) > 0){
                                    //If the username already exists
                                    //Try another username pop up
                                    echo "<script>alert('staff username already exist');</script>";
                                    mysqli_free_result($result);
                                 } else{
                                    //If the username doesnt exist in the database
                                    //Proceed adding to database

                                    //Prepare Date for custom ID
                                    $IDtype = "STAFF";
                                    $m = date('m');
                                    $y = date('y');
                                    $d = date('d');

                                    $qry = mysqli_query($link,"SELECT MAX(id) FROM `users`"); // Get the latest ID
                                    $resulta = mysqli_fetch_array($qry);
                                    $newID = $resulta['MAX(id)'] + 1; //Get the latest ID then Add 1
                                    $custID = str_pad($newID, 4, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
                                    $custnewID = $IDtype.$custID; //Prepare custom ID

                                    $query = "
                                    INSERT INTO users (custID, username, password, usertype, created_by)
                                    VALUES ('$custnewID', '$username', '$hash', '$usertype', '$account')"; //Prepare insert query

                                    $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query


                                    if($result){
                                    //echo "<script>alert('new staff added succesfully');</script>";
                                    $info = $_SESSION['username']." added new staff";
                                    $info2 = "Details: ".$username.", ".$usertype;
                                    $alertlogsuccess = $username.", ".$usertype.": has been added succesfully!";
                                    include('logs.php');
                                    echo "<script>window.location.href='staff-manage.php'</script>";
                                    $username = "";
                                    $hash = "";
                                    $usertype = "";

                                    }else{
                                      //If execution failed
                                      $alertMessage = "<div class='alert alert-danger' role='alert'>
                                      Error adding data.
                                      </div>";
                                    }
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
              <li class="breadcrumb-item active">Add Staff</li>
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
                  <h3 class="card-title">Add Staff</h3>
                  <a href="staff-manage.php">View all staff</a>
                </div>
              </div>

              <div class="card-body">
                <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Username" name="username" oninput="upperCase(this)" maxlength="20" required>
                      </div>

                      <div class="form-group">
                        <label>Password</label>
                        <input type="Password" class="form-control" placeholder="Password" name="password" oninput="upperCase(this)" maxlength="20" required>
                      </div>

                      <div class="form-group">
                        <label>User Type</label>
                        <select class="form-control select2" style="width: 100%;" name="usertype" required>
                          <option value="Admin">Admin</option>
                          <option value="Stock Officer">Stock Officer</option>
                        </select>
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
