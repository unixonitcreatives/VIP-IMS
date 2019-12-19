<?php session_start();
if(empty($_SESSION['auth_username'])) { header("Location: ../index.php");}
require_once ('../connection/connection.php');
include("language.php");
if(isset($_GET['i']) && !empty($_GET['i']) && isset($_GET['o']) && !empty($_GET['o'])){
	$order_id=strip_tags(trim($_GET['o']));
	$invoice_no_id=strip_tags(trim($_GET['i']));
	$del = "DELETE FROM exp_invoices WHERE exp_invoice_number='$invoice_no_id'";
	if ($conn->query($del) === TRUE) {
		$orderd = $conn->query("DELETE FROM expense_orders WHERE exp_order_id='$order_id'");
		$ipdd = $conn->query("DELETE FROM exp_invoice_payment_detail WHERE exp_order_id='$order_id'");
		$ilid = $conn->query("DELETE FROM exp_invoice_line_items WHERE exp_order_id='$order_id' ");
		
		header("location: expense-invoices.php?d=del");		
	} else {
		header("location: expense-invoices.php?d=n");		
	}
}
if(isset($_POST['exp_status']) && !empty($_POST['exp_status']) ){
	$exp_statuss=strip_tags(trim($_POST['exp_status']));
	$exp_invoice_payment_ids=strip_tags(trim($_POST['exp_invoice_payment_ids']));
	$sql = "UPDATE exp_invoice_payment_detail SET exp_status='$exp_statuss' where exp_invoice_payment_id='$exp_invoice_payment_ids'";
	$conn->query($sql);	
		
		header("location: expense-invoices.php?s=j");		
	} 



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
		<title><?php echo $lang['Invoice'];?></title>

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
						<h4><?php echo $lang['ExpenseInvoicesList'];?></h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="index.php"><?php echo $lang['Dashboard'];?></a></li>							
							<li class="breadcrumb-item active"><?php echo $lang['ExpenseInvoicesList'];?></li>
						</ol>
						<div class="box box-block bg-white">
							<h5 class="mb-1"><?php echo $lang['ExportingExpenseInvoicesData'];?>                            
                            </h5>
							<table class="table table-striped table-bordered dataTable" id="table-2">
								<thead>
									<tr>
										<th>No</th>
										<th><?php echo $lang['Invoiceno'];?></th>
                                        <th><?php echo $lang['Createdby'];?>, <?php echo $lang['Name'];?></th>
										<th><?php echo $lang['Date'];?></th>
										<th><?php echo $lang['TotalAmount'];?></th>
                                        <th><?php echo $lang['PaidAmount'];?></th>
                                        <th><?php echo $lang['UnpaidAmount'];?></th>
										<th><?php echo $lang['Option'];?></th>
                                        <?php if(!empty($_SESSION['user_type_id']) && $_SESSION['user_type_id']=='1') { ?>
                                        <th><?php echo $lang['Status'];?></th>
                                        <?php } ?>
									</tr>
								</thead>
								<tbody>
                                <?php 
								$sql = "SELECT a.*, inv.* FROM exp_invoice_payment_detail as inv, auth as a where a.auth_id=inv.auth_id";
								$result = $conn->query($sql);
								
								if ($result->num_rows > 0) 
								{
									// output data of each row
									$i=1;
									while($row = $result->fetch_assoc()) 
									{ ?>		
									<tr>
										<td><?php echo $i;?></td>
										<td><?php echo $row['exp_invoice_id'];?></td>
                                        <td><?php echo $row['full_name'];?></td>
										<td><?php echo $row['exp_payment_detail_date'];?></td>
										<td><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php echo $row['exp_grand_total_price'];?></td>
                                        <td><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php echo $row['exp_paid_amount'];?></td>
                                        <td><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php echo $row['exp_due_amount'];?></td>
										<td>
                                        <?php if(!empty($_SESSION['user_type_id']) && $_SESSION['user_type_id']!='1') { ?> 
											<?php if( $row['exp_status']==0){?>
                                             <a class="btn btn-secondary btn-sm" href="#" title="In Process">In Process</a> 
                                            <?php } ?>
                                             <?php if( $row['exp_status']==1){?>
                                             <a class="btn btn-success btn-sm" href="#" title="Accepted">Accepted</a> 
                                            <?php } ?>
                                            <?php if( $row['exp_status']==2){?>
                                             <a class="btn btn-danger btn-sm" href="#" title="Rejected">Rejected</a> 
                                            <?php } ?>
                                       <?php } ?>
										<?php if(!empty($_SESSION['user_type_id']) && $_SESSION['user_type_id']=='1') { ?> 
                                        <a class="btn btn-success btn-sm" href="expense-invoice.php?i=<?php echo $row['exp_order_id'];?>" title="View"><i class="ti-eye mr-0-5"></i><?php echo $lang['View'];?></a> 
                                        <a class="btn btn-secondary btn-sm" href="edit-expense.php?i=<?php echo $row['exp_order_id'];?>" title="Edit"><i class="ti-pencil mr-0-5"></i><?php echo $lang['Edit'];?></a> 
                                        <a class="btn btn-danger btn-sm" href="expense-invoices.php?i=<?php echo $row['exp_invoice_id'];?>&o=<?php echo $row['exp_order_id'];?>" title="Delete"><i class="ti-trash mr-0-5"></i><?php echo $lang['Delete'];?></a>
                                        <?php } ?>
                                        </td>
                                        <?php if(!empty($_SESSION['user_type_id']) && $_SESSION['user_type_id']=='1') { ?> 
                                        <td>
                                        <form action="" method="post" enctype="multipart/form-data">
                                        <select id="exp_status" name="exp_status" data-plugin="select2" onchange="this.form.submit()">
                                        <option value=""><?php echo $lang['Select'];?> </option>
                                        	<option value="0" <?php if($row['exp_status']==0){ echo "selected";}?> ><?php echo $lang['InProcess'];?></option>                                        
											<option value="1" <?php if($row['exp_status']==1){ echo "selected";}?> ><?php echo $lang['Accepted'];?></option>
                                            <option value="2" <?php if($row['exp_status']==2){ echo "selected";}?> ><?php echo $lang['Rejected'];?></option>											
										</select>
                                        <input type="hidden" name="exp_invoice_payment_ids" value="<?php echo $row['exp_invoice_payment_id'];?>" >
                                        </form>                                        
                                        </td>
                                         <?php } ?>
									</tr>
                                  <?php $i++;
								      }
								} ?>																	
								</tbody>
								<tfoot>
									<tr>
										<th>No</th>
										<th><?php echo $lang['Invoiceno'];?></th>
                                        <th><?php echo $lang['Createdby'];?>, <?php echo $lang['Name'];?></th>
										<th><?php echo $lang['Date'];?></th>
										<th><?php echo $lang['TotalAmount'];?></th>
                                        <th><?php echo $lang['PaidAmount'];?></th>
                                        <th><?php echo $lang['UnpaidAmount'];?></th>
										<th><?php echo $lang['Option'];?></th>
                                        <?php if(!empty($_SESSION['user_type_id']) && $_SESSION['user_type_id']=='1') { ?>
                                        <th><?php echo $lang['Status'];?></th>
                                        <?php } ?>
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
		<!-- Neptune JS -->
		<script type="text/javascript" src="js/app.js"></script>
		<script type="text/javascript" src="js/demo.js"></script>
		<script type="text/javascript" src="js/tables-datatable.js"></script>
        <?php if(isset($_GET['d']) && $_GET['d']=='del'){ ?>
        <script type="text/javascript">
			$(document).ready(function(){			
			toastr.options = {
			positionClass: 'toast-top-right'
			};
			toastr.error('Record deleted successfully!');
			
			});	
		</script>
      <?php } 
	  if(isset($_GET['d']) && $_GET['d']=='n'){ ?>
        <script type="text/javascript">
			$(document).ready(function(){			
			toastr.options = {
			positionClass: 'toast-top-right'
			};
			toastr.error('Error deleting record!');
			
			});	
		</script>
        <?php } 
		 if(isset($_GET['s']) && $_GET['s']=='j'){ ?>
        <script type="text/javascript">
			$(document).ready(function(){			
			toastr.options = {
			positionClass: 'toast-top-right'
			};
			toastr.success('Record updated successfully!');
			
			});	
		</script>
        <?php } ?>
	</body>

</html>