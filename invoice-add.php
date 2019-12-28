<?php include "session.php";

$account="";
$_SESSION["username"] = $account;?>

<?php
// Define variables and initialize with empty values
$name=$password=$usertype=$alertMessage="";
require_once "config.php";

//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  //Assigning posted values to variables.
  $name = test_input($_POST['name']);
  $password = test_input($_POST['password']);
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
        VALUES ('$custnewID', '$username', '$password', '$usertype', '$account')"; //Prepare insert query

        $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query


        if($result){
          //echo "<script>alert('new staff added succesfully');</script>";


        }else{
          //If execution failed
          $alertMessage = "<div class='alert alert-danger' role='alert'>
          Error adding data.
          </div>";
        }
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
                <li class="breadcrumb-item active">Add Package</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <?php echo $alertMessage; ?>
      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">Add Invoice</h3>
                    <a href="invoice-manage.php">View all invoice</a>
                  </div>
                </div>

                <div class="card-body">
                  <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Customer</label><a href="customer-add.php"> + new customer</a>
                          <select class="form-control select2" oninput="upperCase(this)"  name="invCustName" required>
                            <option value="">~~SELECT CUSTOMER~~</option>
                            <?php
                            // Include config file
                            require_once "config.php";
                            // Attempt select query executions
                            $query = "";
                            $query = "SELECT * FROM customers ORDER BY custID desc";
                            // $query = "SELECT * FROM orders WHERE name LIKE '%$name%' AND item LIKE '%$item%' AND status LIKE '%$status%'";
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
                          <label>Date masks:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="date" name="invDate" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask im-insert="false">
                          </div>
                          <!-- /.input group -->
                        </div>
                        <!-- <div class="form-group">
                        <label>Warehouse</label><a href="warehouse-add.php"> + new warehouse</a>

                        <select class="form-control select2" style="width: 100%;" oninput="upperCase(this)"  data-placeholder="Warehouse" name="warehouse" required>
                        <?php /*
                        // Include config file
                        require_once "config.php";
                        // Attempt select query executions
                        $query = "";
                        $query = "SELECT * FROM warehouse ORDER BY custID asc";
                        // $query = "SELECT * FROM orders WHERE name LIKE '%$name%' AND item LIKE '%$item%' AND status LIKE '%$status%'";
                        if($result = mysqli_query($link, $query)){
                        if(mysqli_num_rows($result) > 0){

                        while($row = mysqli_fetch_array($result)){

                        echo "<option value='".$row['custID']."'>" . $row['name'] .  "</option>";
                      }

                      // Free result set
                      mysqli_free_result($result);
                    } else{
                    echo "<p class='lead'><em>No records were found.</em></p>";
                  }
                } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
              }


              */ ?>
            </select>
          </div>-->

        </div>
      </div>

      <table class="table table-bordered table-hover" role="grid" aria-describedby="example2_info" id="invTable">
        <thead>
          <tr>
            <th width="50%">Product Model</th>
            <th width="30%">Quantity</th>
            <!-- <th>Unit Price</th>
            <th>Total Price</th> -->
            <th width="20%"><button type="button" class="btn btn-success" onclick="invAddRow()" id="invAddRowBtn" data-loading-text="Loading..."><i class="nav-icon fas fa-plus"> Add Row</i></button></th>
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
                    <option value="">~~Select Product~~</option>
                    <?php
                    // Include config file
                    require_once "config.php";
                    // Attempt select query executions
                    $query = "";
                    $query = "SELECT custID, description FROM product_model";
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

                <td>
                  <input type="text" class="form-control" placeholder="Quantity" name="modelQty[]" id="moddQty<?$php echo $x; ?>" required>
                </td>
                <!-- <td>
                <input type="text" class="form-control" placeholder="Price" name="modelQty[]" id="moddQty<?$php //echo $x; ?>" required>
              </td>
              <td>
              <input type="text" class="form-control" placeholder="Total Amount" name="modelQty[]" id="moddQty<?$php //echo $x; ?>" required>
            </td>
          -->
          <td>
            <button class="btn btn-danger removeModelRowBtn" type="button" id="removeModelRowBtn" onclick="removeModelRow(<?php echo $x; ?>)"><i class="nav-icon fas fa-minus"></i></button>
          </td>
        </tr>
        <?php $arrayNumber++; } ?> <!-- == loop end == -->
      </tbody>

    </table>

    <div class="form-group">
      <label>Remarks</label><br>
      <textarea class="form-control" width="100%" rows="5" style="resize: none;" placeholder="" name="note"></textarea>
      <!--<input type="text" class="form-control">-->
      <br>

    </div>

  </div>

  <div class="card-footer">
    <div class="btn-group">
      <button type="button" class="btn btn-success">Action/s</button>
      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
        <div class="dropdown-menu" role="menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-1px, -3px, 0px);">
          <a class="dropdown-item" href="#">Fully Paid</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Unpaid</a>
        </div>
      </button>
    </div>
    <button type="button" class="btn btn-secondary">Clear</button>
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
