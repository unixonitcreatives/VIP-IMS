<?php
require_once 'config.php';

include('session.php');

$get_id = $_GET['compId'];

                        // Attempt select query execution
                        $query = "SELECT * FROM `company` WHERE compId = '$get_id' ";
                        if($result = mysqli_query($link, $query)){
                          if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){
                              $name = $row['name'];
                              $address = $row['address'];
                              $tel = $row['tel'];
                              $email = $row['email'];
                              $site = $row['website'];
                              $createdBy = $row['created_by'];
                              $createdAt = $row['created_at'];
                            }
                            // Free result set
                            mysqli_free_result($result);
                          }
                        } else{
                          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                        }






$compName=$compAddress=$compTel=$compEmail=$compWebsite="";


if($_SERVER["REQUEST_METHOD"] == "POST"){


  $compName  = valData($_POST['comp_name']);
  $compAddress  = valData($_POST['comp_address']);
  $compTel      = valData($_POST['comp_tel']);
  $compEmail   = valData($_POST['comp_email']);
  $compWebsite   = valData($_POST['comp_site']);
  $account = $_SESSION['username'];

  //Check for empty fields
  if(empty($compName) || empty($compAddress) || empty($compTel) || empty($compEmail) || empty($compWebsite)){

    echo "<script>alert('Please enter required fields');</script>";

  } else {

    $query = "UPDATE company SET name = '$compName', address = '$compAddress', tel = '$compTel', email = '$compEmail', website = '$compWebsite' WHERE compId = '$get_id' ";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));

    if($result === TRUE){

      $info = $_SESSION['username']." update company profile";
      $info2 = "Details: ".$account;
      $alertlogsuccess = $account.", ".$compName.": has been updated succesfully!";
      include "logs.php";
      echo "<script>window.location.href='profile-manage.php'</script>";
    }else{
     echo "ERROR: creating company profile";
     echo "<script>window.location.href='profile-manage.php'</script>";
   }

 }


 
}


                                 //mysqli_close($link);
mysqli_close($link);

?>



<?php
        //data validation
function valData($data) {
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
                <li class="breadcrumb-item active">Company Profile</li>
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
                    <h3 class="card-title">Company Profile</h3>
                  </div>
                </div>

                <div class="card-body">
                 
                  <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>?compId=<?php echo $get_id; ?>">
                    <div class="form-group">
                      <label>Company Name</label>
                      <input type="text" name="comp_name" class="form-control" value = "<?php echo $name; ?>" required>
                    </div>

                    <div class="form-group">
                      <label>Address</label>
                      <input type="text" name="comp_address" class="form-control" value = "<?php echo $address; ?>" required>
                    </div>

                    <div class="form-group">
                      <label>Telephone</label>
                      <input type="number" name="comp_tel" class="form-control" value = "<?php echo $tel; ?>" required>
                    </div>

                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="comp_email" class="form-control" value = "<?php echo $email; ?>" required>
                    </div>

                    <div class="form-group">
                      <label>Website</label>
                      <input type="text" name="comp_site" class="form-control" value = "<?php echo $site; ?>" required>
                    </div>

                    <div class="form-group">
                      <label>Created By:</label>
                      <input type="text" class="form-control" value = "<?php echo $createdBy; ?>" readonly>
                    </div>

                    <div class="form-group">
                      <label>Created At:</label>
                      <input type="text" class="form-control" value = "<?php echo $createdAt; ?>" readonly>
                    </div>
                  
                  </div>

                  <div class="card-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button href="profile-manage.php" class="btn btn-caution">Cancel</button>
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
    <!-- REQUIRED SCRIPTS -->
    <?php include "includes/js.php"; ?>




  </body>
  </html>