<?php
require_once 'config.php';
$alertMessage=$invRemarks=$account="";

include('session.php');


if(isset($_POST['fullypaid'])){
  $invCustName  = valData($_POST['invCustName']);
  $invDate      = valData($_POST['invDate']);
  $invRemarks   = valData($_POST['invRemarks']);

  $account = $_SESSION['username'];


  if(empty($invCustName) || empty($invDate)){
    $alertMessage = "<div class='alert alert-danger' role='alert'>
    Please input required fields.
    </div>";
  }else{

    //Prepare Date for custom ID
    $IDtype = "OBTX";
    $m = date('m');
    $y = date('y');
    $d = date('d');

    $qry = mysqli_query($link,"SELECT MAX(id) FROM `outboundtb` "); // Get the latest ID
    $resulta = mysqli_fetch_array($qry);
    $newID = $resulta['MAX(id)'] + 1; //Get the latest ID then Add 1
    $custID = str_pad($newID, 8, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
    $obtxid = $IDtype.$custID; //Prepare custom ID


    //insert query to outboundTB table
    $obQuery = "INSERT INTO outboundtb (ob_tx_id, ob_custName, ob_date, ob_remarks, ob_status, ob_created_by)
    VALUES ('$obtxid','$invCustName', '$invDate', '$invRemarks', 'Fully Paid', '$account')";
    $obResult = mysqli_query($link, $obQuery) or die(mysqli_error($link));


    if ($obResult === TRUE) {

      $j = 0;

      //Counts the elements in array
      $count = count($_POST['invProduct']);

      // Use insert_id property to get the id of previous table (packages table)
      $obID = $link->insert_id;

      for ($j = 0; $j < $count; $j++) {

        $listquery = "INSERT INTO obdatatb (outbound_ID, ob_tx_id, obdata_products, obdata_qty) VALUES (
          '".$obID."',
          '".$obtxid."',
          '".$_POST['invProduct'][$j]."',
          '".$_POST['invQty'][$j]."')";

          $listresult = mysqli_multi_query($link, $listquery) or die(mysqli_error($link));

        }

        if($listresult === TRUE){


          $query = "SELECT obdata_products, obdata_qty FROM obdatatb WHERE ob_tx_id = '".$obtxid."'";

          if($result = mysqli_query($link, $query)){
            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_array($result)){
                $order_product_model = $order_qty = "";
                
                $order_product_model = $row['obdata_products'];
                $order_qty  = $row['obdata_qty'];
                
                include('pm-checker.php');

              }
              // Free result set
              //mysqli_free_result($result);
            } else{
              echo "<p class='lead'><em>No records were found.</em></p>";
            }
          } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
          }
          

          $alertMessage = "<div class='alert alert-success' role='alert'>
          Outbound Products Successfully Created.
          </div>";

        }else{
          $alertMessage = "<div class='alert alert-danger' role='alert'>
          Error Creating Outbound Products.
          </div>";}
          //INSERT query to so_transactions table end

        }
      }// ./validation

    }// ./post data



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
                            <h3 class="card-title">Add Invoice</h3>
                            <a href="invoice-manage.php">View all invoice</a>
                          </div>
                        </div>

                        <div class="card-body">
                          <?php echo $alertMessage; ?>
                          <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="row">
                              <div class="col-md-6">
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
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Date:</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="date" name="invDate" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" placeholder="mm/dd/yyyy" data-mask im-insert="false">
                                  </div>
                                  <!-- /.input group -->
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




              <table class="table table-bordered table-hover" role="grid" aria-describedby="example2_info" id="invTable">
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
                          <input type="text" class="form-control" placeholder="Quantity" name="invQty[]" id="moddQty<?$php echo $x; ?>" required>
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
              <!--<input type="text" class="form-control">-->
              <br>

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
