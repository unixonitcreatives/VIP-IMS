<?php session_start();
if(empty($_SESSION['auth_username'])) { header("Location: ../index.php");}
require_once ('../connection/connection.php');
include("language.php");
if(isset($_GET['s']) && !empty($_GET['s'])){
	$sid=strip_tags(trim($_GET['s']));
	$sql = "SELECT * FROM suppliers where supplier_id='$sid'";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) 
	{
		$supplier_id=$row['supplier_id'];
		$supplier_name=$row['supplier_name'];
		$supplier_contact_name=$row['supplier_contact_name'];
		$supplier_email=$row['supplier_email'];
		$supplier_phone=$row['supplier_phone'];
		$supplier_address=$row['supplier_address'];
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
		<title><?php echo $lang['Suppliers'];?></title>

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
						<h4><?php echo $lang['Edit'];?> <?php echo $lang['Suppliers'];?></h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="index.php"><?php echo $lang['Dashboard'];?></a></li>	
                            <li class="breadcrumb-item"><a href="suppliers.php"><?php echo $lang['SuppliersList'];?></a></li>						
							<li class="breadcrumb-item active"><?php echo $lang['Edit'];?> <?php echo $lang['Suppliers'];?></li>
						</ol>
						<div class="box box-block bg-white">
							<h5><?php echo $lang['Edit'];?> <?php echo $lang['Suppliers'];?></h5>
							<p class="font-90 text-muted mb-1"><?php echo $lang['usethisformtoeditsupplierinfo'];?>.</p>
							<form class="form-material material-primary" id="editsupplier">
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Suppliers'];?></label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="<?php echo $lang['Suppliers'];?>" value="<?php if(isset($supplier_name)) echo $supplier_name;?>" required>
									</div>
								</div>
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['ContactPerson'];?></label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="supplier_contact_name" name="supplier_contact_name" placeholder="<?php echo $lang['ContactPerson'];?>" value="<?php if(isset($supplier_contact_name)) echo $supplier_contact_name;?>" required>
										<input type="hidden" class="form-control" id="supplier_id" name="supplier_id" value="<?php if(isset($supplier_id)) echo $supplier_id;?>" >
                                    
                                    </div>
								</div>
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Email'];?></label>
									<div class="col-sm-10">
										<input type="email" class="form-control" id="supplier_email" name="supplier_email" placeholder="<?php echo $lang['Email'];?>" value="<?php if(isset($supplier_email)) echo $supplier_email;?>" >
									</div>
								</div>
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Phone'];?></label>
									<div class="col-sm-10">
										<input type="tel" class="form-control" id="supplier_phone" name="supplier_phone" placeholder="<?php echo $lang['Phone'];?>" value="<?php if(isset($supplier_phone)) echo $supplier_phone;?>" >
									</div>
								</div>
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Address'];?></label>
									<div class="col-sm-10">
										<textarea name="supplier_address" class="form-control" id="supplier_address" placeholder="<?php echo $lang['Address'];?>"><?php if(isset($supplier_address)) echo $supplier_address;?></textarea>
									</div>
								</div>
                                <div class="form-group row">
									<div class="offset-sm-2 col-sm-10">
										<button type="submit" class="btn btn-primary" id="btn-submit" value="Add Supplier" ><?php echo $lang['Update'];?> <?php echo $lang['Suppliers'];?></button>                                     
                                        
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
			  jQuery("#editsupplier").validate({
			   				
				rules:
			   {
					supplier_name: {
					required: true,
					minlength: 3
					},
					supplier_contact_name: {
					required: true,
					minlength: 3
					 }
			   },
				submitHandler: submitForm
			  });
			  
			  
			   function submitForm()
				{
					
					NProgress.start();
					var data = $("#editsupplier").serialize();
			
					$.ajax({
			
						type : 'POST',
						url  : 'modal/edit_supplierModel.php',
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
										
										toastr.options = {
									positionClass: 'toast-top-right'
									};
									toastr.error('Error Try Again!');	
									$("#btn-submit").html(' &nbsp; Try Again');
								
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
									setTimeout('$(".bg-white").fadeOut(700, function(){ window.location = "suppliers.php" }); ',800);

				   
							  }
						   
						}
					});
					return false;
				}
			  
			  
				
			});



</script>
	</body>

</html>