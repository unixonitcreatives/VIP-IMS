<?php session_start();
if(empty($_SESSION['auth_username'])) { header("Location: ../index.php");}
require_once ('../connection/connection.php');
include("language.php");
if(isset($_GET['i']) && !empty($_GET['i'])){
	$getorder_id=strip_tags(trim($_GET['i']));
	$sql = "SELECT a.*,o.*,inv.*,sup.*,w.*, ipd.* FROM sup_invoice_payment_detail as ipd, warehouse as w,suppliers_orders as o,sup_invoices as inv, auth as a,suppliers as sup  where a.auth_id=ipd.auth_id
	and a.auth_id=o.auth_id and ipd.auth_id=o.auth_id and ipd.exp_invoice_id=inv.exp_invoice_number and sup.supplier_id=ipd.supplier_id and o.exp_order_id=ipd.exp_order_id and w.war_id=ipd.warehouse_id and o.exp_order_id='$getorder_id'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				$full_name=$row['full_name'];
				$supplier_phone=$row['supplier_phone'];
				$supplier_name=$row['supplier_name'];
				$supplier_address=$row['supplier_address'];
				$war_name=$row['war_name'];
				$date_order_placed=$row['exp_order_date'];
				$exp_payment_detail_date=$row['exp_payment_detail_date'];
				$invoice_number=$row['exp_invoice_number'];				 
				
				$grand_total_price=$row['exp_grand_total_price'];
				$paid_amount=$row['exp_paid_amount'];
				$due_amount=$row['exp_due_amount'];	
				$sup_invoice_image=$row['sup_invoice_image'];				
				
			}
		}
}
$sql1 = "SELECT * FROM setting where setting_id='1'";
	$result1 = $conn->query($sql1);
	while($row1 = $result1->fetch_assoc()) 
	{
		$setting_id1=$row1['setting_id'];
		$setting_name1=$row1['setting_name'];
		$setting_logo1=$row1['setting_logo'];
		$setting_address1=$row1['setting_address'];
		$setting_city1=$row1['setting_city'];
		$setting_country1=$row1['setting_country'];
		$setting_phone1=$row1['setting_phone'];
		$setting_fax1=$row1['setting_fax'];
		$setting_web1=$row1['setting_web'];
		$setting_currency1=$row1['setting_currency'];
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
	<body class="fixed-sidebar fixed-header skin-3 content-appear forprint" >
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
						<h4><?php echo $lang['InvoiceList'];?> </h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="index.php"><?php echo $lang['Dashboard'];?></a></li>							
							<li class="breadcrumb-item active"><?php echo $lang['InvoiceList'];?></li>
						</ol>
						<div class="card" id="printinvoice">
							<div class="card-header clearfix">
								<h5 class="float-xs-left mb-0"><?php echo $lang['Invoice'];?> #<?php if(isset($invoice_number)){ echo $invoice_number;}?></h5>
								<div class="float-xs-right"><?php if(isset($date_order_placed)){ echo date("F d, Y",strtotime($date_order_placed));}?></div>
							</div>
							<div class="card-block" >
								<div class="row mb-2">
									<div class="col-sm-8 col-xs-6">
										<img src="img/logo/<?php if(isset($setting_logo1)){ echo $setting_logo1;}?>" class="invoice-logo">
                                        <h5><?php if(isset($setting_name1)){ echo $setting_name1;}?>,</h5>
										<p><a class="text-primary" href="#"><span class="underline"><?php if(isset($setting_web1)){ echo $setting_web1;}?></span></a></p>
										<p><?php if(isset($setting_address1)){ echo $setting_address1;}?><br><?php if(isset($setting_city1)){ echo $setting_city1;}?><br><?php if(isset($setting_country1)){ echo $setting_country1;}?></p>
										<p><?php echo $lang['Phone'];?>: <?php if(isset($setting_phone1)){ echo $setting_phone1;}?><br><?php echo $lang['Fax'];?>: <?php if(isset($setting_fax1)){ echo $setting_fax1;}?></p>
                                        
                                        
                                        </div>
									<div class="col-sm-4 col-xs-6">
                                    <h5><?php echo $lang['InvoiceTo'];?>:</h5>
                                                                           
                                        <p><?php if(isset($supplier_name)){echo $supplier_name;}?>,</p>
										<p><?php if(isset($supplier_address)){echo $supplier_address;}?></p>
										<p><?php echo $lang['Phone'];?>: <?php if(isset($supplier_phone)){echo $supplier_phone;}?></p>										
										<p><?php echo $lang['Date'];?>: <?php if(isset($date_order_placed)){ echo date("F d, Y",strtotime($date_order_placed));}?></p>
									
										<h5><?php echo $lang['PaymentDetails'];?>:</h5>
                                        <div class="clearfix mb-0-25">
                                        	<span class="float-xs-left"><?php echo $lang['GrandTotal'];?>: </span>                                            
                                            <span class="float-xs-right"><?php if(isset($setting_currency1)){ echo $setting_currency1;}?><?php if(isset($grand_total_price)){echo $grand_total_price;}?></span>											
										</div>
                                        <div class="clearfix mb-0-25">
                                        	<span class="float-xs-left"><?php echo $lang['PaidTotal'];?>: </span>                                            
                                            <span class="float-xs-right"><?php if(isset($setting_currency1)){ echo $setting_currency1;}?><?php if(isset($paid_amount)){echo $paid_amount;}?></span>											
										</div>
										<div class="clearfix mb-0-25">
											<span class="float-xs-left"><?php echo $lang['TotalDue'];?>:</span>
											<span class="float-xs-right"><?php if(isset($setting_currency1)){ echo $setting_currency1;}?><?php if(isset($due_amount)){echo $due_amount;}?></span>
										</div>
                                        <hr class="hr">
                                        <p><?php echo $lang['Warehouse'];?>: <?php echo $war_name;?></p>	
                                        <hr class="hr">
                                        <p><?php echo $lang['Invoicecreatedby'];?>: <?php echo $full_name;?></p>
                                        <?php if(($date_order_placed !=$exp_payment_detail_date)){?>
										<p><?php echo $lang['Invoiceupdatedby'];?>: <?php echo date("F d, Y",strtotime($exp_payment_detail_date));?></p>
                                        <?php } ?>																		
									</div>

								</div>								
									<table class="table table-bordered table-hover" >
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo $lang['ItemInformation'];?></th>                                        
                                        <th class="text-center"><?php echo $lang['Quantity'];?></th>
                                        <th class="text-center"><?php echo $lang['Rate'];?></th>                                        
                                        <th class="text-center"><?php echo $lang['Total'];?></th>                                        
                                    </tr>
                                </thead>
									<tbody>
                                    <?php
							$sqlquery = "SELECT * from sup_invoice_line_items where exp_invoice_id='$invoice_number' and exp_order_id=$getorder_id";
								$queryresult = $conn->query($sqlquery);
								
								if ($queryresult->num_rows > 0) 
								{
									while($productrow = $queryresult->fetch_assoc()) 
									{								
									
									?>
										<tr>
											<td><?php echo $productrow['exp_product_name'];?></td>
											<td><?php echo $productrow['exp_product_quantity'];?></td>
											<td><?php if(isset($setting_currency1)){ echo $setting_currency1;}?><?php echo $productrow['exp_product_rate'];?></td>											
                                            <td><?php if(isset($setting_currency1)){ echo $setting_currency1;}?><?php echo $productrow['exp_total_price'];?></td>
										</tr>	
                                    <?php }
								}?>
                                        									
									</tbody>
								</table>
								<div class="row">
									<div class="col-md-6">
										
										<?php if(!empty($sup_invoice_image)){ ?>
                                        <div class="mb-0-5"><strong><?php echo $lang['Image'];?></strong></div>
											<img src="uploads/<?php echo $sup_invoice_image;?>" width="400" height="250" >
										<?php }?>
									</div>
									<div class="col-md-6">
										<div class="text-xs-right">
											<div class="mb-0-5">Sub - <?php echo $lang['TotalAmount'];?>: <?php if(isset($setting_currency1)){ echo $setting_currency1;}?><?php if(isset($grand_total_price)){echo $grand_total_price;}?></div>											
											<div class="mb-0-5"><?php echo $lang['GrandTotal'];?>: <strong><?php if(isset($setting_currency1)){ echo $setting_currency1;}?><?php if(isset($grand_total_price)){echo $grand_total_price;}?></strong></div>
                                            <div class="mb-0-5"><?php echo $lang['PaidTotal'];?>: <?php if(isset($setting_currency1)){ echo $setting_currency1;}?><?php if(isset($paid_amount)){echo $paid_amount;}?></div>
                                            <div class="mb-0-5"><?php echo $lang['TotalDue'];?>: <?php if(isset($setting_currency1)){ echo $setting_currency1;}?><?php if(isset($due_amount)){echo $due_amount;}?></div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer clearfix">
								<button type="button" class="btn btn-danger label-left float-xs-right">
									<span class="btn-label"><i class="ti-download"></i></span>
									Download
								</button>
								<button type="button" class="btn btn-info buttons-print  label-left float-xs-right mr-0-5" onclick="printDiv('printinvoice')">
									<span class="btn-label"><i class="ti-printer"></i></span>
									Print
								</button>
                                
							</div>
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
		
	
        <script type="text/javascript" src="../adaptinventory/toastr/toastr.min.js"></script>
		
		<!-- Neptune JS -->
		<script type="text/javascript" src="js/app.js"></script>
		<script type="text/javascript" src="js/demo.js"></script>
        <script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;	
    window.print();
    document.body.innerHTML = originalContents;
}

</script>
		
	</body>

</html>