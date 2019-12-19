<?php session_start();
if(empty($_SESSION['auth_username'])) { header("Location: ../index.php");}
require_once ('../connection/connection.php');
include("dashboard-queries.php"); 
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
		<title><?php echo $lang['Dashboard'];?></title>

		<!-- adaptinventory CSS -->
		<link rel="stylesheet" href="../adaptinventory/bootstrap4/css/bootstrap.min.css">
		<link rel="stylesheet" href="../adaptinventory/themify-icons/themify-icons.css">
		<link rel="stylesheet" href="../adaptinventory/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../adaptinventory/animate.css/animate.min.css">
		<link rel="stylesheet" href="../adaptinventory/jscrollpane/jquery.jscrollpane.css">
		<link rel="stylesheet" href="../adaptinventory/waves/waves.min.css">
		<link rel="stylesheet" href="../adaptinventory/switchery/dist/switchery.min.css">
		<link rel="stylesheet" href="../adaptinventory/morris/morris.css">
		

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
                    
                    <h6><?php echo $lang['Last365DaysReports'];?></h6>                    
                    	<div class="row">                        
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<div class="box box-block tile tile-2 bg-danger mb-2">
									<div class="t-icon right"><i class="ti-shopping-cart-full"></i></div>
									<div class="t-content">
										<h2 class="mb-1"><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php if(isset($receivable)){ echo $receivable;}?></h2>
										<h6 class="text-uppercase"><?php echo $lang['TotalReceivable'];?></h6>
									</div>
								</div>
							</div>                            
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<div class="box box-block tile tile-2 bg-primary mb-2">
									<div class="t-icon right"><i class="ti-bar-chart"></i></div>
									<div class="t-content">
										<h2 class="mb-1"><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php if(isset($paid_amount)){ echo $paid_amount;}?></h2>
										<h6 class="text-uppercase"><?php echo $lang['TotalReceivedAmount'];?></h6>
									</div>
								</div>
							</div>							
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<div class="box box-block tile tile-2 bg-warning mb-2">
									<div class="t-icon right"><i class="ti-bar-chart"></i></div>
									<div class="t-content">
										<h2 class="mb-1"><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php if(isset($total_discount)){ echo $total_discount;}?></h2>
										<h6 class="text-uppercase"><?php echo $lang['TotalDiscountGiven'];?></h6>
									</div>
								</div>
							</div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<div class="box box-block tile tile-2 bg-success mb-2">
									<div class="t-icon right"><i class="ti-bar-chart"></i></div>
									<div class="t-content">
										<h2 class="mb-1"><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php if(isset($revenue)){ echo $revenue;}?></h2>
										<h6 class="text-uppercase"><?php echo $lang['TotalRevenue'];?></h6>
									</div>
								</div>
							</div>                       		
                          </div>  
                    	<div class="row">
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<div class="box box-block bg-white tile tile-4 mb-2">
									<div class="t-icon left bg-danger"><i class="ti-receipt"></i></div>
									<div class="t-content text-xs-right">
										<h6 class="text-uppercase"><?php echo $lang['TotalInvoice'];?></h6>
										<h2 class="mb-0"><?php if(isset($total_orders)){ echo $total_orders;}?></h2>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<div class="box box-block bg-white tile tile-4 mb-2">
									<div class="t-icon left bg-success"><i class="ti-bar-chart"></i></div>
									<div class="t-content text-xs-right">
										<h6 class="text-uppercase"><?php echo $lang['Sales'];?></h6>
										<h2 class="mb-0"><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php if(isset($sale)){ echo $sale;}?></h2>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<div class="box box-block bg-white tile tile-4 mb-2">
									<div class="t-icon left bg-primary"><i class="ti-shopping-cart-full"></i></div>
									<div class="t-content text-xs-right">
										<h6 class="text-uppercase"><?php echo $lang['SoldProductsTypes'];?></h6>
										<h2 class="mb-0"><?php if(isset($total_sold_products)){ echo $total_sold_products;}?></h2>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<div class="box box-block bg-white tile tile-4 mb-2">
									<div class="t-icon left bg-warning"><i class="ti-shopping-cart-full"></i></div>
									<div class="t-content text-xs-right">
										<h6 class="text-uppercase"><?php echo $lang['TotalSoldProQty'];?></h6>
										<h2 class="mb-0"><?php if(isset($total_sold_product_quantity)){ echo $total_sold_product_quantity;}else{ echo '0';}?></h2>
									</div>
								</div>
							</div>
						</div>
                    	<div class="row">
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<div class="box box-block bg-white tile tile-4 mb-2">
									<div class="t-icon left bg-success"><i class="ti-user"></i></div>
									<div class="t-content text-xs-right">
										<h6 class="text-uppercase"><?php echo $lang['TotalCustomer'];?></h6>
										<h2 class="mb-0"><?php if(isset($total_customer)){ echo $total_customer;}?></h2>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<div class="box box-block bg-white tile tile-4 mb-2">
									<div class="t-icon left bg-success"><i class="ti-user"></i></div>
									<div class="t-content text-xs-right">
										<h6 class="text-uppercase"><?php echo $lang['TotalSupplier'];?></h6>
										<h2 class="mb-0"><?php if(isset($total_suppliers)){ echo $total_suppliers;}?></h2>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<div class="box box-block bg-white tile tile-4 mb-2">
									<div class="t-icon left bg-primary"><i class="ti-shopping-cart-full"></i></div>
									<div class="t-content text-xs-right">
										<h6 class="text-uppercase"><?php echo $lang['TotalItemsinStock'];?></h6>
										<h2 class="mb-0"><?php if(isset($total_products)){ echo $total_products;}?></h2>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<div class="box box-block bg-white tile tile-4 mb-2">
									<div class="t-icon left bg-warning"><i class="ti-shopping-cart-full"></i></div>
									<div class="t-content text-xs-right">
										<h6 class="text-uppercase"><?php echo $lang['TotalItemCategories'];?></h6>
										<h2 class="mb-0"><?php if(isset($total_categories)){ echo $total_categories;}?></h2>
									</div>
								</div>
							</div>
						</div>                       	
						<div class="row row-md mb-2">
							<div class="col-md-4">
								<div class="box box-block bg-white">
                                <h5 class="t-content text-xs-center"><?php echo $lang['365DaysSaleschart'];?></h5>
                                
									<div id="donut" class="chart-container"></div>
								</div>
							</div>
							<div class="col-md-8">
								<div class="box bg-white">
									<div class="box-block clearfix">
										<h5 class="float-xs-left"><?php echo $lang['RecentInvoices'];?></h5>
										<div class="float-xs-right">
											<button class="btn btn-link btn-sm text-muted" type="button"><i class="ti-angle-down"></i></button>
											<button class="btn btn-link btn-sm text-muted" type="button"><i class="ti-reload"></i></button>
											<button class="btn btn-link btn-sm text-muted" type="button"><i class="ti-close"></i></button>
										</div>
									</div>                                    
									<table class="table mb-md-0">
										<tbody>
                                        <?php 
								$sql2 = "SELECT c.*, inv.* FROM invoice_payment_detail as inv, customers as c where c.cus_id=inv.customer_id order by invoice_no_id DESC Limit 0,9";
								$result2 = $conn->query($sql2);
								
								if ($result2->num_rows > 0) 
								{
									// output data of each row
									$i=1;
									while($row2 = $result2->fetch_assoc()) 
									{ ?>
											<tr>
												<th scope="row"><?php echo $i;?></th>
												<td><?php echo $row2['cus_name'];?></td>
												<td>
													<a class="text-primary" href="invoice.php?i=<?php echo $row2['order_id'];?>"><span class="underline"><?php echo $row2['invoice_no_id'];?></span></a>
												</td>
												<td>
													<span class="text-muted"><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php echo $row2['grand_total_price'];?></span>
												</td>
                                                <?php if(isset($row2['due_amount']) && ($row2['due_amount'] != 0)){ ?>
												<td>
													<span class="tag tag-danger">Unpaid</span>
												</td>
                                                <?php }else{?>
                                                <td>
													<span class="tag tag-success">Paid</span>
												</td>
                                                <?php }?>
											</tr>
                                            <?php 
													$i++; }
												} ?>
											
										</tbody>
									</table>
								</div>
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
        <script type="text/javascript" src="../adaptinventory/raphael/raphael.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/morris/morris.min.js"></script>

		<!-- Neptune JS -->
		<script type="text/javascript" src="js/app.js"></script>
		<script type="text/javascript" src="js/demo.js"></script>        
        <link rel="stylesheet" href="css/jquery-ui.css">
         <?php include ('invoice.js.php'); ?>
        <script type="text/javascript">
		


/* =================================================================
    Donut chart
================================================================= */

Morris.Donut({
    element: 'donut',
    data: [{
        label: "<?php echo $lang['TotalReceivable'];?> %",
        value: <?php if(isset($receivableper)){echo $receivableper;}?>,

    }, {
        label: "<?php echo $lang['TotalDiscountGiven'];?> %",
        value: <?php if(isset($total_discountper)){echo $total_discountper;}?>
    }, {
        label: "<?php echo $lang['TotalReceivedAmount'];?> %",
        value: <?php if(isset($paid_amountper)){echo $paid_amountper;}?>
    }
	],
    resize: true,
    colors:['#f44236', '#f59345', '#43b968']
});


</script>
	</body>

</html>