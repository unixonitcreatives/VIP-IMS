<?php session_start();
if(empty($_SESSION['auth_username'])) { header("Location: ../index.php");}
require_once ('../connection/connection.php');
include("language.php");
if(isset($_GET['s']) && !empty($_GET['s'])){
	$sid=strip_tags(trim($_GET['s']));
	$sql = "SELECT a.*, u.* from users_type as u, auth as a where a.user_type_id=u.user_type_id and a.auth_id='$sid'";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) 
	{
		$auth_id=$row['auth_id'];
		$auth_username=$row['auth_username'];
		$full_name=$row['full_name'];
		$user_type_id=$row['user_type_id'];
		//$auth_password=md5($row['auth_password']);		
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
		<title><?php echo $lang['Edit'];?> <?php echo $lang['Staff'];?></title>

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
						<h4><?php echo $lang['Edit'];?> <?php echo $lang['Staff'];?></h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="index.php"><?php echo $lang['Dashboard'];?></a></li>	
                            <li class="breadcrumb-item"><a href="#"><?php echo $lang['StaffList'];?></a></li>						
							<li class="breadcrumb-item active"><?php echo $lang['Edit'];?> <?php echo $lang['Staff'];?></li>
						</ol>
						<div class="box box-block bg-white">
							<h5><?php echo $lang['Edit'];?> <?php echo $lang['Staff'];?></h5>
							<p class="font-90 text-muted mb-1"> <?php echo $lang['usethisformtoeditstaffinfo'];?>.</p>
							<form class="form-material material-primary add-product" id="editstaff">
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['UserName'];?></label>
									<div class="col-sm-10">
										<input type="text" class="form-control" value="<?php if(!empty($auth_username)){echo $auth_username;}?>" id="user_name" name="user_name" placeholder="<?php echo $lang['UserName'];?>" autocomplete="off" required>
									</div> <input type="hidden" name="auth_id" value="<?php if(!empty($auth_id)){echo $auth_id;}?>" >
								</div>
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['FullName'];?></label>
									<div class="col-sm-10">
										<input type="text" class="form-control" value="<?php if(!empty($full_name)){echo $full_name;}?>" id="full_name" name="full_name" placeholder="<?php echo $lang['FullName'];?>" autocomplete="off" required>
									</div>
								</div>                                
                                <?php 
								if($auth_id==1){
									$c = "SELECT * FROM users_type where user_type_id='$user_type_id'";
								$resultc = $conn->query($c);
								?>
                                 <div class="form-group row">
									<label for="user_type_id" class="col-sm-2 form-control-label"><?php echo $lang['UserType'];?> </label>
									<div class="col-sm-10">
										<select id="user_type_id" name="user_type_id" class="form-control" data-plugin="select2" required>                                        
                                        <?php while($rowc = $resultc->fetch_assoc()) { ?>
											<option  <?php if($user_type_id==$rowc['user_type_id']){echo "selected";}?> value="<?php echo $rowc['user_type_id'];?>"><?php echo $rowc['user_type'];?></option>
										<?php } ?>	
										</select>
									</div>
								</div>								
                                
                                <?php }else{ 
								$c = "SELECT * FROM users_type";
								$resultc = $conn->query($c); ?>
                                <div class="form-group row">
									<label for="user_type_id" class="col-sm-2 form-control-label"><?php echo $lang['UserType'];?> </label>
									<div class="col-sm-10">
										<select id="user_type_id" name="user_type_id" class="form-control" data-plugin="select2" required>
                                        <option value=""><?php echo $lang['SelectUserType'];?></option>
                                        <?php while($rowc = $resultc->fetch_assoc()) { ?>
											<option  <?php if($user_type_id==$rowc['user_type_id']){echo "selected";}?> value="<?php echo $rowc['user_type_id'];?>"><?php echo $rowc['user_type'];?></option>
										<?php } ?>	
										</select>
									</div>
								</div>
                                <?php } ?>
                                <div class="form-group row">
									<div class="offset-sm-2 col-sm-10">
										<button type="submit" class="btn btn-primary" id="btn-submit" value="Edit Staff Info" ><?php echo $lang['Edit'];?> <?php echo $lang['StaffInfo'];?></button>                                     
                                        
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
			  jQuery("#editstaff").validate({
			   				
				rules:
			   {
					user_name: {
					required: true,
					minlength: 3
					},					
					
					full_name: {
					required: true,
					minlength: 6
					 }
			   },
				submitHandler: submitForm
			  });
			  
			  
			   function submitForm()
				{
					
					NProgress.start();
					var data = $("#editstaff").serialize();
			
					$.ajax({
			
						type : 'POST',
						url  : 'modal/edit_staffModel.php',
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
									setTimeout('$(".bg-white").fadeOut(700, function(){ window.location = "staff.php" }); ',800);

				   
							  }
						   
						}
					});
					return false;
				}
			  
			  
				
			});



</script>
	</body>

</html>