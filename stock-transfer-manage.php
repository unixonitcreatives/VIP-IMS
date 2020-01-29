<?php include "session.php"; ?>

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
              <li class="breadcrumb-item active">Manage Stocks Transfers</li>
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
                  <h3 class="card-title"><strong><b>Notice:</b></strong> This page is under development and its not yet working properly. "Stock Transfer"</h3>
                  <a href="stock-transfer.php">add new stock transfer</a>
                  
                </div>
              </div>

              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">No.</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Reference No.</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Warehouse Origin</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Warehouse Destination</th>
                          <th>Action</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <!-- QUERY HERE -->
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="5" align="center"><strong><b>Notice:</b></strong> This page is under development and its not yet working properly. "Stock Transfer"</td>
                        </tr>
                      </tfoot>
                    </table>



              </div>

              <div class="card-footer">

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

 <?php include "includes/js.php"; ?>

</body>
</html>
