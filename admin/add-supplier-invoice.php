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
		<title><?php echo $lang['SuppliersInvoice'];?></title>

		<!-- adaptinventory CSS -->
		<link rel="stylesheet" href="../adaptinventory/bootstrap4/css/bootstrap.min.css">
		<link rel="stylesheet" href="../adaptinventory/themify-icons/themify-icons.css">
		<link rel="stylesheet" href="../adaptinventory/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../adaptinventory/animate.css/animate.min.css">
		<link rel="stylesheet" href="../adaptinventory/jscrollpane/jquery.jscrollpane.css">
		<link rel="stylesheet" href="../adaptinventory/waves/waves.min.css">
		<link rel="stylesheet" href="../adaptinventory/switchery/dist/switchery.min.css">
		<link rel="stylesheet" href="../adaptinventory/nprogress/nprogress.css">
        <link rel="stylesheet" href="../adaptinventory/toastr/toastr.min.css">
        <link rel="stylesheet" href="../adaptinventory/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
        <link rel="stylesheet" href="../adaptinventory/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
		<link rel="stylesheet" href="../adaptinventory/bootstrap-daterangepicker/daterangepicker.css">
        <link rel="stylesheet" href="css/jquery-ui.css">
        
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
						<h4><?php echo $lang['SuppliersInvoice'];?></h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="index.php"><?php echo $lang['Dashboard'];?></a></li>							
							<li class="breadcrumb-item active"><?php echo $lang['SuppliersInvoice'];?></li>
						</ol>                       
						<div class="box box-block bg-white">
													
				<form class="form-vertical" id="addexpinvoice" name="addexpinvoice" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="panel-body">
                        <div class="row">                        
							<div class="col-md-6">
                            	 <?php 
									$s = "SELECT * FROM suppliers";
									$results = $conn->query($s); ?>
                                <div class="form-group row">
									<label for="expense_type_id" class="col-sm-3 form-control-label"><?php echo $lang['SelectSupplier'];?> <i class="text-danger">*</i></label>
									<div class="col-sm-8">
										<select id="supplier_id" name="supplier_id" class="form-control" data-plugin="select2" required>
                                        <option value=""><?php echo $lang['SelectSupplier'];?></option>
                                        <?php while($rows = $results->fetch_assoc()) { ?>
											<option value="<?php echo $rows['supplier_id'];?>"><?php echo $rows['supplier_name'];?></option>
										<?php } ?>	
										</select>    
                                        <input id="auth_id"  type="hidden" name="auth_id" value="<?php echo $_SESSION['auth_id'];?>">                                    
									</div>
								</div>                                                                
                            
                        <?php 
								$w = "SELECT * FROM warehouse";
								$resultw = $conn->query($w); ?>
                                <div class="form-group row">
									<label for="warehouse_id" class="col-sm-3 form-control-label"><?php echo $lang['Warehouse'];?> </label>
									<div class="col-sm-8">
										<select id="warehouse_id" name="warehouse_id"  class="form-control" data-plugin="select2">
                                        	<option value=""><?php echo $lang['SelectWarehouse'];?></option>
											<?php while($roww = $resultw->fetch_assoc()) { ?>
											<option value="<?php echo $roww['war_id'];?>"><?php echo $roww['war_name'];?></option>
										<?php } ?>
										</select>
									</div>
								</div> 
						<div class="form-group row">
                            <label for="datepicker_invoice_exp" class="col-sm-3 col-form-label"><?php echo $lang['Date'];?> <i class="text-danger">*</i></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" autocomplete="off"  id="datepicker_invoice_exp" name="datepicker_invoice_exp" placeholder="yyyy-mm-dd" required>
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">                                 
                                    <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Image'];?></label>
                                            <div class="col-sm-10">
                                             <input name="userfile" id="userfile" type="file">                                             
                                          </div>
                                    </div>                               
                                                                       
                                </div>             
					 </div>
                        <div class="table-responsive" style="margin-top: 10px">
                            <table class="table table-bordered table-hover" id="normalinvoice">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo $lang['ItemInformation'];?> <i class="text-danger">*</i></th>                                        
                                        <th class="text-center"><?php echo $lang['Quantity'];?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo $lang['Rate'];?> <i class="text-danger">*</i></th>                                        
                                        <th class="text-center"><?php echo $lang['Total'];?></th>
                                        <th class="text-center"><?php echo $lang['Action'];?></th>
                                    </tr>
                                </thead>
                                <tbody id="add_row_to_invoice">
                                    <tr>
                                        <td style="width: 320px">
                                            <input name="product_name[]" class="form-control productSelection" placeholder="Item Name" required id="product_name" autocomplete="off" tabindex="1" type="text">
                                           
                                        </td>                                        
                                        <td style="width: 320px">
                                            <input name="product_quantity[]" autocomplete="off" class="total_qty_1 form-control" id="total_qty_1" onkeyup="quantity_calculate(1);" required onchange="quantity_calculate(1);" placeholder="0" tabindex="2" type="text">
                                        </td>
                                        <td >
                                            <input name="product_rate[]" autocomplete="off" value="" id="item_price_1" placeholder="0.00" class="item_price_1 price_item form-control" tabindex="3" onkeyup="quantity_calculate(1);" required onchange="quantity_calculate(1);" type="text">
                                        </td>
                                       
                                        <td >
                                            <input class="total_price form-control" name="total_price[]" id="total_price_1" placeholder="0.00" value="" tabindex="-1" readonly type="text">
                                        </td>

                                        <td >                                            
                                            <button style="text-align: right;" class="btn btn-danger" type="button" onclick="deleteRow(this)" value="Delete" tabindex="4"><?php echo $lang['Delete'];?></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>                                   
                                    
                                    <tr>
                                        <td colspan="3" style="text-align:right;"><b><?php echo $lang['GrandTotal'];?>:</b></td>
                                        <td class="text-right">
                                            <input id="grandTotal" class="form-control" name="grand_total_price" value="0.00" tabindex="-1" readonly type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input id="add-invoice-item" class="btn btn-info" name="add-invoice-item" onClick="add_row('add_row_to_invoice');" value="<?php echo $lang['AddNewItem'];?>" tabindex="5" type="button">
                                        </td>
                                        <td style="text-align:right;" colspan="2"><b><?php echo $lang['PaidAmount'];?>:</b></td>
                                        <td class="text-right">
                                            <input id="paidAmount" autocomplete="off" class="form-control" name="paid_amount" onkeyup="invoice_paidamount();" value="" placeholder="0.00" tabindex="6" type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input id="add-invoice" class="btn btn-success" name="add-invoice"  value="<?php echo $lang['Submit'];?>" tabindex="8" type="submit">
                                            <input id="full_paid_tab" class="btn btn-warning" name="" onclick="full_paid();" value="<?php echo $lang['FullPaid'];?>" tabindex="7" type="button">
                                        </td>                                
                                        <td style="text-align:right;" colspan="2"><b><?php echo $lang['Due'];?>:</b></td>
                                        <td class="text-right">
                                            <input id="dueAmmount" class="form-control"  name="due_amount" value="0.00" readonly type="text">
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>                            
                        </div>
                    </div>
                    </form>							
						</div>			
						
					</div>
				</div>
				<!-- Footer -->
				<?php include("footermenu.php");?>
			</div>

		</div>

		<!-- adaptinventory JS -->
		<script type="text/javascript" src="../adaptinventory/jquery/jquery-1.12.3.min.js"></script>
        <script src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="../adaptinventory/tether/js/tether.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/bootstrap4/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/detectmobilebrowser/detectmobilebrowser.js"></script>
		<script type="text/javascript" src="../adaptinventory/jscrollpane/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="../adaptinventory/jscrollpane/mwheelIntent.js"></script>
		<script type="text/javascript" src="../adaptinventory/jscrollpane/jquery.jscrollpane.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/jquery-fullscreen-plugin/jquery.fullscreen-min.js"></script>
		<script type="text/javascript" src="../adaptinventory/waves/waves.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/switchery/dist/switchery.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/toastr/toastr.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/nprogress/nprogress.js"></script>
        <script type="text/javascript" src="../adaptinventory/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/clockpicker/dist/jquery-clockpicker.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
		<!-- Neptune JS -->
		<script type="text/javascript" src="js/app.js"></script>
		<script type="text/javascript" src="js/demo.js"></script>
		<script type="text/javascript" src="js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="js/ui-notifications.js"></script>        
        <script src="js/expense_invoice.js"></script>      
        <script>
		
	$(document).ready(function(){
		$('#datepicker_invoice_exp').datepicker({
		format: "yyyy-mm-dd",
		autoclose: true,
		todayHighlight: true
		});		
				
	});	
	
