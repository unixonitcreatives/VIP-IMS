<?php session_start();
if(empty($_SESSION['auth_username'])) { header("Location: ../index.php");}
require_once ('../connection/connection.php');
include("language.php");
if(isset($_GET['s']) && !empty(trim($_GET['s']))){
	$s=strip_tags(trim($_GET['s']));
	if($s==1){
		header("location: staff.php?d=n");
	}else{
		$del = "DELETE FROM auth WHERE auth_id='$s'";
		if ($conn->query($del) === TRUE) {
			header("location: staff.php?d=del");		
		} else {
			header("location: staff.php?d=n");		
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
		<title><?php echo $lang['Staff'];?></title>

		<!-- adaptinventory CSS -->
		<link rel="stylesheet" href="../adaptinventory/bootstrap4/css/bootstrap.min.css">
		<link rel="stylesheet" href="../adaptinventory/themify-icons/themify-icons.css">
		<link rel="stylesheet" href="../adaptinventory/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../adaptinventory/animate.css/animate.min.css">
		<link rel="stylesheet" href="../adaptinventory/jscrollpane/jquery.jscrollpane.css">
		<link rel="stylesheet" href="../adaptinventory/waves/waves.min.css">
		<link rel="stylesheet" href="../adaptinventory/switchery/dist/switchery.min.css">
		<link rel="stylesheet" href="../adaptinventory/DataTables/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="../adaptinventory/DataTables/Responsive/css/responsive.bootstrap4.min.css">
		<link rel="stylesheet" href="../adaptinventory/DataTables/Buttons/css/buttons.dataTables.min.css">
		<link rel="stylesheet" href="../adaptinventory/DataTables/Buttons/css/buttons.bootstrap4.min.css">
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
						<h4><?php echo $lang['StaffList'];?></h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="index.php"><?php echo $lang['Dashboard'];?></a></li>							
							<li class="breadcrumb-item active"><?php echo $lang['StaffList'];?></li>
						</ol>
						<div class="box box-block bg-white">
							<h5 class="mb-1"><?php echo $lang['ExportingStaffData'];?></h5>
							<table class="table table-striped table-bordered dataTable" id="table-2">
								<thead>
									<tr>
										<th>No</th>
                                        <th><?php echo $lang['UserName'];?></th>
										<th><?php echo $lang['FullName'];?></th>										
										<th><?php echo $lang['UserType'].'/'.$lang['Position'];?></th>
										<th><?php echo $lang['Option'];?></th>
									</tr>
								</thead>
								<tbody>
                                <?php 
								$sql = "SELECT a.*, u.* from users_type as u, auth as a where a.user_type_id =u.user_type_id ";
								$result = $conn->query($sql);
								
								if ($result->num_rows > 0) 
								{
									$i=1;
									while($row = $result->fetch_assoc()) 
									{ ?>		
									<tr>
										<td><?php echo $i;?></td>
										<td><?php echo $row['auth_username'];?></td>
										<td><?php echo $row['full_name'];?></td>										
                                        <td><?php echo $row['user_type'];?></td>
										<td> 
                                        <a class="btn btn-secondary btn-sm" href="edit-staff.php?s=<?php echo $row['auth_id'];?>" title="Edit"><i class="ti-pencil mr-0-5"></i><?php echo $lang['Edit'];?></a> 
                                        <a class="btn btn-danger btn-sm" href="staff.php?s=<?php echo $row['auth_id'];?>" title="Delete"><i class="ti-trash mr-0-5"></i><?php echo $lang['Delete'];?></a>
                                        </td>
									</tr>
                                  <?php $i++; }
								} ?>																	
								</tbody>
								<tfoot>
									<tr>
										<th>No</th>
                                        <th><?php echo $lang['UserName'];?></th>
										<th><?php echo $lang['FullName'];?></th>										
										<th><?php echo $lang['UserType'].'/'.$lang['Position'];?></th>
										<th><?php echo $lang['Option'];?></th>
									</tr>
								</tfoot>
							</table>                           
                            
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
		<script type="text/javascript" src="../adaptinventory/DataTables/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/js/dataTables.bootstrap4.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/Responsive/js/dataTables.responsive.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/Responsive/js/responsive.bootstrap4.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/Buttons/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/Buttons/js/buttons.bootstrap4.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/JSZip/jszip.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/pdfmake/build/pdfmake.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/pdfmake/build/vfs_fonts.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/Buttons/js/buttons.html5.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/Buttons/js/buttons.print.min.js"></script>
		<script type="text/javascript" src="../adaptinventory/DataTables/Buttons/js/buttons.colVis.min.js"></script>
        <script type="text/javascript" src="../adaptinventory/toastr/toastr.min.js"></script>
		<script type="text/javascript" src="modal/js/supplier_info.js"></script>
		<!-- Neptune JS -->
		<script type="text/javascript" src="js/app.js"></script>
		<script type="text/javascript" src="js/demo.js"></script>
		<script type="text/javascript" src="js/tables-datatable.js"></script>
        <?php if(isset($_GET['d']) && $_GET['d']=='del'){ ?>
        <script type="text/javascript">
			$(document).ready(function(){			
			toastr.options = {
			positionClass: 'toast-top-right'
			};
			toastr.error('Record deleted successfully!');
			
			});	
		</script>
      <?php } 
	  if(isset($_GET['d']) && $_GET['d']=='n'){ ?>
        <script type="text/javascript">
			$(document).ready(function(){			
			toastr.options = {
			positionClass: 'toast-top-right'
			};
			toastr.error('Error deleting record!');
			
			});	
		</script>
        <?php } ?>
	</body>

</html>