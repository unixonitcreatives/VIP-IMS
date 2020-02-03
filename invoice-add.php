<?php include "session.php";?>
<?php


require_once 'config.php';
$alertMessage=$invRemarks="";




if(isset($_POST['fullypaid'])){
  //Step 1: Prepare Variables

  $invCustName  = valData($_POST['invCustName']);
  $invWarehouse  = valData($_POST['invWarehouse']);
  $invDate      = valData($_POST['invDate']);
  $invRemarks   = valData($_POST['invRemarks']);
  $invMot   = valData($_POST['invMot']);
  $invReceivedBy   = valData($_POST['invReceivedBy']);
  

  //Step 2: Check for empty fields
  if(empty($invCustName) || empty($invDate)){

  } else {

    $q = 0; $count = count($_POST['invProduct']);
    for ($q = 0; $q < $count; $q++) {
    //echo "<script>alert('Pumasok sa Loop')</script>";
    $product = $_POST['invProduct'][$q];
    $qty = $_POST['invQty'][$q];

    $query = "SELECT * FROM product_model WHERE model = '$product' ORDER BY type desc";
    $result = mysqli_query($link, $query);
    if(mysqli_num_rows($result) > 0){ //If A
        while($rows = mysqli_fetch_array($result)){ //While A
          $type = $rows['type'];
          $model = $rows['model'];

          if($type == 'retail'){ //If B
            //echo "<script>alert('Retail');</script>";
            $query = "SELECT * FROM stocks WHERE product = '$model' AND warehouse = '$invWarehouse'";
            if($result = mysqli_query($link, $query)){
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                  $stocks_qty = $row['quantity'];
                  $stocks_product = $row['product'];
                        if($stocks_qty <= $qty){
                          echo "<script>alert('Insufficient stock in warehouse');
                          alert('$product');
                          window.location.href = 'invoice-add.php';</script>";
                          die();
                        } else {
                          //Proceed
                        }
                }
              } else {
              echo "<script>alert('Stock, doesnt exist in Warehouse');
              alert('$product');
              window.location.href = 'invoice-add.php';</script>"; die();
            }
          }

          } elseif ($type =='package') {
            //echo "<script>alert('Package');</script>";
            $query = ""; $resulta = "";
            $query = "SELECT * FROM product_model WHERE model = '$product'";
            $resulta = mysqli_query($link, $query);
            if(mysqli_num_rows($resulta) > 0){
              while($rowsa = mysqli_fetch_array($resulta)){
                $model_id = $rowsa['model_id'];
              }
            }

            $query = ""; $resulta = "";
            $query = "SELECT * FROM package_list WHERE model_id = '$model_id'";
            $resulta = mysqli_query($link, $query);
            if(mysqli_num_rows($resulta) > 0){
              while($rowsa = mysqli_fetch_array($resulta)){
                $pkg_pm = $rowsa['pack_list_model'];
                $pkg_qty = $rowsa['pack_list_qty'] * $qty;

                $sql_check = "SELECT * FROM stocks WHERE product = '$pkg_pm' AND warehouse = '$invWarehouse'";
                      if($result = mysqli_query($link, $sql_check)){
                        if(mysqli_num_rows($result) > 0){
                              while($row = mysqli_fetch_array($result)){
                                $stocksa_qty = $row['quantity'];
                                $stocksa_product = $row['product'];
                                //echo "<script>alert('$stocksa_qty');</script>";
                                //echo "<script>alert('$pkg_qty');</script>";
                                if($stocksa_qty <= $pkg_qty){
                                  echo "<script>alert('Insufficient stock in warehouse');
                                  alert('$product');
                                  window.location.href = 'invoice-add.php';</script>";
                                  die();
                                } else {
                                  //Proceed
                                  //echo "<script>alert('OK naman');</script>";
                                }

                              }

                        } else {
                          echo "<script>alert('Stock, doesnt exist in Warehouse');
                          alert('$product');
                          window.location.href = 'invoice-add.php';</script>"; die();
                        }

                      }
              } //While
            } //If

          } else {

          } //If B

        } //While A
    }//If A 
    else {
      echo "<script>alert('Didnt Worked');
      window.location.href = 'invoice-add.php';</script>"; die();
    }



    } // For Loop
    //echo "<script>alert('End Loop');</script>";
    //If all fields are !empty, Step 3: Prepare Custom ID then add to
    include ('invoice-obtx-id.php');

    $account = $_SESSION["username"];//session name


    //Step: 4 Insert query to outboundTB table
    $obQuery = "INSERT INTO outboundtb (ob_tx_id, ob_custName, ob_warehouse, ob_date, ob_remarks, ob_mot, ob_status, ob_received_by, ob_created_by)
    VALUES ('$obtxid','$invCustName', '$invWarehouse', '$invDate', '$invRemarks', '$invMot', 'Fully Paid', '$invReceivedBy', '$account')";
    $obResult = mysqli_query($link, $obQuery) or die(mysqli_error($link));

    if ($obResult === TRUE) { //if Step: 4 is success

        //Step: 5 Save the data of the invoice to obdatatb table
      $j = 0; $count = count($_POST['invProduct']);
        //Counts the elements in array
        // Use insert_id property to get the id of previous table (packages table)
      $obID = $link->insert_id;
      for ($j = 0; $j < $count; $j++) {

        $listquery = "INSERT INTO obdatatb (outbound_ID, ob_tx_id, obdata_products, obdata_qty) VALUES (
        '".$obID."',
        '".$obtxid."',
        '".$_POST['invProduct'][$j]."',
        '".$_POST['invQty'][$j]."')";
        $listresult = mysqli_multi_query($link, $listquery) or die(mysqli_error($link));
        
        } //Step: 5 forloop end
        
        //Step: 6 Update Stocks
        if($listresult === TRUE){ //If Step: 5 is success
          //Prepare Select OBdata Info Query

          $query = "SELECT obdata_products, obdata_qty FROM obdatatb WHERE ob_tx_id = '".$obtxid."'";
          //Execute Query
          if($result = mysqli_query($link, $query)){ //If Step: 6 is success
          //If execute success
              //Update ung stocks
              if(mysqli_num_rows($result) > 0){ //Step: 7 Success
                    while($row = mysqli_fetch_array($result)){ //Step: 8 Success

                      $order_product_model = $order_qty = $pm_type = "";

                      $order_product_model = $row['obdata_products'];
                      $order_qty  = $row['obdata_qty'];

                                  //Check Product Model Type
                      $pm_type_checker_query = "SELECT type FROM product_model WHERE model = '$order_product_model' ORDER BY type desc" ;

                      $pm_result = mysqli_query($link, $pm_type_checker_query);

                                  if(mysqli_num_rows($pm_result) > 0){ //Step: 9

                                    while($rows = mysqli_fetch_array($pm_result)){
                                      $pm_type = $rows['type'];

                                      //Check Product Model Type End
                                      if($pm_type=='retail'){ //if PM is Retail
                                        $query_stock = "UPDATE stocks SET quantity = quantity - '$order_qty' WHERE product = '$order_product_model' AND warehouse = '$invWarehouse'";
                                        mysqli_query($link, $query_stock) or die(mysqli_error($link)); //Execute  insert query

                                      } elseif ($pm_type=='package') { //if PM is Package
                                        //Get Package List
                                        //Stock Update
                          
                                        $query = ""; $resulta = "";
                                        $query = "SELECT * FROM product_model WHERE model = '$order_product_model'";
                                        $resulta = mysqli_query($link, $query);
                                        if(mysqli_num_rows($resulta) > 0){
                                          while($rowsa = mysqli_fetch_array($resulta)){
                                            $model_id = $rowsa['model_id'];
                                          }
                                        }

                                        $query = ""; $resulta = "";
                                        $query = "SELECT * FROM package_list WHERE model_id = '$model_id'";
                                        $resulta = mysqli_query($link, $query);
                                        if(mysqli_num_rows($resulta) > 0){
                                          while($rowsa = mysqli_fetch_array($resulta)){
                                            $pkg_pm = $rowsa['pack_list_model'];
                                            $pkg_qty = $rowsa['pack_list_qty'];
                                            $query_stock = "UPDATE stocks SET quantity = quantity - ($pkg_qty * $order_qty)  WHERE product = '$pkg_pm' AND warehouse = '$invWarehouse'";
                                            mysqli_query($link, $query_stock) or die(mysqli_error($link)); //Execute 
                                          }
                                        }


                                      } 

                                      

                                    }

                                  } //Step: 9 Close

                                  echo "<script>alert('Success Add Invoice $obtxid');</script>";
                    } //Step: 8 Fail


              } else { //Step: 7 Fail
                echo "<script>alert('An error has occured. Please Contact Support.')</script>";
              }

          } else { //If Step: 6 failed
            echo "<script>alert('An error has occured. Please Contact Support.')</script>";
          }

        } else {  //If Step: 5 is fail
          echo "<script>alert('Adding invoice failed. Please Contact Support.')</script>";
        }

    } else { //if Step: 4 is fail
      echo "<script>alert('Please enter required fields')</script>";
      echo "Bullshit";
    }

    
  }


  
}//isset end

