  <?php include "session.php"; ?>



  <?php
  // Define variables and initialize with empty values
  $name=$username=$password=$areaCenter=$alertMessage="";
  require_once "config.php";

$get_stockist_id = $_GET['id'];

  //display stockist profile
$query = "SELECT * FROM stockist WHERE id = '$get_stockist_id' ";
if($result = mysqli_query($link, $query)){
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
      $name             =   $row['name'];
      $username         =   $row['username'];
      $password         =   $row['password'];
      $usertype         =   $row['usertype'];
      $area_center      =   $row['area_center'];
      $created_by       =   $row['created_by'];
      $created_at       =   $row['created_at'];
    }

    // Free result set
    mysqli_free_result($result);
  } else{
    echo "<p class='lead'><em>No records were found.</em></p>";
  }
} else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}



  //If the form is submitted or not.
  //If the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
      //Assigning posted values to variables.
    $name = test_input($_POST['name']);
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $areaCenter = test_input($_POST['areaCenter']);
    $startDate = test_input($_POST['startDate']);

    if(empty($name)){
      $alertMessage = "Please enter full name.";
    }

    if(empty($username)){
      $alertMessage = "Please enter username.";
    }

    if(empty($areaCenter)){
      $alertMessage = "Please enter Area Center.";
    }

      // Check input errors before inserting in database
    if(empty($alertMessage)){

              $account = $_SESSION["username"];//session name

              $query = "
              UPDATE stockist SET name = '$name', username = '$username', password = '$hash', usertype = '$usertype', area_center = '$area_center' WHERE id = '$get_stockist_id' ";

              //Execute  update query
              $result = mysqli_query($link, $query) or die(mysqli_error($link)); 

              if($result){
                $info = $_SESSION['username']." data updated successfully";
                $info2 = "Details: ".$name. ", " .$username.", ".$areaCenter;
                $alertlogsuccess = $name.": has been updated succesfully!";
                include "logs.php";
                echo "<script>window.location.href='stockist-manage.php'</script>"; 


              }else{
                      //If execution failed
                $alertMessage = "<div class='alert alert-danger' role='alert'>
                Error adding data.
                </div>";
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
                      <li class="breadcrumb-item active">Add Stockist</li>
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
                          <h3 class="card-title">Add Stockist</h3>
                          <a href="stockist-manage.php">View all Stockist</a>
                        </div>
                      </div>

                      <div class="card-body">
                        <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $get_stockist_id; ?>">
                          <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="name" oninput="upperCase(this)" maxlength="100" value="<?php echo $name;?>" required>
                          </div>

                          <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="Username" name="username" oninput="upperCase(this)" maxlength="20" value="<?php echo $username; ?>" required>
                          </div>

                          <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password" oninput="upperCase(this)" maxlength="20" value="<?php echo $password; ?>" required>
                          </div>

                          <div class="form-group">
                            <label>Area Center</label>
                            <select class="form-control select2" style="width: 100%;" oninput="upperCase(this)"  data-placeholder="Area Center" name="areaCenter"  required>
                              <option value="<?php echo $area_center; ?>"><?php echo $area_center; ?></option>
                              <?php
                                                            // Include config file
                              require_once "config.php";
                                                            // Attempt select query executions
                              $query = "";
                              $query = "SELECT * FROM `warehouse`";
                              if($result = mysqli_query($link, $query)){
                                if(mysqli_num_rows($result) > 0){

                                  while($row = mysqli_fetch_array($result)){

                                    echo "<option value='".$row['name']."'>" . $row['name'] .  "</option>";
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

                          <div class="form-group">
                            <label>Starting Date</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                              </div>
                              <input type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" name="startDate" onkeydown="return false" value="<?php echo $created_at; ?>" readonly>
                            </div>
                          </div>
                        </div>

                        <div class="card-footer">

                          <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();" >Save</button>
                          <?php echo $alertMessage ?>
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
