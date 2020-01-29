<?php
require_once 'config.php';
include('session.php');
?>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //Assigning posted values to variables.
    $warehouse_orig = test_input($_POST['warehouse_orig']);
    $warehouse_dest = test_input($_POST['warehouse_dest']);
    $product = test_input($_POST['product']);
    $qty = test_input($_POST['qty']);
    $date = test_input($_POST['date']);
    $refno = test_input($_POST['refno']);
    $remarks = test_input($_POST['remarks']);

    $i = 0;
    if(empty($warehouse_orig) && empty($warehouse_dest)){
    $i = 1;
    }

    if(empty($product) && empty($qty)){
    $i = 1;
    }

    if(empty($date) && empty($refno)){
    $i = 1;
    }

    //Check kung pareho ba ung Origin and Destination, dapat magkaiba kasi
    if(!empty($warehouse_orig) && !empty($warehouse_dest)){ 
      if($warehouse_orig == $warehouse_dest){
      $i = 1;
      echo "<script>alert('Warehouse Origin & Destination cant be the same')</script>";
      }
    }

    //Check kung may stock paba ung origin, baka wala na
    if(!empty($warehouse_orig) && !empty($warehouse_dest) && !empty($product) && !empty($qty)){
      checkStock();
    }

  

function checkStock(){
$qry = "SELECT * FROM stocks WHERE product = '$product' AND warehouse = '$warehouse_orig'";
$result = mysqli_query($link, $qry);
  if(mysqli_num_rows($result) > 0){
    while($rows = mysqli_fetch_array($pm_result)){
      $stockQty = $rows['quantity'];
    }

  } else {
    $i = 1;
    echo "<script>alert('Product is not available on warehouse origin')</script>";
  }

  if($stockQty < $qty){
    $i = 1;
    echo "<script>alert('Not enough stocks on warehouse origin')</script>";
  } else {
    $i = 0;
  }
  return;
}

  if($i == 0){
      echo "<script>alert('ORAYT')</script>";
  }

} //POST
   
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
                <li class="breadcrumb-item active">Stock Transfer</li>
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
                    <h3 class="card-title"><strong><b>Notice:</b></strong> This page is under development and its not yet working properly. "Stock Transfer" </h3>
                  
                  </div>
                </div>

                <div class="card-body">
                  <?php echo $alertMessage; ?>
                  <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="row">
                      <div class="col-md-6">
                        

                        <div class="form-group">
                          <label>Warehouse Origin</label>
                          <select class="form-control select2" oninput="upperCase(this)"  name="warehouse_orig" required>
                            <option value="">Select Warehouse Origin</option>
                            <?php
                            $queryWarehouse = "";
                            $queryWarehouse = "SELECT name FROM warehouse";
                            if($resultWarehouse = mysqli_query($link, $queryWarehouse)){
                              if(mysqli_num_rows($resultWarehouse) > 0){
                                while($row = mysqli_fetch_array($resultWarehouse)){

                                  echo "<option value='".$row['name']."'>" . $row['name'] .  "</option>";
                                }

                                        // Free result set
                                mysqli_free_result($resultWarehouse);
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
                          <label>Warehouse Destination</label>
                          <select class="form-control select2" oninput="upperCase(this)"  name="warehouse_dest" required>
                            <option value="">Select Warehouse Destination</option>
                            <?php
                            $queryWarehouse = "";
                            $queryWarehouse = "SELECT name FROM warehouse";
                            if($resultWarehouse = mysqli_query($link, $queryWarehouse)){
                              if(mysqli_num_rows($resultWarehouse) > 0){
                                while($row = mysqli_fetch_array($resultWarehouse)){

                                  echo "<option value='".$row['name']."'>" . $row['name'] .  "</option>";
                                }

                                        // Free result set
                                mysqli_free_result($resultWarehouse);
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
                          <label>Product</label>
                          <select class="form-control select2" oninput="upperCase(this)"  name="product" required>
                            <option value="">SELECT PRODUCT</option>
                            <?php
                            $queryWarehouse = "";
                            $queryWarehouse = "SELECT * FROM product_model WHERE type='retail'";
                            if($resultWarehouse = mysqli_query($link, $queryWarehouse)){
                              if(mysqli_num_rows($resultWarehouse) > 0){
                                while($row = mysqli_fetch_array($resultWarehouse)){

                                  echo "<option value='".$row['model']."'>" . $row['model'] .  "</option>";
                                }

                                        // Free result set
                                mysqli_free_result($resultWarehouse);
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
                          <label>Quantity</label>
                          <input type="text" class="form-control" placeholder="pcs" name="qty" id="" required>

                        </div>
                        
                      </div>


                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Date:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="date" name="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" placeholder="mm/dd/yyyy" data-mask im-insert="false" onkeydown="return false" required>
                          </div>
                          <!-- /.input group -->
                        </div>

                        <div class="form-group">
                          <label>Reference No.</label>
                          <input type="text" class="form-control" placeholder="Reference No." name="refno" id="" required>

                        </div>

                       

                      
                      </div>
                    </div>




            <div class="form-group">
              <label>Remarks</label><br>
              <textarea class="form-control" width="100%" rows="5" style="resize: none;" placeholder="" name="remarks"></textarea>

              <br>
            </div>

          </div>

          <div class="card-footer">
            <button type="submit" name="transfer" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();" class="btn btn-primary" disabled>Transfer</button>
            <strong><b>Notice:</b></strong> This page is under development and its not yet working properly. "Stock Transfer"
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