if(isset($_POST['unpaid'])){
  //Step 1: Prepare Variables

  $invCustName  = valData($_POST['invCustName']);
  $invWarehouse  = valData($_POST['invWarehouse']);
  $invDate      = valData($_POST['invDate']);
  $invRemarks   = valData($_POST['invRemarks']);
  $invMot   = valData($_POST['invMot']);
  $invReceivedBy   = valData($_POST['invReceivedBy']);

  //Step 2: Check for empty fields
  if(empty($invCustName) || empty($invDate)){

  } else {

  //If all fields are !empty, Step 3: Prepare Custom ID then add to

    include ('invoice-obtx-id.php');

    $account = $_SESSION["username"];//session name


    //Step: 4 Insert query to outboundTB table
    $obQuery = "INSERT INTO outboundtb (ob_tx_id, ob_custName, ob_warehouse, ob_date, ob_remarks, ob_mot, ob_status, ob_received_by, ob_created_by)
    VALUES ('$obtxid','$invCustName', '$invWarehouse', '$invDate', '$invRemarks', '$invMot', 'Unpaid', '$invReceivedBy', '$account')";
    $obResult = mysqli_query($link, $obQuery) or die(mysqli_error($link));

    if ($obResult === TRUE) { //if Step: 4 is success

        //Step: 5 Save the data of the invoice to obdatatb table
      $j = 0; $count = count($_POST['invProduct']);
        //Counts the elements in array
        // Use insert_id property to get the id of previous table (packages table)
      $obID = $link->insert_id;
      for ($j = 0; $j < $count; $j++) {

        $listquery = "INSERT INTO obdatatb (outbound_ID, ob_tx_id, obdata_products, obdata_qty) VALUES (
        '".$obID."',
        '".$obtxid."',
        '".$_POST['invProduct'][$j]."',
        '".$_POST['invQty'][$j]."')";
        $listresult = mysqli_multi_query($link, $listquery) or die(mysqli_error($link));
        
        } //Step: 5 forloop end
        
        //Step: 6 Update Stocks
        if($listresult === TRUE){ //If Step: 5 is success
          //Prepare Select OBdata Info Query

          $query = "SELECT obdata_products, obdata_qty FROM obdatatb WHERE ob_tx_id = '".$obtxid."'";
          //Execute Query
          if($result = mysqli_query($link, $query)){ //If Step: 6 is success
          //If execute success
              //Update ung stocks
              if(mysqli_num_rows($result) > 0){ //Step: 7 Success
                    while($row = mysqli_fetch_array($result)){ //Step: 8 Success

                      $order_product_model = $order_qty = $pm_type = "";

                      $order_product_model = $row['obdata_products'];
                      $order_qty  = $row['obdata_qty'];

                                  //Check Product Model Type
                      $pm_type_checker_query = "SELECT type FROM product_model WHERE model = '$order_product_model' ORDER BY type desc" ;

                      $pm_result = mysqli_query($link, $pm_type_checker_query);

                                  if(mysqli_num_rows($pm_result) > 0){ //Step: 9

                                    while($rows = mysqli_fetch_array($pm_result)){
                                      $pm_type = $rows['type'];

                                      //Check Product Model Type End
                                      if($pm_type=='retail'){ //if PM is Retail
                                        $query_stock = "UPDATE stocks SET quantity = quantity - '$order_qty' WHERE product = '$order_product_model' AND warehouse = '$invWarehouse'";
                                        mysqli_query($link, $query_stock) or die(mysqli_error($link)); //Execute  insert query

                                      } elseif ($pm_type=='package') { //if PM is Package
                                        //Get Package List
                                        //Stock Update
                          
                                        $query = ""; $resulta = "";
                                        $query = "SELECT * FROM product_model WHERE model = '$order_product_model'";
                                        $resulta = mysqli_query($link, $query);
                                        if(mysqli_num_rows($resulta) > 0){
                                          while($rowsa = mysqli_fetch_array($resulta)){
                                            $model_id = $rowsa['model_id'];
                                          }
                                        }

                                        $query = ""; $resulta = "";
                                        $query = "SELECT * FROM package_list WHERE model_id = '$model_id'";
                                        $resulta = mysqli_query($link, $query);
                                        if(mysqli_num_rows($resulta) > 0){
                                          while($rowsa = mysqli_fetch_array($resulta)){
                                            $pkg_pm = $rowsa['pack_list_model'];
                                            $pkg_qty = $rowsa['pack_list_qty'];
                                            $query_stock = "UPDATE stocks SET quantity = quantity - ($pkg_qty * $order_qty)  WHERE product = '$pkg_pm' AND warehouse = '$invWarehouse'";
                                            mysqli_query($link, $query_stock) or die(mysqli_error($link)); //Execute 
                                          }
                                        }


                                      } 

                                      

                                    }

                                  } //Step: 9 Close

                                  echo "<script>alert('Success Add Invoice $obtxid');</script>";
                    } //Step: 8 Fail


              } else { //Step: 7 Fail
                echo "<script>alert('An error has occured. Please Contact Support.')</script>";
              }

          } else { //If Step: 6 failed
            echo "<script>alert('An error has occured. Please Contact Support.')</script>";
          }

        } else {  //If Step: 5 is fail
          echo "<script>alert('Adding invoice failed. Please Contact Support.')</script>";
        }

    } else { //if Step: 4 is fail
      echo "<script>alert('Please enter required fields')</script>";
      echo "Bullshit";
    }

    
  }


  
}//isset end


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
                <li class="breadcrumb-item active">Add Invoice</li>
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
                    <h3 class="card-title">Add Invoice</h3>
                    <a href="invoice-manage.php">View all invoice</a>
                  </div>
                </div>

                <div class="card-body">
                  <?php echo $alertMessage; ?>
                  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Customer</label><a href="members-add.php"> + add new member</a>
                          <select class="form-control select2" oninput="upperCase(this)"  name="invCustName" required>
                            <option value="">Select Member</option>
                            <?php
                            $query = "";
                            $query = "SELECT * FROM customers WHERE status = 'Active' ORDER BY member_id desc";
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
                          <label>Warehouse</label><a href="warehouse-add.php"> + add new warehouse</a>
                          <select class="form-control select2" oninput="upperCase(this)"  name="invWarehouse" required>
                            <option value="">Select Warehouse</option>
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
                      </div>


                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Date:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="date" name="invDate" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" placeholder="mm/dd/yyyy" data-mask im-insert="false" onkeydown="return false" required>
                          </div>
                          <!-- /.input group -->
                        </div>

                      
                      </div>
                    </div>


                    <table class="table" role="grid" aria-describedby="example2_info" id="invTable">
                      <thead>
                        <tr>
                          <th width="60%">Product/s Description</th>
                          <th width="30%">Quantity</th>
                          <th></th>
                    <!-- <th>Unit Price</th>
                      <th>Total Price</th> -->
                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $arrayNumber = 0;
                    for($x =1; $x < 3; $x++){ ?> <!-- == loop start == -->
                    <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
                      <td>
                        <div class="from-group">
                          <select class="form-control" style="width: 100%;" name="invProduct[]" id="prod-mod<?php echo $x; ?>" onchange="get-prod-model-data(<?php echo $x;?>)" required>
                            <option value="">Select Product</option>
                            <?php
                            // Include config file
                            require_once "config.php";
                            // Attempt select query executions
                            $query = "";
                            $query = "SELECT model FROM product_model ORDER BY type, model asc";
                            if($result = mysqli_query($link, $query)){
                              if(mysqli_num_rows($result) > 0){

                                while($row = mysqli_fetch_array($result)){

                                  echo "<option value='".$row['model']."' id='changeProduct".$row['model']."'>" . $row['model'] .  "</option>";
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
                          <input type="text" class="form-control" placeholder="Quantity" name="invQty[]" id="moddQty<?php echo $x; ?>" onkeypress="return isNumberKey(event)" required>
                        </td>
                  <td>
                    <button class="btn btn-sm btn-danger removeModelRowBtn" type="button" id="<?php echo $x; ?>" onclick="removeModelRow(<?php echo $x; ?>)"><i class="nav-icon fas fa-minus"></i></button>
                  </td>
                </tr>
                <?php $arrayNumber++; } ?> <!-- == loop end == -->
              </tbody>
              <tfoot>
                <tr>
                
                <td colspan="3" align="center" width="20%"><button type="button" class="btn btn-sm btn-success" onclick="invAddRow()" id="invAddRowBtn" data-loading-text="Loading..."><i class="nav-icon fas fa-plus"></i> Add Row</button></td>
              </tr>
              </tfoot>

            </table>

           
              
              <br>

            <div class="form-group">
              <label>Mode of Transfer: </label><br>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="invMot" value="Shipped">
              <label class="form-check-label">For Shipping</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="invMot" value="Pick-up" checked>
              <label class="form-check-label">For Pick-up</label>
            </div>
    
            </div>

            <div class="form-group">
            <label>Note: </label><br>
            <input type="text" class="form-control" oninput="upperCase(this)" placeholder="Name of recipient or Delivery Tracking No." name="invReceivedBy"  required>
            </div>

            <div class="form-group">
            <label>Remarks</label><small> (Only Staff & Admins can see this)</small><br>
            <textarea class="form-control" width="100%" rows="5" style="resize: none;" placeholder="" name="invRemarks"></textarea>
            </div>

          </div>

          <div class="card-footer">
            <button type="submit" name="fullypaid" class="btn btn-success">Fully Paid</button>
            <button type="submit" name="unpaid" class="btn btn-warning">Unpaid</button>
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