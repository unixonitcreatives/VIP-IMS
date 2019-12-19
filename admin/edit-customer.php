<?php session_start();
if(empty($_SESSION['auth_username'])) { header("Location: ../index.php");}
require_once ('../connection/connection.php');
include("language.php");
if(isset($_GET['c']) && !empty($_GET['c'])){
	$cid=strip_tags(trim($_GET['c']));
	$sql = "SELECT * FROM customers where cus_id='$cid'";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) 
	{
		$cus_id=$row['cus_id'];
		$cus_name=$row['cus_name'];
		$cus_mobile=$row['cus_mobile'];
		$cus_email=$row['cus_email'];		
		$cus_address=$row['cus_address'];
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
		<title><?php echo $lang['Edit'];?> <?php echo $lang['Customers'];?></title>

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
						<h4><?php echo $lang['Edit'];?> <?php echo $lang['Customers'];?></h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="index.php"><?php echo $lang['Dashboard'];?></a></li>	
                            <li class="breadcrumb-item"><a href="#"><?php echo $lang['CustomersList'];?></a></li>						
							<li class="breadcrumb-item active"><?php echo $lang['Edit'];?> <?php echo $lang['Customers'];?></li>
						</ol>
						<div class="box box-block bg-white">
							<h5><?php echo $lang['Edit'];?> <?php echo $lang['Customers'];?></h5>
							<p class="font-90 text-muted mb-1"> <?php echo $lang['usethisformtoeditcustomersinfo'];?>.</p>
							<form class="form-material material-primary" id="editcustomer">
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Customers'];?></label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="cus_name" name="cus_name" placeholder="<?php echo $lang['Customers'];?>" value="<?php if(isset($cus_name)) echo $cus_name;?>" required>
									</div>
								</div>
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Mobile'];?></label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="cus_mobile" name="cus_mobile" placeholder="<?php echo $lang['Mobile'];?>" value="<?php if(isset($cus_mobile)) echo $cus_mobile;?>" required>
										<input type="hidden" class="form-control" id="cus_id" name="cus_id" value="<?php if(isset($cus_id)) echo $cus_id;?>" >
                                    
                                    </div>
								</div>
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Email'];?></label>
									<div class="col-sm-10">
										<input type="email" class="form-control" id="cus_email" name="cus_email" placeholder="<?php echo $lang['Email'];?>" value="<?php if(isset($cus_email)) echo $cus_email;?>" >
									</div>
								</div>                                
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['BillingAddress'];?></label>
									<div class="col-sm-10">
										<textarea name="cus_address" class="form-control" id="cus_address" placeholder="<?php echo $lang['BillingAddress'];?>"><?php if(isset($cus_address)) echo $cus_address;?></textarea>
									</div>
								</div>
                                <div class="form-group row">
									<div class="offset-sm-2 col-sm-10">
										<button type="submit" class="btn btn-primary" id="btn-submit" value="Add Customer" ><?php echo $lang['Update'];?> <?php echo $lang['Customers'];?></button>                                     
                                        
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
		<!-- Neptune JS -->
		<script type="text/javascript" src="js/app.js"></script>
		<script type="text/javascript" src="js/demo.js"></script>
		<script type="text/javascript" src="js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="js/ui-notifications.js"></script>
        <script>
			jQuery(document).ready(function(){
				
			  
			  // Edit supplier Form
			  jQuery("#editcustomer").validate({
			   				
				rules:
			   {
					customer_name: {
					required: true,
					minlength: 3
					}
			   },
				submitHandler: submitForm
			  });
			  
			  
			   function submitForm()
				{
					
					NProgress.start();
					var data = $("#editcustomer").serialize();
			
					$.ajax({
			
						type : 'POST',
						url  : 'modal/edit_customerModel.php',
						data : data,
						dataType : 'json',
						
						beforeSend: function()
						{
							//alert(data);
							$("#error").fadeOut();
							$("#btn-submit").html(' <img src="img/loader1.gif" /> &nbsp; Updating ...');
						},
						success :  function (data)
						{					
						//alert(data.status);
							if(data.status==='error'){
			
								$("#error").fadeIn(1000, function(){									
			
									$("#btn-submit").html(' &nbsp; Try Again');
								});
							}
							else if(data.status==='successfully')
							{
								
									//$("#btn-submit").html('Add Supplier');									
									toastr.options = {
									positionClass: 'toast-top-right'
									};
									toastr.success('Successfully updated!');
									NProgress.done();
									//$("#addsupplier").trigger('reset');
									setTimeout('$(".bg-white").fadeOut(700, function(){ window.location = "customers.php" }); ',800);

				   
							  }
						   
						}
					});
					return false;
				}
			  
			  
				
			});



</script>
	</body>

</html>