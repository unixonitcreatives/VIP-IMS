<?php session_start();
if(empty($_SESSION['auth_username'])) { header("Location: ../index.php");}
require_once ('../connection/connection.php');
include("language.php");
if(isset($_GET['i']) && !empty($_GET['i'])){
	$getorder_id=strip_tags(trim($_GET['i']));
	$sql = "SELECT a.auth_username,a.auth_id,o.*,inv.*,exp_type.*, ipd.* FROM exp_invoice_payment_detail as ipd,
	expense_types as exp_type, expense_orders as o,exp_invoices as inv, auth as a where a.auth_id=ipd.auth_id 
	and a.auth_id=o.auth_id and ipd.auth_id=o.auth_id and ipd.exp_invoice_id=inv.exp_invoice_number 
	and exp_type.expense_type_id=ipd.expense_type_id and o.exp_order_id=ipd.exp_order_id and o.exp_order_id='$getorder_id'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				
				$exp_order_id=$row['exp_order_id'];
				$exp_order_date=$row['exp_order_date'];
				$exp_invoice_number=$row['exp_invoice_number'];
				$expense_type_id=$row['expense_type_id'];
				$exp_invoice_id=$row['exp_invoice_id'];				 
				$exp_invoice_payment_id=$row['exp_invoice_payment_id'];
				$exp_grand_total_price=$row['exp_grand_total_price'];
				$exp_paid_amount=$row['exp_paid_amount'];
				$exp_due_amount=$row['exp_due_amount'];				
				
			}
		}
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
		<title><?php echo $lang['Edit'];?> <?php echo $lang['Invoice'];?></title>

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
						<h4><?php echo $lang['Edit'];?> <?php echo $lang['Invoice'];?></h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="index.php"><?php echo $lang['Dashboard'];?></a></li>							
							<li class="breadcrumb-item active"><?php echo $lang['Edit'];?> <?php echo $lang['Invoice'];?></li>
						</ol>                       
						<div class="box box-block bg-white">
													
				<form class="form-vertical" id="editexpinvoice" name="editexpinvoice" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="panel-body">
                        <div class="row">                        
							<div class="col-sm-8">
                            	 <?php 
								$c = "SELECT * FROM expense_types";
								$resultc = $conn->query($c); ?>
                                <div class="form-group row">
									<label for="expense_type_id" class="col-sm-3 form-control-label"><?php echo $lang['ExpenseType'];?> <i class="text-danger">*</i></label>
									<div class="col-sm-6">
										<select id="expense_type_id" name="expense_type_id" class="form-control" data-plugin="select2" required>
                                        <option value=""><?php echo $lang['SelectExpense'];?></option>
                                        <?php while($rowc = $resultc->fetch_assoc()) { ?>
											<option <?php if($expense_type_id==$rowc['expense_type_id']){echo "selected";}?> value="<?php echo $rowc['expense_type_id'];?>"><?php echo $rowc['expense_type_name'];?></option>
										<?php } ?>	
										</select>
                                        
									</div>
								</div>                                                              
                            </div>
                            
                        </div>
						<div class="form-group row">
                            <label for="datepicker_invoice_exp" class="col-sm-2 col-form-label"><?php echo $lang['Date'];?> <i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" autocomplete="off"  id="datepicker_invoice_exp" value="<?php if(isset($exp_order_date)){ echo $exp_order_date;}?>" name="datepicker_invoice_exp" placeholder="yyyy-mm-dd" required>
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                            </div>
                        </div>             
							<input type="hidden" name="exp_payment_detail_date" value="<?php echo date("Y-m-d");?>" >
                            <input type="hidden" name="exp_invoice_number" value="<?php if(isset($exp_invoice_number)){ echo $exp_invoice_number;}?>" >
                            <input type="hidden" name="exp_order_id" value="<?php if(isset($exp_order_id)){echo $exp_order_id;}?>" >
                            <input type="hidden" name="exp_invoice_payment_id" value="<?php if(isset($exp_invoice_payment_id)){echo $exp_invoice_payment_id;}?>" >
                        <div class="table-responsive" style="margin-top: 10px">
                            <table class="table table-bordered table-hover" id="normalinvoice">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo $lang['ItemInformation'];?> <i class="text-danger">*</i></th>                                        
                                        <th class="text-center"><?php echo $lang['Quantity'];?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo $lang['Rate'];?> <i class="text-danger">*</i></th>                                        
                                        <th class="text-center"><?php echo $lang['Total'];?></th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
								if(isset($exp_invoice_id)){
							$sqlquery = "SELECT * from exp_invoice_line_items where exp_order_id=$getorder_id and exp_invoice_id=$exp_invoice_id";
								$queryresult = $conn->query($sqlquery);
								
								if ($queryresult->num_rows > 0) 
								{	
										$i=1;
									while($productrow = $queryresult->fetch_assoc()) 
									{								
									
									?>
                                    <tr>
                                        <td style="width: 320px">
                                            <input name="product_name[]" class="form-control productSelection" value="<?php echo $productrow['exp_product_name'];?>" placeholder="<?php echo $lang['ItemInformation'];?>" required id="product_name" autocomplete="off" tabindex="1" type="text">
                                        </td>                                        
												<input type="hidden" name="exp_invoice_items_id[]" value="<?php echo $productrow['exp_invoice_items_id'];?>" >
                                                
                                        <td style="width: 320px">
                                            <input name="product_quantity[]" autocomplete="off" value="<?php echo $productrow['exp_product_quantity'];?>" class="total_qty_<?php echo $i;?> form-control" id="total_qty_<?php echo $i;?>" onkeyup="quantity_calculate(<?php echo $i;?>);" required onchange="quantity_calculate(<?php echo $i;?>);" placeholder="0" tabindex="2" type="text">
                                        </td>
                                        <td>
                                            <input name="product_rate[]" autocomplete="off" value="<?php echo $productrow['exp_product_rate'];?>" id="item_price_<?php echo $i;?>" placeholder="0.00" class="item_price_<?php echo $i;?> price_item form-control" tabindex="3" onkeyup="quantity_calculate(<?php echo $i;?>);" required onchange="quantity_calculate(<?php echo $i;?>);" type="text">
                                        </td>
                                       
                                        <td>
                                            <input class="total_price form-control" name="total_price[]" id="total_price_<?php echo $i;?>" placeholder="0.00" value="<?php echo $productrow['exp_total_price'];?>" tabindex="-1" readonly type="text">
                                        </td>
                                        
                                    </tr>
                                    <?php $i++; }
								}
							}?>
                                </tbody>
                                <tfoot>                                   
                                   
                                    <tr>
                                        <td colspan="3" style="text-align:right;"><b><?php echo $lang['GrandTotal'];?>:</b></td>
                                        <td class="text-right">
                                            <input id="grandTotal" class="form-control" name="grand_total_price" value="<?php if(isset($exp_grand_total_price)){ echo $exp_grand_total_price;}?>" tabindex="-1" readonly type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td style="text-align:right;" colspan="3"><b><?php echo $lang['PaidAmount'];?>:</b></td>
                                        <td class="text-right">
                                            <input id="paidAmount" autocomplete="off" class="form-control" name="paid_amount" onkeyup="invoice_paidamount();" readonly value="<?php if(isset($exp_paid_amount)){ echo $exp_paid_amount;}?>" placeholder="0.00" tabindex="6" type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                                                       
                                        <td style="text-align:right;" colspan="3"><b><?php echo $lang['Due'];?>:</b></td>
                                        <td class="text-right">
                                            <input id="dueAmmount" class="form-control"  name="due_amount" value="<?php if(isset($exp_due_amount)){ echo $exp_due_amount;}?>" readonly type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input id="add-invoice" class="btn btn-success" name="add-invoice" value="<?php echo $lang['Submit'];?>" tabindex="8" type="submit">                                            
                                        </td>                                
                                        <td style="text-align:right;" colspan="2"><b><?php echo $lang['AddDueAmount'];?>:</b></td>
                                        <td class="text-right">
                                            <input id="remainingamount" class="form-control" onKeyUp="invoice_update();"   name="remainingamount" placeholder="0.00" type="text">
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
		$('#datepicker_invoice_date').datepicker({
		format: "yyyy-mm-dd",
		autoclose: true,
		todayHighlight: true
		});		
				
	});	
	
</script>
   
<script type="text/javascript">
			jQuery(document).ready(function(){			
			  
			  // edit invoice Form
			  jQuery("#editexpinvoice").validate({
			   				
				rules:
			   {
					product_id: {
					required: true
					}
			   },
				submitHandler: submitForm
			  });			  
			  
			   function submitForm()
				{
					
					NProgress.start();
					var data = $("#editexpinvoice").serialize();			
					$.ajax({
			
						type : 'POST',
						url  : 'modal/edit_expenseinvoiceModel.php',
						data : data,
						dataType : 'json',
						
						beforeSend: function()
						{
							
							$("#error").fadeOut();
							$("#btn-submit").html(' <img src="img/loader1.gif" /> &nbsp; sending ...');
						},
						success :  function (data)
						{					
						
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
									setTimeout('$("#editexpinvoice").fadeOut(500, function(){ window.location = "expense-invoices.php" }); ',1000);
				   
							  }
						   
						}
					});
					return false;
				}
			});
	</script>
</body>
</html>