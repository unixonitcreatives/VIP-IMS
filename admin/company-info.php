<?php session_start();
if(empty($_SESSION['auth_username'])) { header("Location: ../index.php");}
require_once ('../connection/connection.php');
include("language.php");
	$sql = "SELECT * FROM setting where setting_id='1'";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) 
	{
		$setting_id=$row['setting_id'];
		$setting_name=$row['setting_name'];
		$setting_logo=$row['setting_logo'];
		$setting_address=$row['setting_address'];
		$setting_city=$row['setting_city'];
		$setting_country=$row['setting_country'];
		$setting_phone=$row['setting_phone'];
		$setting_fax=$row['setting_fax'];
		$setting_web=$row['setting_web'];
		$setting_currency=$row['setting_currency'];
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
		<title><?php echo $lang['CompanyInfo'];?></title>

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
						<h4><?php echo $lang['CompanyInfo'];?></h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="index.php"><?php echo $lang['Dashboard'];?></a></li>                            						
							<li class="breadcrumb-item active"><?php echo $lang['CompanyInfo'];?></li>
						</ol>
						<div class="box box-block bg-white">
                        	<div id="error"></div>
							<h5><?php echo $lang['CompanyInfo'];?></h5>
							<p class="font-90 text-muted mb-1"><?php echo $lang['usethisformtoeditcompanyinfo'];?> .</p>
							<form class="form-material material-primary" id="editsetting">
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Name'];?></label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="setting_name" name="setting_name" placeholder="<?php echo $lang['Name'];?>" value="<?php if(isset($setting_name)) echo $setting_name;?>" required>
									</div>
								</div>
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Logo'];?></label>
									<div class="col-sm-6">
										<img src="img/logo/<?php if(isset($setting_logo)) echo $setting_logo;?>" class="logo">
                                        <h6>Please upload ( 211 X 75 ) logo.</h6>
									</div>
								</div>
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Change'];?> <?php echo $lang['Logo'];?></label>
									<div class="col-sm-10">
										<input name="userfile" id="userfile" type="file" value=""> 
										<input type="hidden" class="form-control" id="setting_id" name="setting_id" value="<?php if(isset($setting_id)) echo $setting_id;?>" >
                                    
                                    </div>
								</div>
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Currency'];?></label>									
                                    <div class="col-sm-6">
										<select id="setting_currency" name="setting_currency" value="" class="form-control" data-plugin="select2">
                                        <option value=""><?php echo $lang['Select'];?> <?php echo $lang['Currency'];?></option>
                                        <option <?php if(isset($setting_currency) && ($setting_currency=='₱')) echo "selected";?> value="₱">₱</option>
                                        <option <?php if(isset($setting_currency) && ($setting_currency=='$')) echo "selected";?> value="$">$</option>
                                        <option <?php if(isset($setting_currency) && ($setting_currency=='£')) echo "selected";?> value="£">£</option>
                                        <option <?php if(isset($setting_currency) && ($setting_currency=='€')) echo "selected";?> value="€">€</option>
                                        <option <?php if(isset($setting_currency) && ($setting_currency=='¥')) echo "selected";?> value="¥">¥</option>                                        
                                        <option <?php if(isset($setting_currency) && ($setting_currency=='₤')) echo "selected";?> value="₤">₤</option>
                                        <option <?php if(isset($setting_currency) && ($setting_currency=='Bs')) echo "selected";?> value="Bs">Bs</option>	
                                        <option <?php if(isset($setting_currency) && ($setting_currency=='Rs')) echo "selected";?> value="Rs">Rs</option> 
                                        <option <?php if(isset($setting_currency) && ($setting_currency=='Rp')) echo "selected";?> value="Rp">Rp</option>                                       
                                        <option <?php if(isset($setting_currency) && ($setting_currency=='&65020;')) echo "selected";?> value="&#65020;">&#65020;</option>										
										</select>
									</div>
								</div>  
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Address'];?></label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="setting_address" name="setting_address" placeholder="<?php echo $lang['Address'];?>" value="<?php if(isset($setting_address)) echo $setting_address;?>" >
									</div>
								</div>
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['City'];?></label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="setting_city" name="setting_city" placeholder="<?php echo $lang['City'];?>" value="<?php if(isset($setting_city)) echo $setting_city;?>" >
									</div>
								</div>
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Country'];?></label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="setting_country" name="setting_country" placeholder="<?php echo $lang['Country'];?>" value="<?php if(isset($setting_country)) echo $setting_country;?>" >
									</div>
								</div>
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Phone'];?></label>
									<div class="col-sm-10">
										<input type="tel" class="form-control" id="setting_phone" name="setting_phone" placeholder="<?php echo $lang['Phone'];?>" value="<?php if(isset($setting_phone)) echo $setting_phone;?>" >
									</div>
								</div>
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Fax'];?></label>
									<div class="col-sm-10">
										<input type="tel" class="form-control" id="setting_fax" name="setting_fax" placeholder="<?php echo $lang['Fax'];?>" value="<?php if(isset($setting_fax)) echo $setting_fax;?>" >
									</div>
								</div> 
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Website'];?></label>
									<div class="col-sm-10">
										<input type="tel" class="form-control" id="setting_web" name="setting_web" placeholder="<?php echo $lang['Website'];?>" value="<?php if(isset($setting_web)) echo $setting_web;?>" >
									</div>
								</div>                                                             
                                <div class="form-group row">
									<div class="offset-sm-2 col-sm-10">
										<button type="submit" class="btn btn-primary" id="btn-submit" value="Update Setting" ><?php echo $lang['Update'];?> <?php echo $lang['Setting'];?></button>                                     
                                        
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
			$('#editsetting').on('submit', function(e) {
			
						NProgress.start();		
						
						e.preventDefault();
			
					$.ajax({			
							url : 'modal/edit_settingModel.php', 
							type: "POST",
							data:  new FormData(this),
							contentType: false,
							cache: false,
							processData:false,                
						
						//alert(data);
						success :  function (data)
						{					
						//alert(data.status);
							if(data.status=='error'){
			
								$("#error").fadeIn(1000, function(){
									$("#error").html('<div class="alert alert-danger"> &nbsp; Sorry try again!</div>');
			
									$("#btn-submit").html(' &nbsp; Try Again');
								});
							}
							else if(data.status=='image-empty'){
			
								$("#error").fadeIn(1000, function(){
									$("#error").html('<div class="alert alert-danger"> &nbsp; Please Upload the image.</div>');
			
									$("#btn-submit").html(' &nbsp; Try Again');
								});
							}else if(data.status=='image-error'){
			
								$("#error").fadeIn(1000, function(){
									$("#error").html('<div class="alert alert-danger"> &nbsp; Possible file upload attack!.</div>');
			
									$("#btn-submit").html(' &nbsp; Try Again');
								});
							}else if(data.status=='image-ext'){
			
								$("#error").fadeIn(1000, function(){
									$("#error").html('<div class="alert alert-danger"> &nbsp; Please file upload only jpeg, jpg, png, gif, bmp image.</div>');
			
									$("#btn-submit").html(' &nbsp; Try Again');
								});
							}
							else if(data.status=='query-error'){
			
								$("#error").fadeIn(1000, function(){
									$("#error").html('<div class="alert alert-danger"> &nbsp; invalid data insertion.</div>');
			
									$("#btn-submit").html(' &nbsp; Try Again');
								});
							}
							else if(data.status=='successfully')
							{
																									
									toastr.options = {
									positionClass: 'toast-top-right'
									};
									toastr.success('Success!');
									NProgress.done();									
									setTimeout('$("#editsetting").fadeOut(500, function(){ window.location = "company-info.php" }); ',1000);
				   
							  }
						   
						}
       			});
			  
			  
				
			});



</script>
	</body>

</html>