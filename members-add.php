<?php include "session.php";?>

<?php
// Define variables and initialize with empty values
$username=$password=$usertype=$alertMessage="";
require_once "config.php";

//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //Assigning posted values to variables.
  $name = test_input($_POST['name']);
  $refID = test_input($_POST['id']);
  $address = test_input($_POST['address']);
  $startDate = test_input($_POST['startDate']);


    // Check input errors before inserting in database
  if(empty($alertMessage)){
        //Check if the username is already in the database
    $sql_check = "SELECT refID FROM customers WHERE refID ='$refID'";
        if($result = mysqli_query($link, $sql_check)){ //Execute query
         if(mysqli_num_rows($result) > 0){
                                    //If the username already exists
                                    //Try another username pop up
          echo "<script>alert('member reference ID already exist');</script>";
          mysqli_free_result($result);
        } else{
                                    //If the username doesnt exist in the database
                                    //Proceed adding to database

                                    $account = $_SESSION["username"];//session name

                                    $query = "
                                    INSERT INTO customers (name, refID, address, created_by, created_at)
                                    VALUES ('$name', '$refID', '$address', '$account', '$startDate')"; //Prepare insert query

                                    $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query


                                    if($result){
                                      $info = $_SESSION['username']." added new member";
                                      $info2 = "Details: ".$name.", ".$refID;
                                      $alertlogsuccess = $name.", ".$refID.": has been added succesfully!";
                                      include "logs.php";
                                      echo "<script>window.location.href='members-manage.php'</script>";
                                      $name = "";
                                      $refID = "";
                                      $address = "";

                                    }else{
                                      //If execution failed
                                      $alertMessage = "<div class='alert alert-danger' role='alert'>
                                      Error adding data.
                                      </div>";}

                                    }
                                  } else{
                                   echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                 }

                             //mysqli_close($link);
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
                                            <li class="breadcrumb-item active">Add member</li>
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
                                                <h3 class="card-title">Add member</h3>
                                                <a href="members-manage.php">View all members</a>
                                              </div>
                                            </div>

                                            <div class="card-body">
                                              <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                                <div class="form-group">
                                                  <label>New Member Name</label>
                                                  <input type="text" class="form-control" placeholder="Username" name="name" oninput="upperCase(this)" maxlength="20" required>
                                                </div>

                                                <div class="form-group">
                                                  <label>Username</label>
                                                  <input type="text" class="form-control" placeholder="ID" name="id" oninput="upperCase(this)" maxlength="20" required>
                                                </div>

                                                <div class="form-group">
                                                  <label>Shipping Address</label>
                                                  <input type="text" class="form-control" placeholder="Address" name="address" oninput="upperCase(this)" maxlength="200" required>
                                                </div>

                                                <div class="form-group">
                                                  <label>Starting Date</label>
                                                  <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" name="startDate" onkeydown="return false">
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
