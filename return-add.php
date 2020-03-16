
<?php
include "session.php";
$Admin_auth = 1;
$Stock_auth = 0;
$Area_Center_auth = 0;
include('includes/user_auth.php');
?>

<?php

require_once "config.php";
// Define variables and initialize with empty values
$username=$password=$usertype=$alertMessage="";

$account = $_SESSION["username"];?>

<?php
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
//Assigning posted values to variables.
  $date_p = test_input($_POST['date_p']);
  $si = test_input($_POST['trans']);
  $customer = test_input($_POST['customer']);
  $item = test_input($_POST['item']);
  $warehouse = test_input($_POST['warehouse']);
  $qty = test_input($_POST['qty']);
  $cashier = test_input($_POST['cashier']);
  $remarks = test_input($_POST['remarks']);

if(empty($date_p) || empty($si) || empty($customer) || empty($item) || empty($qty) || empty($cashier)){
echo "<script>alert('Please enter required fields');</script>";
}


// Check input errors before inserting in database
if(!empty($date_p) && !empty($si) && !empty($customer) && !empty($item) && !empty($qty) && !empty($cashier)){
//Check if the username is already in the database
$sql_check = "SELECT model, sku FROM `product_model` WHERE model ='$description' OR sku = '$sku' ";
if($result = mysqli_query($link, $sql_check)){ //Execute query
if(mysqli_num_rows($result) > 0){
          //If the username already exists
          //Try another username pop up
echo "<script>alert('Product Model or SKU already exist');</script>";
mysqli_free_result($result);
} else{
          $date = date('Y-m-d');
          //If the username doesnt exist in the database
          //Proceed adding to database
          $query = "INSERT INTO returns (date_purchase, trans_id, customer, item, warehouse,qty, cashier, remarks, created_at) VALUES ('$date_p', '$si', '$customer', '$item', '$warehouse','$qty', '$cashier', '$remarks', '$date')"; 

          $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query



          if($result){
            // $info = $_SESSION['username']." added new return";
            // $info2 = "Details: ".$description.", ".$sku;
            // $alertlogsuccess = $description.", ".$sku.": has been added succesfully!";
            // include "logs.php";

            $qq = "INSERT INTO stocks (product,warehouse,quantity,status,created_by,created_at) 
            VALUES('$item','$warehouse','$qty', 'In Stock', '$account', 'CURRENT_TIMESTAMP')";

            $rr = mysqli_query($link,$qq);
            if($rr){
              echo "<script>alert('SUCCESS');</script>";
              echo "<script>window.location.href='return-manage.php'</script>";
            }
            

          }else{
            //If execution failed
            $alertMessage = "<div class='alert alert-danger' role='alert'>
            Error adding data.
            </div>";}
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
                  <li class="breadcrumb-item active">Add Return</li>
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
                      <h3 class="card-title">Add Return</h3>
                      <a href="return-manage.php">Manage Returns</a>
                    </div>
                  </div>

                  <div class="card-body">
                    <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                      
              <p><?php echo $alertMessage ?></p>
              <div class="form-group">
                <label>Date of Purchase</label> <!--<code class="text-orange">Max. 10 characters</code>-->
                <input type="date" class="form-control" style="width: 100%;" name="date_p" required>
              </div>
              
              <div class="form-group">
                <label>Transaction ID</label> <!--<code class="text-orange">Max. 10 characters</code>-->
                <select class="form-control select2" style="width: 100%;" name="trans" required>
                <?php 
                  
                  $q = "SELECT * FROM outboundtb WHERE ob_status='Fully Paid' OR ob_status='Installment'";
                  $r = mysqli_query($link,$q);
              
                  while($row = mysqli_fetch_assoc($r)){
                  
                ?>      
                  
                <option value="<?php echo $row['ob_tx_id']; ?>"> <?php echo $row['ob_tx_id']; ?></option>
                
               <?php }?>
              </select>
              </div>
                
              <div class="form-group">
                <label>Customer</label> <!--<code class="text-orange">Max. 10 characters</code>-->
                <select class="form-control select2" style="width: 100%;" name="customer" required>
                <?php 
                  
              $q = "SELECT * FROM customers";
              $r = mysqli_query($link,$q);
              
              while($row = mysqli_fetch_assoc($r)){
                  
                ?>      
                  
                <option value="<?php echo $row['name']; ?>"> <?php echo $row['name']; ?></option>
                
               <?php }?>
              </select>
              </div>

          <div class="form-group">
              <label>Item</label>
              <select class="form-control select2" style="width: 100%;" name="item" required>
                  <?php
                  
                  $qq = "SELECT * FROM product_model";
                  $rr = mysqli_query($link,$qq);
                  
                  while($row = mysqli_fetch_assoc($rr)){
                  ?>
                  
                  <option value="<?php echo $row['model']; ?>"><?php echo $row['model'] . '-' . $row['sku']; ?></option>
                
                  <?php }?>
              </select>
          </div>

           <div class="form-group">
              <label>Warehouse</label>
              <select class="form-control select2" style="width: 100%;" name="warehouse" required>
                  <?php
                  
                  $qq = "SELECT * FROM warehouse";
                  $rr = mysqli_query($link,$qq);
                  
                  while($row = mysqli_fetch_assoc($rr)){
                  ?>
                  
                  <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                
                  <?php }?>
              </select>
          </div>
                
          <div class="form-group">
              <label>Quantity</label>
              <input type="number" class="form-control" style="width: 100%;" name='qty' required>
          </div>
                
          <div class="form-group">
              <label>Cashier Name</label>
              <select class="form-control select2" style="width: 100%;" name="cashier" required>
                  <?php
                  
                  $qq = "SELECT * FROM users";
                  $rr = mysqli_query($link,$qq);
                  
                  while($row = mysqli_fetch_assoc($rr)){
                  ?>
                  
                  <option value="<?php echo $row['username']; ?>"><?php echo $row['username']; ?></option>
                
                  <?php }?>
              </select>
          </div>
                
          <div class="form-group">
              <label>Remarks</label>
              <textarea class="form-control" style="width: 100%;" name='remarks' rows="4"></textarea>
          </div>      
              
            <!-- /.box-body -->
         

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