</script>

      
  <script type="text/javascript">
			jQuery(document).ready(function(){				
			  
			  // add invoice Form
			  jQuery("#addexpinvoice").validate({
			   				
				rules:
			   {
					product_name: {
					required: true
					}
			   }
				
			  });			  
			  
			   $('#addexpinvoice').on('submit', function(e) {				
        NProgress.start();
		e.preventDefault();   
		$.ajax({
					
					
			
						
						url  : 'modal/add_supinvoiceModel.php',
						type: "POST",
				   data:  new FormData(this),
				   contentType: false,
						 cache: false,
				   processData:false,						
						
						success :  function (data)
						{					
						//alert(data.status);
							if(data.status==='error'){
			
								$("#error").fadeIn(1000, function(){
									$("#error").html('<div class="alert alert-danger"> &nbsp; Sorry try again!</div>');
			
									$("#btn-submit").html(' &nbsp; Try Again');
								});
							}
							else if(data.status==='successfully')
							{
								
									$("#btn-submit").html('Submit');									
									toastr.options = {
									positionClass: 'toast-top-right'
									};
									toastr.success('Success!');
									NProgress.done();
									$("#addexpinvoice").trigger('reset');
				   
							  }
						   
						}
					});
					
				});
			});
</script>
	</body>

</html>