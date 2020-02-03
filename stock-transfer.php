<?php
require_once 'config.php';
include('session.php');
?>


<?php
$alertMessage = "";
$i = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //Assigning posted values to variables.
  $warehouse_orig = test_input($_POST['warehouse_orig']);
  $warehouse_dest = test_input($_POST['warehouse_dest']);
  $product = test_input($_POST['product']);
  $qty = test_input($_POST['qty']);
  $date = test_input($_POST['date']);
  $refno = test_input($_POST['refno']);
  $remarks = test_input($_POST['remarks']);

  if($warehouse_dest == $warehouse_orig){
    exit("<script>alert('You cannot transfer stock to the same warehouse. Press the OK button then refresh the page to try again')</script>");
  } else {

  // Check input errors before inserting in database
  if(!empty($product) && !empty($warehouse_orig) && !empty($qty) && !empty($warehouse_dest) && !empty($refno)){
                
                $sql_check = "SELECT * FROM stocks WHERE product ='$product' AND warehouse ='$warehouse_orig'";
                if($result = mysqli_query($link, $sql_check)){
                  if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                        $stocks_qty = $row['quantity'];
                        $stocks_product = $row['product'];
                        // echo "<script>alert('$stocks_product')</script>";
                        // echo "<script>alert('$stocks_qty')</script>";
                        // echo "<script>alert('$qty')</script>";
                              if($stocks_qty <= $qty){
                                echo "<script>alert('Insufficient Stock in Warehouse Origin');window.location.href = 'stock-transfer.php';</script>";
                                  //die();
                              } else {
                                //Proceed
                              }
                        }
                  } else {
                  echo "<script>alert('Stock doesn't exist in Warehouse Origin');window.location.href = 'stock-transfer.php';</script>";
                  }
                  
                } else {
                echo "<script>alert('Stock doesn't exist in Warehouse Origin');window.location.href = 'stock-transfer.php';</script>";
                }

                $account = $_SESSION["username"];//session name
                  $IDtype = "TRTX";
                  $m = date('m');
                  $y = date('y');
                  $d = date('d');

                  $qryID = mysqli_query($link,"SELECT MAX(transferId) FROM `transfertb` "); // Get the latest ID
                  $resulta = mysqli_fetch_array($qryID);
                  $newID = $resulta['MAX(transferId)'] + 1; //Get the latest ID then Add 1
                  $custID = str_pad($newID, 8, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
                  $tranxid = $IDtype.$custID; //Prepare custom ID
                
                $query = "
                INSERT INTO `transfertb` (trans_Id, warehouse_origin, warehouse_dest, product, quantity, trans_date, refNum, remarks, created_by, created_at)
                VALUES ('$tranxid', '$warehouse_orig', '$warehouse_dest', '$product', '$qty', '$date', '$refno', '$remarks','$account', '$date')"; //Prepare insert query
                $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query
                if($result){  

                $sql_check = "SELECT * FROM stocks WHERE product ='$product' AND warehouse ='$warehouse_dest'";
                if($result = mysqli_query($link, $sql_check)){ //CHECK KUNG EXISTING UNG PRODUCT SA WAREHOUSE

                if(mysqli_num_rows($result) > 0){ //KAPAG EXISTING UNG PRODUCT SA WAREHOUSE, ADD LANG NG QUANTITY
                    //echo "<script>alert('Existing')</script>";
                    $query = "
                    UPDATE `stocks` SET quantity = quantity + '$qty' WHERE product ='$product' AND warehouse ='$warehouse_dest'"; //Prepare insert query
                    $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query

                    if($result){
                    $query = "UPDATE `stocks` SET quantity = quantity - '$qty' WHERE product ='$product' AND warehouse ='$warehouse_orig'"; //Prepare insert query
                    $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query
                        if($result){   
                            $info = $_SESSION['username']."  new stock transfered";
                            $info2 = "Details: ".$product.", ".$qty." pcs on: " .$warehouse_dest. " from: ".$warehouse_orig;
                            $alertlogsuccess = $product.", ".$qty." pcs: has been transfered succesfully!";
                            include "logs.php";
                            echo "<script>window.location.href='stock-transfer-manage.php'</script>"; 

                        } else {
                          echo "<script>alert('Failed deducting stocks from warehouse orig')</script>";
                        }      
                      }else{
                      echo "<script>alert('Failed transfering stocks')</script>";
                      }
                } else { 
                //echo "<script>alert('Not Existing')</script>";
                $account = $_SESSION["username"];//session name

                $query = "
                INSERT INTO `stocks` (product, warehouse, quantity, status, created_by)
                VALUES ('$product', '$warehouse_dest', '$qty', 'In Stock','$account')"; //Prepare insert query
                $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query


                if($result){
                  $query = "UPDATE `stocks` SET quantity = quantity - '$qty' WHERE product ='$product' AND warehouse ='$warehouse_orig'"; //Prepare insert query
                    $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query
                    if($result){   
                      $info = $_SESSION['username']."  new stock transfered";
                      $info2 = "Details: ".$product.", ".$qty." pcs on: " .$warehouse_dest. " from: ".$warehouse_orig;
                      $alertlogsuccess = $product.", ".$qty." pcs: has been created and transfered succesfully!";
                      include "logs.php";
                      echo "<script>window.location.href='stock-transfer-manage.php'</script>";
                    } else {
                      echo "<script>alert('Failed deducting stocks from warehouse orig')</script>";
                    }
                }else{
                echo "<script>alert('Failed adding new stocks')</script>";
                }
                mysqli_close($link);
                }

                } else {
                  echo "<script>alert('Failed adding new stock transfer')</script>";
                }


    } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }


  } else {
  echo "<script>alert('Enter all required fields')</script>";
  }
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
                    <h3 class="card-title">Transfer Stocks</h3>

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
                          <input type="text" class="form-control" placeholder="pcs" name="qty" id="" onkeypress="return isNumberKey(event)" required>

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
                          <input type="text" class="form-control" placeholder="Reference No." oninput="upperCase(this)" name="refno" id="" required>

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
                    <button type="submit" name="transfer" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();" class="btn btn-primary" >Transfer</button>
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