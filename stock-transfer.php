<?php
require_once 'config.php';
include('session.php');
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

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">Stock Transfer</h3>
                  
                  </div>
                </div>

                <div class="card-body">
                  <?php echo $alertMessage; ?>
                  <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="row">
                      <div class="col-md-6">
                        

                        <div class="form-group">
                          <label>Warehouse Origin</label>
                          <select class="form-control select2" oninput="upperCase(this)"  name="invWarehouse" required>
                            <option value="">SELECT WAREHOUSE ORIGIN</option>
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
                          <select class="form-control select2" oninput="upperCase(this)"  name="invWarehouse" required>
                            <option value="">SELECT WAREHOUSE DESTINATION</option>
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
                            <input type="date" name="invDate" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" placeholder="mm/dd/yyyy" data-mask im-insert="false" required>
                          </div>
                          <!-- /.input group -->
                        </div>

                        <div class="form-group">
                          <label>Reference No.</label>
                          <input type="text" class="form-control" placeholder="Reference No." name="" id="" required>

                        </div>

                       

                      
                      </div>
                    </div>


                    <table class="table" role="grid" aria-describedby="example2_info" id="invTable">
                      <thead>
                        <tr>
                          <th width="50%">Product/s</th>
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
                          <select class="form-control select2" style="width: 100%;" name="invProduct[]" id="prod-mod<?php echo $x; ?>" onchange="get-prod-model-data(<?php echo $x;?>)">
                            <option value="">~~Select Product~~</option>
                            <?php
                            // Include config file
                            require_once "config.php";
                            // Attempt select query executions
                            $query = "";
                            $query = "SELECT model FROM product_model WHERE type = 'retail' ORDER BY model_id DESC";
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
                          <input type="number" class="form-control" placeholder="Quantity" name="invQty[]" id="moddQty<?php echo $x; ?>" required>
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
              <textarea class="form-control" width="100%" rows="5" style="resize: none;" placeholder="" name="invRemarks"></textarea>

              <br>
            </div>

          </div>

          <div class="card-footer">
            <button type="submit" name="transfer" class="btn btn-primary">Transfer</button>
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