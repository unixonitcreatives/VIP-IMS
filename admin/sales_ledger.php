<?php session_start();
if(empty($_SESSION['auth_username'])) { header("Location: ../index.php");}
require_once ('../connection/connection.php');
include("language.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<!-- Meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Title -->
		<title><?php echo $lang['SalesLedger'];?></title>

		<!-- adaptinventory CSS -->
		<link rel="stylesheet" href="../adaptinventory/bootstrap4/css/bootstrap.min.css">
		<link rel="stylesheet" href="../adaptinventory/themify-icons/themify-icons.css">
		<link rel="stylesheet" href="../adaptinventory/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../adaptinventory/animate.css/animate.min.css">
		<link rel="stylesheet" href="../adaptinventory/jscrollpane/jquery.jscrollpane.css">
		<link rel="stylesheet" href="../adaptinventory/waves/waves.min.css">
		<link rel="stylesheet" href="../adaptinventory/switchery/dist/switchery.min.css">
		<link rel="stylesheet" href="../adaptinventory/DataTables/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="../adaptinventory/DataTables/Responsive/css/responsive.bootstrap4.min.css">
		<link rel="stylesheet" href="../adaptinventory/DataTables/Buttons/css/buttons.dataTables.min.css">
		<link rel="stylesheet" href="../adaptinventory/DataTables/Buttons/css/buttons.bootstrap4.min.css">
        <link rel="stylesheet" href="../adaptinventory/toastr/toastr.min.css">
        <link rel="stylesheet" href="../adaptinventory/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
		<link rel="stylesheet" href="../adaptinventory/clockpicker/dist/bootstrap-clockpicker.min.css">
		<link rel="stylesheet" href="../adaptinventory/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
		<link rel="stylesheet" href="../adaptinventory/bootstrap-daterangepicker/daterangepicker.css">

		<!-- Neptune CSS -->
		<link rel="stylesheet" href="css/core.css">

		<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="fixed-sidebar fixed-header skin-3 content-appear">
		<div class="wrapper">

			<!-- Preloader -->
			<div class="preloader"></div>

			<!-- Sidebar -->
			<div class="site-overlay"></div>
			
			<?php include("sidebar.php");?>
			<!-- Sidebar second -->
			<?php include("rightsidebar.php");?>

			<!-- Template options -->
			<?php include("template-options-menu.php");?>

			<!-- Header -->
			<?php include("headermenu.php");?>

			<div class="site-content">
				<!-- Content -->
				<div class="content-area py-1">
					<div class="container-fluid">
						<h4><?php echo $lang['SalesLedger'];?></h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="index.php"><?php echo $lang['Dashboard'];?></a></li>							
							<li class="breadcrumb-item active"><?php echo $lang['SalesLedger'];?></li>
						</ol>
						<div class="box box-block bg-white">
							<h5 class="mb-1"><?php echo $lang['SalesLedgerData'];?></h5>
                            <h6> <?php echo $lang['DateRange'];?></h6>
                            <form action="" name="form" method="post" >
                            <div class="row">
								<div class="offset-md-1 col-md-8">                          
                                  <div class="input-daterange input-group" id="date-range">
                                    <input type="text" class="form-control" name="start" value="<?php if((isset($_POST['start']))) { echo $_POST['start']; }?>" >
                                    <span class="input-group-addon bg-primary b-0 text-white">to</span>
                                    <input type="text" class="form-control" name="end" value="<?php if((isset($_POST['end']))) { echo $_POST['end']; }?>" >                                    
                                   </div>                                    
                               </div>
                               <div class="col-md-3">
									<button type="submit" class="btn btn-primary">GET</button>
								</div>
                            </div>
                            </form>
                            <?php if((!isset($_POST['start']))) { ?>
                            <p class="font-90 text-muted mb-1"><?php echo $lang['Last365Days'];?></p>
                            <?php } else { ?><p class="font-90 text-muted mb-1">&nbsp;  </p>  <?php } ?>
							<table class="table table-bordered dataTable" id="s_i_l">
								<thead>
									<tr>
										<th>No</th>
										<th><?php echo $lang['Invoiceno'];?></th>
                                        <th><?php echo $lang['Customername'];?></th>
										<th><?php echo $lang['Date'];?></th>
										<th><?php echo $lang['TotalAmount'];?></th>
                                        <th><?php echo $lang['PaidAmount'];?></th>
                                        <th><?php echo $lang['RemaingAmount'];?></th>										
									</tr>
								</thead>
								<tbody>
                              <?php 
							  if((isset($_POST['start'])) && (!empty($_POST['start'])) && (isset($_POST['end'])) && (!empty($_POST['end'])))
							  {
								$sql = "SELECT c.*, inv.* FROM invoice_payment_detail as inv, customers as c where inv.payment_detail_date >='".$_POST['start']."' and inv.payment_detail_date <='".$_POST['end']."' and c.cus_id=inv.customer_id order by inv.payment_detail_date ASC";
							  }else{
							   $newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " - 1 year"));
								$sql = "SELECT c.*, inv.* FROM invoice_payment_detail as inv, customers as c where inv.payment_detail_date <='".date("Y-m-d")."' and inv.payment_detail_date >='$newEndingDate' and c.cus_id=inv.customer_id order by inv.payment_detail_date ASC";
							  }
								$result = $conn->query($sql);
								
								if ($result->num_rows > 0) 
								{
									// output data of each row
									$i=1;
									$gtp=0;
									$pa=0;
									$da=0;
									while($row = $result->fetch_assoc()) 
									{ ?>		
									<tr>
										<td><?php echo $i;?></td>
										<td><?php echo $row['invoice_no_id'];?></td>
                                        <td><?php echo $row['cus_name'];?></td>
										<td><?php echo $row['payment_detail_date'];?></td>
										<td><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php echo $row['grand_total_price'];?></td>
                                        <td><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php echo $row['paid_amount'];?></td>
										<td><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php echo $row['due_amount'];?></td>										
									</tr>
                                  <?php $i++;
								  		$gtp=$gtp+$row['grand_total_price'];
										$pa=$pa+$row['paid_amount'];
										$da=$da+$row['due_amount'];
								      }
								} ?>                                																		
								</tbody>
								<tfoot>
									<tr>
										<th colspan="3"></th>
                                        <th><?php echo $lang['Total'];?></th>										
										<th><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php if(!empty($gtp)){ echo $gtp;}?></th>
                                        <th><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php if(!empty($pa)){ echo $pa;}?></th>
                                        <th><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php if(!empty($da)){ echo $da;}?></th>										
									</tr>                            
								</tfoot>
							</table>                              
                            
						</div>			
						
					</div>
				</div>
				<!-- Footer -->
				<?php include("footermenu.php");?>
			</div>

		</div>

		<!-- adaptinventory JS -->
		<script type="text/javascript" src="../adaptinventory/jquery/jquery-1.12.3.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/tether/js/tether.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/bootstrap4/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/detectmobilebrowser/detectmobilebrowser.js"></script>
		<script type="text/javascript" src="../adaptinventory/jscrollpane/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="../adaptinventory/jscrollpane/mwheelIntent.js"></script>
		<script type="text/javascript" src="../adaptinventory/jscrollpane/jquery.jscrollpane.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/jquery-fullscreen-plugin/jquery.fullscreen-min.js"></script>
		<script type="text/javascript" src="../adaptinventory/waves/waves.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/switchery/dist/switchery.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/js/dataTables.bootstrap4.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/Responsive/js/dataTables.responsive.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/Responsive/js/responsive.bootstrap4.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/Buttons/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/Buttons/js/buttons.bootstrap4.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/JSZip/jszip.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/pdfmake/build/pdfmake.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/pdfmake/build/vfs_fonts.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/Buttons/js/buttons.html5.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/Buttons/js/buttons.print.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/Buttons/js/buttons.colVis.min.js"></script>
        <script type="text/javascript" src="../adaptinventory/toastr/toastr.min.js"></script>	
        <script type="text/javascript" src="../adaptinventory/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script type="text/javascript" src="../adaptinventory/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/clockpicker/dist/jquery-clockpicker.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>	
		<!-- Neptune JS -->
		<script type="text/javascript" src="js/app.js"></script>
		<script type="text/javascript" src="js/demo.js"></script>
		<script type="text/javascript" src="js/tables-datatable.js"></script>
        <script type="text/javascript">
		$(document).ready(function(){
		$('#date-range').datepicker({
		 format: "yyyy-mm-dd",
		toggleActive: true
		});
		});
	</script>        
	</body>

</html>