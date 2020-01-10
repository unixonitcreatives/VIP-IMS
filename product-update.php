<?php
include "session.php";
require_once "config.php";

$account = $_SESSION["username"];?>

<?php

$id = $_GET['id'];
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //Assigning posted values to variables.
    $description = test_input($_POST['description']);
    $sku = test_input($_POST['sku']);



    $query = "UPDATE product_model SET description='$description', sku='$sku' WHERE id='$id'";
    $result = mysqli_query($link,$query);

    if($result){
      echo "<script>
      alert('product updated');
      window.location.href='product-manage.php';
      </script>";
      exit;
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
                  <h3 class="card-title">Update Product Model</h3>
                  <a href="product-manage.php">View all product model</a>
                </div>
              </div>

              <div class="card-body">
                <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $id; ?>">
                  <?php
                  $q = "SELECT description,sku FROM product_model WHERE id='$id'";
                  $r = mysqli_query($link,$q);
                  while($row = mysqli_fetch_assoc($r)){
                    $desc = $row['description'];
                    $sk = $row['sku'];
                  ?>
                      <div class="form-group">
                        <label>Product Description</label>
                        <input type="text" class="form-control" placeholder="Product Description" name="description" oninput="upperCase(this)" maxlength="20" value="<?php echo $desc; ?>">
                      </div>

                      <div class="form-group">
                        <label>Product SKU</label>
                        <input type="text" class="form-control" placeholder="SKU" name="sku" oninput="upperCase(this)" value="<?php echo $sk; ?>">
                      </div>
                    <?php } ?>  
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
