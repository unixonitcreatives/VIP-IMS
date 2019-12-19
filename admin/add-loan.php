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
		<title><?php echo $lang['AddLoan'];?></title>

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
        <link rel="stylesheet" href="../adaptinventory/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="../adaptinventory/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
		<link rel="stylesheet" href="../adaptinventory/multi-select/css/multi-select.css">
		<link rel="stylesheet" href="../adaptinventory/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
        <link rel="stylesheet" href="../adaptinventory/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
		<link rel="stylesheet" href="../adaptinventory/bootstrap-daterangepicker/daterangepicker.css">
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
						<h4><?php echo $lang['AddLoan'];?></h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="index.php"><?php echo $lang['Dashboard'];?></a></li>							
							<li class="breadcrumb-item active"><?php echo $lang['AddLoan'];?></li>
						</ol>
						<div class="box box-block bg-white">
							<h5><?php echo $lang['AddLoan'];?></h5>
							<p class="font-90 text-muted mb-1"> <?php echo $lang['usethisformtoaddloantodatabase'];?>.</p>
							<form class="form-material material-primary add-product" id="addloan">
							<div class="row">
								<div class="col-md-12">  
                                <div class="form-group row">									
									<div class=" offset-sm-2 col-sm-6" id="error"></div>
								</div>             
                                                              
                                <?php 
								$c = "SELECT * FROM loan_needer";
								$resultc = $conn->query($c); ?>
                                <div class="form-group row">
									<label for="loaner_id" class="col-sm-2 form-control-label"><?php echo $lang['Name'];?></label>
									<div class="col-sm-6">
										<select id="loaner_id" name="loaner_id" class="form-control" data-plugin="select2" >
                                        <option value=""><?php echo $lang['Select'];?></option>
                                        <?php while($rowc = $resultc->fetch_assoc()) { ?>
											<option value="<?php echo $rowc['loaner_id'];?>"><?php echo $rowc['loaner_name'];?></option>
										<?php } ?>	
										</select>
									</div>
								</div>
                                <div class="form-group row">
									<label for="loan_amount" class="col-sm-2 col-form-label"><?php echo $lang['LoanAmount'];?></label>
									<div class="col-sm-6">
										<input type="text" class="form-control" id="loan_amount" name="loan_amount" autocomplete="off" placeholder="<?php echo $lang['LoanAmount'];?>" required>
									</div>
								</div>
                                 <div class="form-group row">
										<label for="datepicker_start_date" class="col-sm-2 col-form-label"><?php echo $lang['LoanContractDate'];?></label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="datepicker_start_date" name="datepicker_start_date" placeholder="mm/dd/yyyy">
											<span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
										</div>
	                    			</div>
                                    <div class="form-group row">
										<label for="datepicker_end_date" class="col-sm-2 col-form-label"><?php echo $lang['LoanContractEnd-Date'];?></label>
										<div class=" col-sm-6">
											<input type="text" class="form-control" id="datepicker_end_date" name="datepicker_end_date" placeholder="mm/dd/yyyy">
											<span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
										</div>
	                    			</div>
                                <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Detail'];?></label>
                                        <div class="col-sm-6">
                                         <textarea id="detail" name="detail" class="form-control" rows="5" placeholder="Detail / Terms and Conditions"></textarea>
                                      </div>
                                    </div>
                                <div class="form-group row">
                                    <div class="offset-sm-5 col-sm-12">
                                        <button type="submit" class="btn btn-primary" id="btn-submit" ><?php echo $lang['AddLoan'];?></button>
                                    </div>
                                 </div>                              
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
    	 <script type="text/javascript" src="../adaptinventory/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/clockpicker/dist/jquery-clockpicker.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
		
		
		<!-- Neptune JS -->
        
		<script type="text/javascript" src="js/app.js"></script>
		<script type="text/javascript" src="js/demo.js"></script>
		<script type="text/javascript" src="js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="js/ui-notifications.js"></script>
       
        <script type="text/javascript">
			$(document).ready(function(){
				$('#datepicker_start_date').datepicker({
				format: "yyyy-mm-dd",
				autoclose: true,
				todayHighlight: true
				});
				
				$('#datepicker_end_date').datepicker({
				format: "yyyy-mm-dd",
				autoclose: true,
				todayHighlight: true
				});			
			});
		
			jQuery(document).ready(function(){
				  
			  
			  jQuery("#addloan").validate({
			   				
				rules:
			   {
				   loaner_id: {
					required: true					
					},
					loan_amount: {
					number:true,	
					required: true					
					},
					datepicker_start_date: {
					date:true,	
					required: true
					},
					datepicker_end_date: {
					date:true,	
					required: true
					}
			   },
				submitHandler: submitForm
			  });
			  
			  
			   function submitForm()
				{
					
					NProgress.start();
					var data = $("#addloan").serialize();
			
					$.ajax({
			
						type : 'POST',
						url  : 'modal/add_loanModel.php',
						data : data,
						dataType : 'json',
						
						beforeSend: function()
						{
							//alert(data);
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
								
									$("#btn-submit").html('Add Loan');									
									toastr.options = {
									positionClass: 'toast-top-right'
									};
									toastr.success('Success!');
									NProgress.done();
									$("#addloan").trigger('reset');

				   
							  }
						   
						}
					});
					return false;
				}
			  
			  
				
			});



</script>
	</body>

</html>