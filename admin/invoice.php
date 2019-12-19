<?php session_start();
if(empty($_SESSION['auth_username'])) { header("Location: ../index.php");}
require_once ('../connection/connection.php');
include("language.php");
if(isset($_GET['i']) && !empty($_GET['i'])){
	$getorder_id=strip_tags(trim($_GET['i']));
	$sql = "SELECT c.*,o.*,inv.*,a.*, ipd.* FROM invoice_payment_detail as ipd, orders as o,auth as a,invoices as inv, customers as c where c.cus_id=ipd.customer_id
	and c.cus_id=o.customer_id and ipd.customer_id=o.customer_id and ipd.invoice_no_id=inv.invoice_number and o.auth_id=a.auth_id and ipd.auth_id=a.auth_id and o.order_id=ipd.order_id and o.order_id='$getorder_id'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				$full_name=$row['full_name'];
				$cus_name=$row['cus_name'];
				$cus_mobile=$row['cus_mobile'];
				$cus_address=$row['cus_address'];
				$date_order_placed=$row['date_order_placed'];
				$invoice_number=$row['invoice_number'];
				 $payment_detail_date=$row['payment_detail_date'];
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
						<h4><?php echo $lang['InvoicesList'];?></h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="index.php"><?php echo $lang['Dashboard'];?></a></li>							
							<li class="breadcrumb-item active"><?php echo $lang['InvoicesList'];?></li>
						</ol>
						<div class="card" id="printinvoice">
							<div class="card-header clearfix">
								<h5 class="float-xs-left mb-0"><?php echo $lang['Invoice'];?> #<?php if(isset($invoice_number)){ echo $invoice_number;}?></h5>
								<div class="float-xs-right"><?php if(isset($date_order_placed)){ echo date("F d, Y",strtotime($date_order_placed));}?></div>
							</div>
							<div class="card-block" >
								<div class="row mb-2">
									<div class="col-sm-8 col-xs-6">										
                                        <img src="img/logo/<?php if(isset($setting_logo1)){ echo $setting_logo1;}?>" >
                                        <h5><?php if(isset($setting_name1)){ echo $setting_name1;}?>,</h5>
										<p><a class="text-primary" href="#"><span class="underline"><?php if(isset($setting_web1)){ echo $setting_web1;}?></span></a></p>
										<p><?php if(isset($setting_address1)){ echo $setting_address1;}?><br><?php if(isset($setting_city1)){ echo $setting_city1;}?><br><?php if(isset($setting_country1)){ echo $setting_country1;}?></p>
										<p><?php echo $lang['Phone'];?>: <?php if(isset($setting_phone1)){ echo $setting_phone1;}?><br>Fax: <?php if(isset($setting_fax1)){ echo $setting_fax1;}?></p>
                                        
										</div>
									<div class="col-sm-4 col-xs-6">
                                    <h5><?php echo $lang['InvoiceTo'];?>:</h5>
                                                                           
                                        <p><?php if(isset($cus_name)){echo $cus_name;}?>,</p>
										<p><?php if(isset($cus_address)){echo $cus_address;}?></p>
										<p><?php echo $lang['Phone'];?>: <?php if(isset($cus_mobile)){echo $cus_mobile;}?></p>
									
										<h5><?php echo $lang['PaymentDetails'];?>:</h5>
										<div class="clearfix mb-0-25">
                                        	<span class="float-xs-left"><?php echo $lang['GrandTotal'];?>: </span>                                            
                                            <span class="float-xs-right"><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php if(isset($grand_total_price)){echo $grand_total_price;}?></span>											
										</div>
                                        <div class="clearfix mb-0-25">
                                        	<span class="float-xs-left"><?php echo $lang['PaidTotal'];?>: </span>                                            
                                            <span class="float-xs-right"><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php if(isset($paid_amount)){echo $paid_amount;}?></span>											
										</div>
										<div class="clearfix mb-0-25">
											<span class="float-xs-left"><?php echo $lang['TotalDue'];?>:</span>
											<span class="float-xs-right"><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php if(isset($due_amount)){echo $due_amount;}?></span>
										</div>
                                        <hr class="hr">
                                        <p><?php echo $lang['Invoicecreatedby'];?>: <?php if(isset($full_name)){ echo $full_name;}?></p>                                        
                                        <?php 
										if(isset($payment_detail_date)){
										if(($date_order_placed !=$payment_detail_date)){?>
										<p><?php echo $lang['Invoiceupdateddate'];?>: <?php echo date("F d, Y",strtotime($payment_detail_date));?></p>
                                        <?php }
										} ?>																			
									</div>

								</div>
								
								<table class="table table-bordered table-hover" >
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo $lang['ItemInformation'];?></th>                                        
                                        <th class="text-center"><?php echo $lang['Quantity'];?></th>
                                        <th class="text-center"><?php echo $lang['Rate'];?></th>
                                        <th class="text-center"><?php echo $lang['Discount/item'];?></th>
                                        <th class="text-center"><?php echo $lang['Total'];?></th>                                        
                                    </tr>
                                </thead>
									<tbody>
                                    <?php
									if(isset($invoice_number)){
							$sqlquery = "SELECT p.*, pli.* from invoice_line_items as pli, product as p where p.product_id=pli.product_id
							and pli.order_id=$getorder_id and pli.invoice_no_id=$invoice_number";
								$queryresult = $conn->query($sqlquery);
								
								if ($queryresult->num_rows > 0) 
								{
									while($productrow = $queryresult->fetch_assoc()) 
									{								
									
									?>
										<tr>
											<td><?php echo $productrow['product_name'];?></td>
											<td><?php echo $productrow['product_quantity'];?></td>
											<td><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php echo $productrow['product_rate'];?></td>
											<td><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php echo $productrow['discount'];?></td>
                                            <td><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php echo $productrow['total_price'];?></td>
										</tr>	
                                    <?php }
								}
								
									}?>
                                        									
									</tbody>
								</table>
								<div class="row">
									<div class="col-md-6">
										<strong><?php echo $lang['TermsandConditions'];?></strong>
										<p class="text-muted mb-0">Thank you for your business. We do expect payment within 21 days, so please process this invoice within that time. There will be a 1.5% interest charge per month on late invoices.</p>
									</div>
									<div class="col-md-6">
										<div class="text-xs-right">
											<div class="mb-0-5">Sub - <?php echo $lang['TotalAmount'];?>: <?php if(isset($setting_currency)){ echo $setting_currency;}?><?php if(isset($total_discount) && isset($grand_total_price)){echo $total_discount + $grand_total_price;}?></div>
											<div class="mb-0-5"><?php echo $lang['TotalDiscount'];?>: <?php if(isset($setting_currency)){ echo $setting_currency;}?><?php if(isset($total_discount)){echo $total_discount;}?></div>
											<div class="mb-0-5"><?php echo $lang['GrandTotal'];?>: <strong><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php if(isset($grand_total_price)){echo $grand_total_price;}?></strong></div>
                                            <div class="mb-0-5"><?php echo $lang['PaidTotal'];?>: <?php if(isset($setting_currency)){ echo $setting_currency;}?><?php if(isset($paid_amount)){echo $paid_amount;}?></div>
                                            <div class="mb-0-5"><?php echo $lang['TotalDue'];?>: <?php if(isset($setting_currency)){ echo $setting_currency;}?><?php if(isset($due_amount)){echo $due_amount;}?></div>
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