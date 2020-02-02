<?php
require_once 'config.php';
$alertMessage=$invRemarks="";

include "session.php";


$get_update_id = $_GET['ob_tx_id'];

$query = "SELECT * FROM outboundtb WHERE ob_tx_id = '$get_update_id' ";
if($result = mysqli_query($link, $query)){
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
      $obtxid         =   $row['ob_tx_id'];
      $obcustName     =   $row['ob_custName'];
      $obDate         =   $row['ob_date'];
      $obRemarks      =   $row['ob_remarks'];
      $obStatus       =   $row['ob_status'];
      $obCreatedBy    =   $row['ob_created_by'];
    }

    // Free result set
    mysqli_free_result($result);
  } else{
    echo "<p class='lead'><em>No records were found.</em></p>";
  }
} else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}


if(isset($_POST['fullypaid'])){

  $updateQuery = "UPDATE outboundtb SET ob_status = 'Paid' WHERE ob_tx_id = '$get_update_id' ";
  $obResult = mysqli_query($link, $updateQuery) or die(mysqli_error($link));

  if($obResult === TRUE){

    echo "<script>alert('Invoice status changed to fullypaid successfully');</script>";
    
    $info = $_SESSION['username']." changed invoice status to fullypaid";
                                    $info2 = "Details: ".$get_update_id;
                                    $alertlogsuccess = "Invoice status has been changed to fullypaid succesfully!";
                                    include('logs.php');
                                    echo "<script>window.location.href='invoice-unpaid.php';</script>";


  }else{
    $alertMessage = "<div class='alert alert-danger' role='alert'>
    Error updating status.
    </div>";
  }
    //INSERT query to so_transactions table end

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
                    <h3 class="card-title">Update Invoice</h3>
                    <a href="invoice-manage.php">View all invoice</a>
                  </div>
                </div>

                <div class="card-body">
                  <?php echo $alertMessage; ?>
                  <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>?ob_tx_id=<?php echo $get_update_id; ?>">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Customer</label><a href="customer-add.php"> + New Customer</a>
                          <select class="form-control select2" oninput="upperCase(this)"  name="invCustName" required readonly>
                            <option value="<?php echo $obcustName; ?>"><?php echo $obcustName; ?></option>
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
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Date:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="date" name="invDate" value="<?php echo $obDate; ?>" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask im-insert="false" readonly>
                          </div>
                          <!-- /.input group -->
                        </div>
                      </div>
                    </div>

                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Status</label>
                          <input type="text" value="<?php echo $obStatus; ?>" class="form-control" disabled>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Remarks</label>
                        <input type="text" value="<?php echo $obRemarks; ?>" class="form-control" disabled>
                        </div>
                      </div>
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




      <table class="table table-head-fixed">
        <thead>
          <tr>
            <th>Transaction ID/s</th>
            <th>Product/s</th>
            <th>Quantity</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT * FROM obdatatb WHERE ob_tx_id = '$get_update_id' ";
          if($result = mysqli_query($link, $query)){
            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_array($result)){
                $obtxid         =   $row['ob_tx_id'];
                $obproducts     =   $row['obdata_products'];
                $obqty          =   $row['obdata_qty'];
              ?>
          <tr>
          <td><?php echo $obtxid; ?></td>
          <td><?php echo $obproducts; ?></td>
          <td><?php echo $obqty; ?></td>
        </tr>
      <?php }

      // Free result set
      mysqli_free_result($result);
      } else{
      echo "<p class='lead'><em>No records were found.</em></p>";
      }
      } else{
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
      }
      ?>
      </tbody>

    </table>


  </div>

  <div class="card-footer">
    <button type="submit" name="fullypaid" class="btn btn-success">Fully Paid</button>
    <button type="reset" class="btn btn-secondary">Clear</button>
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
