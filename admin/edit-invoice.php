<?php session_start();
if(empty($_SESSION['auth_username'])) { header("Location: ../index.php");}
require_once ('../connection/connection.php');
include("language.php");
if(isset($_GET['i']) && !empty($_GET['i'])){
	$getorder_id=strip_tags(trim($_GET['i']));
	$sql = "SELECT c.*,o.*,inv.*, ipd.* FROM invoice_payment_detail as ipd, orders as o,invoices as inv, customers as c where c.cus_id=ipd.customer_id
	and c.cus_id=o.customer_id and ipd.customer_id=o.customer_id and ipd.invoice_no_id=inv.invoice_number and o.order_id=ipd.order_id and o.order_id='$getorder_id'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				//$customer_id=$row['customer_id'];
				$cus_name=$row['cus_name'];
				$cus_mobile=$row['cus_mobile'];
				$cus_address=$row['cus_address'];
				$date_order_placed=$row['date_order_placed'];
				$invoice_number=$row['invoice_number'];
				 
				$total_discount=$row['total_discount'];
				$grand_total_price=$row['grand_total_price'];
				$paid_amount=$row['paid_amount'];
				$due_amount=$row['due_amount'];				
				
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
													
				<form class="form-vertical" id="editinvoice" name="addinvoice" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="panel-body">
                        <div class="row"> 
                         <div id="error"></div>                       
							<div class="col-sm-8" id="customer_section_1">
                                <div class="form-group row">
                                    <label for="customer_name" class="col-sm-3 col-form-label"><?php echo $lang['Customers'];?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-6">
                                       <input type="text" size="100" autocomplete="off" readonly name="customer_name" class="customerSelection form-control" value="<?php if(isset($cus_name)){ echo $cus_name;}?>" placeholder='<?php echo $lang['Customers'];?>' id="customer_name" required  />

                                        <input id="customer_id" class="hidden_value" type="hidden" name="customer_id">
                                        
                                        <input id="inv"  type="hidden" name="inv" value="<?php if(isset($invoice_number)){echo $invoice_number;}?>">
                                        <input id="payment_detail_date"  type="hidden" name="payment_detail_date" value="<?php echo date("Y-m-d");?>">
                                    </div>                                    
                                </div>                                
                            </div>                            
                        </div>
						<div class="form-group row">
                            <label for="datepicker_invoice_date" class="col-sm-2 col-form-label"><?php echo $lang['Date'];?> <i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" autocomplete="off"  id="datepicker_invoice_date" <?php if(isset($due_amount) && $due_amount==0){ echo "readonly";}?> value="<?php if(isset($date_order_placed)){ echo $date_order_placed;}?>" name="datepicker_invoice_date" placeholder="yyyy-mm-dd">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                            </div>
                        </div>             

                        <div class="table-responsive" style="margin-top: 10px">
                            <table class="table table-bordered table-hover" id="normalinvoice">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo $lang['ItemInformation'];?> <i class="text-danger">*</i></th>
                                        
                                        <th class="text-center"><?php echo $lang['Quantity'];?></th>
                                        <th class="text-center"><?php echo $lang['Rate'];?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo $lang['Discount/item'];?> </th>
                                        <th class="text-center"><?php echo $lang['Total'];?></th>
                                        
                                    </tr>
                                </thead>
                                <tbody id="addinvoiceItem">
                                 <?php
								 if(isset($invoice_number)){
							$sqlquery = "SELECT p.*, pli.* from invoice_line_items as pli, product as p where p.product_id=pli.product_id
							and pli.order_id=$getorder_id and pli.invoice_no_id=$invoice_number";
								$queryresult = $conn->query($sqlquery);
								
								if ($queryresult->num_rows > 0) 
								{	
										$i=1;
									while($productrow = $queryresult->fetch_assoc()) 
									{								
									
									?>
                                    <tr>
                                        <td style="width: 220px">
                                            <input name="product_name[]" onkeypress="invoice_productList(<?php echo $i;?>);" class="form-control productSelection" placeholder="Product Name" required id="product_name" autocomplete="off" tabindex="1" readonly value="<?php echo $productrow['product_name'];?>" type="text">
                                           <input type="hidden" class="autocomplete_hidden_value product_id_<?php echo $i;?>" name="product_id[]" value="<?php echo $productrow['product_id'];?>"  id="product_id"/>
                                        </td>
                                        
                                        <td>
                                            <input name="product_quantity[]" autocomplete="off" class="total_qty_<?php echo $i;?> form-control" id="total_qty_<?php echo $i;?>" readonly onkeyup="quantity_calculate(<?php echo $i;?>);" required onchange="quantity_calculate(<?php echo $i;?>);" placeholder="0.00" tabindex="2" value="<?php echo $productrow['product_quantity'];?>" type="text">
                                        </td>
                                        <td style="width: 85px">
                                            <input name="product_rate[]" id="item_price_<?php echo $i;?>" class="item_price_<?php echo $i;?> price_item form-control" tabindex="6"  readonly type="text" value="<?php echo $productrow['product_rate'];?>" >
                                        </td>
                                        <!-- Discount -->
                                        <td>
                                            <input name="discount[]" id="discount_<?php echo $i;?>" class="form-control" autocomplete="off" min="0" tabindex="3" onkeyup="quantity_calculate(<?php echo $i;?>);" onchange="quantity_calculate(<?php echo $i;?>);" value="<?php echo $productrow['discount'];?>" placeholder="0.00" readonly type="text">
                                       		<input type="hidden" id="total_discount_<?php echo $i;?>" class="total_tax_<?php echo $i;?>" />
                                            <input type="hidden" id="all_discount_<?php echo $i;?>" class="total_discount"/>
                                        </td>
                                       
                                        <td style="width: 100px">
                                            <input class="total_price form-control" name="total_price[]" id="total_price_<?php echo $i;?>" value="<?php echo $productrow['total_price'];?>" tabindex="-1" readonly type="text">
                                        </td>
                                        
                                    </tr>
                                    <?php $i++; }
								}
							}?>
                                </tbody>
                                <tfoot>
                                    
                                    <tr>
                                        <td style="text-align:right;" colspan="4"><b><?php echo $lang['TotalDiscount'];?>:</b></td>
                                        <td class="text-right">
                                            <input id="total_discount_ammount" class="form-control" name="total_discount" tabindex="-1" value="<?php if(isset($total_discount)){ echo $total_discount;}?>" readonly type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align:right;"><b><?php echo $lang['GrandTotal'];?>:</b></td>
                                        <td class="text-right">
                                            <input id="grandTotal" class="form-control" name="grand_total_price" tabindex="-1" value="<?php if(isset($grand_total_price)){ echo $grand_total_price;}?>" readonly type="text">
                                        </td>
                                    </tr>
                                    <tr>                                        
                                        <td style="text-align:right;" colspan="4"><b><?php echo $lang['PaidAmount'];?>:</b></td>
                                        <td class="text-right">
                                            <input id="paidAmount" autocomplete="off" class="form-control" name="paid_amount" onkeyup="invoice_paidamount();" readonly value="<?php if(isset($paid_amount)){ echo $paid_amount;}?>" placeholder="0.00" tabindex="6" type="text">
                                        </td>
                                    </tr>
                                    <tr>                                                                        
                                        <td style="text-align:right;" colspan="4"><b><?php echo $lang['Due'];?>:</b></td>
                                        <td class="text-right">
                                            <input id="dueAmmount" class="form-control"  name="due_amount" <?php if(isset($due_amount) && $due_amount==0){ echo "readonly";}?> value="<?php if(isset($due_amount)){ echo $due_amount;}?>" type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input id="add-invoice" class="btn btn-success" name="add-invoice" <?php if(isset($due_amount) && $due_amount==0){ echo "disabled";}?>   value="<?php echo $lang['Submit'];?>" tabindex="8" type="submit">                                            
                                        </td>                                
                                        <td style="text-align:right;" colspan="3"><b><?php echo $lang['AddDueAmount'];?>:</b></td>
                                        <td class="text-right">
                                            <input id="remainingamount" class="form-control" onKeyUp="invoice_update();" <?php if(isset($due_amount) &&  $due_amount==0){ echo "readonly";}?>  name="remainingamount" placeholder="0.00" type="text">
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
        <script src="js/invoice.js"></script>      
        <script>
		
	$(document).ready(function(){
		$('#datepicker_invoice_date').datepicker({
		format: "yyyy-mm-dd",
		autoclose: true,
		todayHighlight: true
		});		
				
	});	
	
</script>
<?php include ('product_invoice.js.php'); ?>        
<script type="text/javascript">
			jQuery(document).ready(function(){			
			  
			  // edit invoice Form
			  jQuery("#editinvoice").validate({
			   				
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
					var data = $("#editinvoice").serialize();			
					$.ajax({
			
						type : 'POST',
						url  : 'modal/edit_invoiceModel.php',
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
									setTimeout('$("#editinvoice").fadeOut(500, function(){ window.location = "invoices.php" }); ',1000);
				   
							  }
						   
						}
					});
					return false;
				}
			});
	</script>
</body>
</html>