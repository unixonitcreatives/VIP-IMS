<?php session_start();
if(empty($_SESSION['auth_username'])) { header("Location: ../index.php");}
require_once ('../connection/connection.php');
include("language.php");
if(!empty($_GET['p']) && !empty($_GET['c']) && !empty($_GET['s']) && !empty($_GET['w'])){
	$productid=strip_tags(trim($_GET['p']));
	$c_id=strip_tags(trim($_GET['c']));
	$s_id=strip_tags(trim($_GET['s']));
	$w_id=strip_tags(trim($_GET['w']));
 $dsql = "SELECT prInfo.*,c.*, w.*,s.*, prDetail.* FROM product as prInfo, product_detail as prDetail, categories as c, warehouse as w,
 suppliers as s where  prInfo.product_id=prDetail.p_id and c.cat_id='$c_id' and prInfo.product_id='$productid'
 and w.war_id='$w_id' and s.supplier_id='$s_id'";
 
	$resultd = $conn->query($dsql);
	 while($rowwd = $resultd->fetch_assoc()) {	
	 $p_id = $rowwd['p_id'];
     $s_id= $rowwd['s_id'];
     $c_id= $rowwd['c_id'];
     $w_id= $rowwd['w_id'];
	 $datepicker_mfg_date= $rowwd['datepicker_mfg_date'];
	 $datepicker_exp_date= $rowwd['datepicker_exp_date'];
     $product_quantity= $rowwd['product_quantity'];
     $product_sell_price= $rowwd['product_sell_price'];
     $product_image= $rowwd['product_image'];	 
     $product_supplier_price= $rowwd['product_supplier_price'];
     $product_name= $rowwd['product_name'];
     $product_model= $rowwd['product_model'];
     $product_sku= $rowwd['product_sku'];
     $product_detail= $rowwd['product_detail'];
     $productdetail_id= $rowwd['productdetail_id'];
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
		<title><?php echo $lang['Edit'];?> <?php echo $lang['Products'];?></title>

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
						<h4><?php echo $lang['Edit'];?> <?php echo $lang['Products'];?></h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="index.php"><?php echo $lang['Dashboard'];?></a></li>							
							<li class="breadcrumb-item active"><?php echo $lang['Edit'];?> <?php echo $lang['Products'];?></li>
						</ol>
						<div class="box box-block bg-white">
							<h5><?php echo $lang['Edit'];?> <?php echo $lang['Products'];?></h5>
							<p class="font-90 text-muted mb-1"> <?php echo $lang['usethisformtoeditproducttodatabase'];?>.</p>
							<form class="form-material material-primary add-product" id="editproduct" enctype="multipart/form-data">
                            <div id="error"></div>
							<div class="row">
								<div class="col-md-6">
                                <div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Products'];?> <i class="text-danger">*</i></label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="product_name" name="product_name" value="<?php if(isset($product_name)){ echo $product_name;}?>" placeholder="Product" autocomplete="off" required>
									</div>
								</div>
                                <?php 
								$c = "SELECT * FROM categories";
								$resultc = $conn->query($c); ?>
                                <div class="form-group row">
									<label for="category_id" class="col-sm-2 form-control-label"><?php echo $lang['Categories'];?> </label>
									<div class="col-sm-10">
										<select id="category_id" name="category_id" class="form-control" data-plugin="select2">
                                        <option value=""><?php echo $lang['SelectCategory'];?></option>
                                        <?php while($rowc = $resultc->fetch_assoc()) { ?>
											<option <?php if($c_id==$rowc['cat_id']){ echo "selected";}?>  value="<?php echo $rowc['cat_id'];?>"><?php echo $rowc['cat_name'];?></option>
										<?php } ?>	
										</select>
									</div>
								</div>
                                <?php 
								$w = "SELECT * FROM warehouse";
								$resultw = $conn->query($w); ?>
                                <div class="form-group row">
									<label for="warehouse_id" class="col-sm-2 form-control-label"><?php echo $lang['Warehouse'];?> </label>
									<div class="col-sm-10">
										<select id="warehouse_id" name="warehouse_id"  class="form-control" data-plugin="select2">
                                        	<option value=""><?php echo $lang['SelectWarehouse'];?></option>
											<?php while($roww = $resultw->fetch_assoc()) { ?>
											<option <?php if($w_id==$roww['war_id']){ echo "selected";}?> value="<?php echo $roww['war_id'];?>"><?php echo $roww['war_name'];?></option>
										<?php } ?>
										</select>
									</div>
								</div>
                                <div class="form-group row">
                                    <label for="datepicker_invoice_date" class="col-sm-2 col-form-label">Mfg.<?php echo $lang['Date'];?><i class="text-danger">*</i></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" autocomplete="off" value="<?php if(isset($datepicker_mfg_date)){ echo $datepicker_mfg_date;}?>" id="datepicker_mfg_date" name="datepicker_mfg_date" placeholder="yyyy-mm-dd">
                                        
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="datepicker_invoice_date" class="col-sm-2 col-form-label">Exp.<?php echo $lang['Date'];?><i class="text-danger">*</i></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" autocomplete="off" value="<?php if(isset($datepicker_exp_date)){ echo $datepicker_exp_date;}?>" id="datepicker_exp_date" name="datepicker_exp_date" placeholder="yyyy-mm-dd">
                                        
                                    </div>
                                </div>                               
                                </div>
                                <div class="col-md-6"> 
                                                               
                                    <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Image'];?></label>                                            
                                            <div class="col-sm-8">
                                             <input type="file" name="userfile">
                                             
                                             </div>
                                             <div class="col-sm-4">
                                             <img src="uploads/<?php if(isset($product_image)){echo $product_image;}?>" class="box-48"> 
                                          </div>
                                    </div>                               
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label"><?php echo $lang['Detail'];?></label>
                                        <div class="col-sm-10">
                                         <textarea id="detail" name="detail" class="form-control" maxlength="300" rows="5" placeholder="This textarea has a limit of 300 chars."><?php if(isset($product_detail)){ echo $product_detail;}?></textarea>
                                      </div>
                                    </div>
                                </div>
                             </div>
                             <div class="row">
								<div class="col-md-12">
                                 
                                <table class="table table-bordered mb-0">
										<thead>
											<tr>
												<th><?php echo $lang['Quantity'];?> <i class="text-danger">*</i></th>
												<th><?php echo $lang['SellPrice'];?> <i class="text-danger">*</i></th>
												<th><?php echo $lang['SupplierPrice'];?> <i class="text-danger">*</i></th>
												<th><?php echo $lang['Model'];?> <i class="text-danger">*</i></th>
                                                <th>SKU <i class="text-danger">*</i></th>
												<th><?php echo $lang['Suppliers'];?> <i class="text-danger">*</i></th>

											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
                                                <div class="form-group row">                                               
                                                <div class="col-sm-10">
                                                <input type="text" class="form-control" id="product_qty" name="product_qty" value="<?php if(isset($product_quantity)){ echo $product_quantity;}?>" autocomplete="off" required>
                                                </div>  <input type="hidden" name="p_id" value="<?php if(isset($p_id)){echo $p_id;}?>" >
                                                <input type="hidden" name="productdetail_id" value="<?php if(isset($productdetail_id)){echo $productdetail_id;}?>" >
                                           		 </div>
                                          		</td>
												<td>
                                                <div class="form-group row">                                               
                                                <div class="col-sm-10">
                                                <input type="text" class="form-control" id="sell_price" name="sell_price" autocomplete="off" value="<?php if(isset($product_sell_price)){ echo $product_sell_price;}?>" required>
                                                </div>
                                           		 </div> 
                                          		</td>
												<td>
                                                <div class="form-group row">                                               
                                                <div class="col-sm-10">
                                                <input type="text" class="form-control" id="supplier_price" name="supplier_price" autocomplete="off" value="<?php if(isset($product_supplier_price)){ echo $product_supplier_price;}?>" required>
                                                </div>
                                           		 </div>
                                          		</td>
												<td>
                                                <div class="form-group row">                                               
                                                <div class="col-sm-10">
                                                <input type="text" class="form-control" id="model" name="model" autocomplete="off" value="<?php if(isset($product_model)){ echo $product_model;}?>" >
                                                </div>
                                           		 </div>
                                          		</td>
                                                <td>
                                                <div class="form-group row">                                               
                                                <div class="col-sm-10">
                                                <input type="text" class="form-control" id="sku" name="sku" autocomplete="off" value="<?php if(isset($product_sku)){ echo $product_sku;}?>" >
                                                </div>
                                           		 </div>
                                          		</td>
                                                <td>
                                                <?php if(isset($s_id)){
													$s = "SELECT * FROM suppliers";
													$results = $conn->query($s); ?>
                                                <select id="supplier_id" name="supplier_id" class="form-control" data-plugin="select2">                                                	
                                                    <option value=""><?php echo $lang['SelectSupplier'];?></option>
													<?php while($rows = $results->fetch_assoc()) { ?>
                                                    <option <?php if($s_id==$rows['supplier_id']){ echo "selected";}?> value="<?php echo $rows['supplier_id'];?>"><?php echo $rows['supplier_name'];?></option>
                                                <?php } ?>
                                                </select>
                                                <?php } ?>
                                          		</td>
											</tr>											
										</tbody>
									</table>
                                </div>
                             </div> 
                             <div class="row box-block">
								<div class="col-md-12">  
                                     <div class="form-group row">
                                            <div class="col-sm-11">
                                                <button type="submit" class="btn btn-primary" id="btn-submit" value="Edit Product" ><?php echo $lang['Edit'];?> <?php echo $lang['Products'];?></button>
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
       
        <script>
		$(document).ready(function(){
			$('#datepicker_mfg_date').datepicker({
			format: "yyyy-mm-dd",
			autoclose: true,
			todayHighlight: true
			});
		});	
		$(document).ready(function(){
			$('#datepicker_exp_date').datepicker({
			format: "yyyy-mm-dd",
			autoclose: true,
			todayHighlight: true
			});
		});
			jQuery(document).ready(function(e){
				
			  
			  // edit Product Form
			  jQuery("#editproduct").validate({
			   				
				rules:
			   {
					product_name: {
					required: true
					},
					
					category_id: {
					required: true					
					 },
					 
					 warehouse_id: {
					required: true					
					 },
					 
					 product_qty: {
					digits:true,
					required: true					
					 },
					 
					 sell_price: {
					number:true,
					required: true					
					 },
					 
					 supplier_price: {
					number:true,	 
					required: true					
					 },
					 
					 model: {
					required: true					
					 },
					 
					 sku: {
					required: true					
					 },
					 
					 supplier_id: {
					required: true					
					 }
			   } 
				
			  });
			  
			  $('#editproduct').on('submit', function(e) {

					e.preventDefault();
					NProgress.start();					
			
					$.ajax({			
						
						url  : 'modal/edit_productModel.php',
						type: "POST",
				   data:  new FormData(this),
				   contentType: false,
						 cache: false,
				   processData:false,
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
									$("#error").html('<div class="alert alert-danger"> &nbsp; Sorry try again!</div>');
									NProgress.done();
									$("#btn-submit").html(' &nbsp; Try Again');
								});
							}
							else if(data.status==='image-error'){
			
								$("#error").fadeIn(1000, function(){
									$("#error").html('<div class="alert alert-danger"> &nbsp; Possible file upload attack!.</div>');
									NProgress.done();
									$("#btn-submit").html(' &nbsp; Try Again');
								});
							}else if(data.status==='image-ext'){
			
								$("#error").fadeIn(1000, function(){
									$("#error").html('<div class="alert alert-danger"> &nbsp; Please file upload only jpeg, jpg, png, gif, bmp image.</div>');
										NProgress.done();
									$("#btn-submit").html(' &nbsp; Try Again');
								});
							}
							else if(data.status==='query-error'){
			
								$("#error").fadeIn(1000, function(){
									$("#error").html('<div class="alert alert-danger"> &nbsp; invalid data insertion.</div>');
									NProgress.done();
									$("#btn-submit").html(' &nbsp; Try Again');
								});
							}
							else if(data.status==='successfully')
							{
								
									$("#btn-submit").html('Edit Product');									
									toastr.options = {
									positionClass: 'toast-top-right'
									};
									toastr.success('Success!');
									NProgress.done();
									setTimeout('$("#editproduct").fadeOut(500, function(){ window.location = "products.php" }); ',2000);
													   
							  }
						   
						}
					});
				
			   });			  
				
			});

</script>
	</body>

</html>