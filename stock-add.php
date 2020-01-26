<?php include "session.php";?>

<?php
// Define variables and initialize with empty values
$product=$warehouse=$qty=$alertMessage="";
require_once "config.php";

//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //Assigning posted values to variables.
    $product = test_input($_POST['product']);
    $warehouse = test_input($_POST['warehouse']);
    $qty = test_input($_POST['qty']);
    // Check input errors before inserting in database
    if(empty($alertMessage)){
    $sql_check = "SELECT * FROM stocks WHERE product ='$product' AND warehouse ='$warehouse'";
    if($result = mysqli_query($link, $sql_check)){ //CHECK KUNG EXISTING UNG PRODUCT SA WAREHOUSE

                if(mysqli_num_rows($result) > 0){ //KAPAG EXISTING UNG PRODUCT SA WAREHOUSE, ADD LANG NG QUANTITY
                    $query = "
                    UPDATE `stocks` SET quantity = quantity + '$qty' WHERE product ='$product' AND warehouse ='$warehouse'"; //Prepare insert query
                    $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query

                     if($result){
                      echo "<script>alert('Successfuly added new stocks')</script>";
                      header("location:stock-manage.php");

                      }else{
                      echo "<script>alert('Failed adding new stocks')</script>";
                      }



                } else { //KAPAG HINDI PA EXISTING UNG PRODUCT SA WAREHOUSE, CREATE NEW RECORD

                                   /* $IDtype = "STOCK";
                                    $m = date('m');
                                    $y = date('y');
                                    $d = date('d');

                                    $qry = mysqli_query($link,"SELECT MAX(id) FROM `stocks`"); // Get the latest ID
                                    $resulta = mysqli_fetch_array($qry);
                                    $newID = $resulta['MAX(id)'] + 1; //Get the latest ID then Add 1
                                    $custID = str_pad($newID, 8, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
                                    $custnewID = $IDtype.$custID; //Prepare custom ID
*/
                                    $account = $_SESSION["username"];//session name

                                    $query = "
                                    INSERT INTO `stocks` (product, warehouse, quantity, status, created_by)
                                    VALUES ('$product', '$warehouse', '$qty', 'In Stock','$account')"; //Prepare insert query

                                    $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query


                                    if($result){
                                    $info = $_SESSION['username']." added new stock";
                                    $info2 = "Details: ".$product.", ".$qty."pcs";
                                    $alertlogsuccess = $product.", ".$qty."pcs: has been added succesfully!";
                                    include "logs.php";
                                    echo "<script>window.location.href='stock-manage.php'</script>";

                                    }else{
                                    echo "<script>alert('Failed adding new stocks')</script>";
                                    }
                                    mysqli_close($link);



                }
    } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }


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
              <li class="breadcrumb-item active">Add Product Model</li>
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
                  <h3 class="card-title">Add Product Model</h3>
                  <a href="stock-manage.php">View all product model</a>
                </div>
              </div>

              <div class="card-body">
                <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                      <div class="form-group">
                      <label>Product Model</label>
                      <select class="form-control select2" style="width: 100%;" oninput="upperCase(this)"  data-placeholder="Product Model" name="product" required>
                              <?php
                              // Include config file
                              require_once "config.php";
                              // Attempt select query executions
                              $query = "";
                              $query = "SELECT * FROM `product_model` WHERE type='retail' ORDER BY model_id DESC";
                              if($result = mysqli_query($link, $query)){
                              if(mysqli_num_rows($result) > 0){

                              while($row = mysqli_fetch_array($result)){

                              echo "<option value='".$row['model']."'>" . $row['model'] .  "</option>";
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
                      <label>Warehouse</label>
                      <select class="form-control select2" style="width: 100%;" oninput="upperCase(this)"  data-placeholder="Warehouse" name="warehouse" required>
                              <?php
                              // Include config file
                              require_once "config.php";
                              // Attempt select query executions
                              $query = "";
                              $query = "SELECT * FROM warehouse ORDER BY warehouse_id DESC";
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
                        <label>Quantity</label>
                        <input type="text" class="form-control" placeholder="Quantity" name="qty" oninput="upperCase(this)" required>
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
