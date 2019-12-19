<?php session_start();
if(empty($_SESSION['auth_username'])) { header("Location: ../index.php");}
require_once ('../connection/connection.php');
if(isset($_GET['l']) && !empty($_GET['l'])){
	$loan_contract_id=strip_tags(trim($_GET['l']));
	$sql = "SELECT SUM(amount_of_payment) as return_amount,ln.*,lc.* from loan_contract as lc , loan_payments as lp,loan_needer as ln WHERE lc.loan_contract_id =lp.loan_contract_id and ln.loaner_id=lc.loaner_id and lc.loan_contract_id='$loan_contract_id' group by lp.loan_contract_id";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) 
	{	
		$loaner_name=$row['loaner_name'];
		$loan_amount=$row['loan_amount'];		
		$terms_and_conditions=$row['terms_and_conditions'];
		$return_amount=$row['return_amount']; 
		$totalremaining=$row['loan_amount']-$row['return_amount']; 	
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
		<title>Edit Loan</title>

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
						<h4>Edit Loan</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>	
                            <li class="breadcrumb-item"><a href="#">Loan</a></li>						
							<li class="breadcrumb-item active">Edit Loan</li>
						</ol>
						<div class="box box-block bg-white">
                        <div id="error"></div>
							<h5>Edit Loaners</h5>
							<p class="font-90 text-muted mb-1"> use this form to edit loan info.</p>
                            <div class="form-group row">									
									<div class=" offset-sm-2 col-sm-6" id="error"></div>
								</div>  
							<form class="form-material material-primary" id="editloan">
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label">Loaner</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="loaner_name" name="loaner_name" placeholder="loaner_name" value="<?php if(isset($loaner_name)) echo $loaner_name;?>" disabled>
									</div>
								</div>                            
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label">Loan Amount</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="loan_amount" name="loan_amount" placeholder="Loan Amount" value="<?php if(isset($loan_amount)) echo $loan_amount;?>" disabled>
									</div>
								</div>                                
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label">Terms and Conditions</label>
									<div class="col-sm-10">
										<textarea name="terms_and_conditions" class="form-control" id="terms_and_conditions" placeholder="Terms and Conditions" disabled><?php if(isset($terms_and_conditions)) echo $terms_and_conditions;?></textarea>
									</div>
								</div>                                
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label">Total Remaining Amount</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="totalremaining" name="totalremaining" placeholder="Total Remaining Amount" value="<?php if(isset($totalremaining)) echo $totalremaining;?>" disabled>
										<input type="hidden" name="loan_contract_id" id="loan_contract_id" value="<?php if(isset($loan_contract_id)) echo $loan_contract_id;?>" >
                                    </div>
								</div>
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label">Add Recieved Amount</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="amount_of_payment" name="amount_of_payment" placeholder="Add Recieved Amount" >
									</div>
								</div>
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label">Remarks</label>
									<div class="col-sm-10">
										<textarea name="remarks" class="form-control" id="remarks" placeholder="Remarks"></textarea>
									</div>
								</div> 
                                <div class="form-group row">
									<div class="offset-sm-2 col-sm-10">
										<button type="submit" class="btn btn-primary" id="btn-submit" value="Add Loaner" >Update Contract</button>                                     
                                        
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
			  jQuery("#editloan").validate({
			   				
				rules:
			   {
					amount_of_payment: {
					number:true,
					required: true
					}					
					
			   },
				submitHandler: submitForm
			  });
			  
			  
			   function submitForm()
				{
					
					NProgress.start();
					var data = $("#editloan").serialize();
			
					$.ajax({
			
						type : 'POST',
						url  : 'modal/edit_loanModel.php',
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
							//alert(data.status);
							if(data.status==='error'){
			
								$("#error").fadeIn(1000, function(){
									$("#error").html('<div class="alert alert-danger"> &nbsp; Sorry try again!.</div>');
									NProgress.done();
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
									setTimeout('$(".bg-white").fadeOut(700, function(){ window.location = "loans.php" }); ',800);

				   
							  }
						   
						}
					});
					return false;
				}
			  
			  
				
			});



</script>
	</body>

</html>