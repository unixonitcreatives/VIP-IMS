  <?php include "session.php"; ?>
  <?php include "config.php"; ?>

  <?php

  $get_model_id = $_GET['model_id'];

  // Attempt select query execution
  $Getquery = "SELECT * FROM product_model WHERE model_id = '$get_model_id'";
  if($Getresult = mysqli_query($link, $Getquery)){
    if(mysqli_num_rows($Getresult) > 0){
      while($row = mysqli_fetch_array($Getresult)){
        $description = $row['model'];
        $sku = $row['sku'];
        $type = $row['type'];
        $created_by = $row['created_by'];
        $created_at = $row['created_at'];

      }
      // Free result set
      //mysqli_free_result($Getresult);
    }
  } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
  }

  ?>



   <?php //UPDATING PACKAGE

     if($_SERVER['REQUEST_METHOD'] == "POST"){
      //post validation
      $packname = validation($_POST['packName']);
      $sku = validation($_POST['sku']);


      //if empty required fields
      if(empty($packname) || empty($sku)){

        $alertMessage = "<div class='alert alert-danger' role='alert'>
            Please input required fields.
            </div>";
          }else{
        //UPDATE query to product_model table
      $updatePackageQuery = "
      UPDATE `product_model` SET model = '$packname', sku = '$sku' WHERE model_id = '$get_model_id' ";
      $packageResult = mysqli_query($link, $updatePackageQuery) or die(mysqli_error($link));

      //if update executed
      if ($packageResult === TRUE) {

         echo "<script>alert('Package Updated')</script>";

         //logs
            $info = $_SESSION['username']." update package";
            $info2 = "Details: ".$packname.", ".$get_model_id;
            $alertlogsuccess = $packname.": has been updated succesfully!";
            include "logs.php";
            echo "<script>window.location.href='package-manage.php'</script>";
              } else{
                  echo "<script>alert('Error creating logs')</script>";
                }


      }// ./validation

    }// ./post
    else{
            $alertMessage = "<div class='alert alert-danger' role='alert'>
            Error Creating Package.
            </div>";
          }

      

        function validation($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
        // Close connection
        //mysqli_close($link);
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
                  <li class="breadcrumb-item active">View Package</li>
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
                      <h3 class="card-title">Package Info</h3>
                      <a href="package-add.php">+ Add new package</a>
                    </div>
                  </div>


                  <div class="card-body">
                    <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?model_id=<?php echo $get_model_id; ?>">
                    <div class="row">

                      <div class="col-md-6">
                         <div class="form-group">
                        <label>Package Name</label>
                        <input type="text" class="form-control" value="<?php echo $description; ?>" name="packName">
                      </div>

                       <div class="form-group">
                        <label>SKU</label>
                        <input type="text" class="form-control" value="<?php echo $sku; ?>" name="sku" readonly>
                        </div>

                        <label>Type</label>
                        <input type='text' class='form-control' value="<?php echo $type; ?>" disabled>
                      </div>

                      <div class="col-md-6">
                        <label>Date</label>
                        <input type="text" class="form-control" value="<?php echo $created_at; ?>" disabled>
                        <label>Created by</label>
                        <input type="text" class="form-control" value="<?php echo $created_by; ?>" disabled>
                      </div>
                    </div>
                    <br>
                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">No.</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Package Model</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Package Quantity</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">actions</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Attempt select query execution
                        $query = "SELECT * FROM package_list WHERE model_id = '$get_model_id' ORDER BY model_id DESC";
                        if($result = mysqli_query($link, $query)){
                          if(mysqli_num_rows($result) > 0){
                            $ctr = 0;
                            while($row = mysqli_fetch_array($result)){
                              $packlist = $row['pack_list_model']; 
                              $packlistQty = $row['pack_list_qty'];
                              

                              $ctr++;
                              echo "<tr>";
                              echo "<td>" . $ctr . "</td>";
                              echo "<td>" . $packlist . "</td>";
                              echo "<td>" . $packlistQty . "</td>";
                              echo "<td>";


                              echo "<a href='package-list-update.php?pack_list_id=".$row['pack_list_id']."' title='Update Record' data-toggle='modal' data-target='#modal-sm'>Update</a>";
                              echo "</td>";
                              echo "</tr>";
                              
                             
                            }
                            // Free result set
                            mysqli_free_result($result);
                          } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                          }
                        } else{
                          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                        }

                        // Close connection
                       // mysqli_close($link);
                        ?>
                      </tbody>
                    </table>
                  </div>

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();" >Save</button>
                    </form>
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

    <?php include "includes/js.php"; ?>


    <div class="modal fade" id="modal-sm" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Small Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form  method="POST" action="package-list-update.php" id="mForm">
                <?php
                //$pack_id = $_GET['pack_list_id'];
                 $q = "SELECT * FROM package_list WHERE model_id='$get_model_id'";
                 $r = mysqli_query($link,$q); 

                while($row = mysqli_fetch_assoc($r)){
                  $model = $row['pack_list_model'];
                  $qty = $row['pack_list_qty'];
                
                }
                ?>
                  <div class="form-group">
                          <label>Model<span style="color: Red;">*</span></label>
                          <input type="text" class="form-control" placeholder="Package Name" name="package_name" oninput="upperCase(this)" maxlength="20" value="<?php echo $model; ?>" id='model'><br>
                        </div>

                        <div class="form-group">
                          <label>Quantity<span style="color: Red;">*</span></label>
                          <input type="number" class="form-control" placeholder="Qunatity" name="quantity" value="<?php echo $qty; ?>" id='qty'>
                        </div>

                  <input type="number" name="model_id" id='id' value="<?php echo $pack_id; ?>">      

            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id='action' name='action'>Save changes</button>
            </div>
          </div>

              </form>
            </div>
            
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <script>
      $('#action').click(function(){
        var form = $('#mForm');
        //var formData = $(form).serialize();
        var model = $('#model').val();
        var qty = $('#qty').val();
        var pack_id = $('#id').val();
        

        $.ajax({
          url: $(form).attr('action'),
          method: 'POST',
          data:{model:model,qty:qty,pack_id:pack_id},
          success:function(data){
            $('#modal-sm').modal('hide');
            location.reload();

          }
        })
      });     
        
      </script>

  </body>
  </html>
