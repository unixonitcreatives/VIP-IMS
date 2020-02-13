<?php
session_start();
require_once 'config.php';

$username = $usertype ='';
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

$get_id = $_GET['id'];


$qry = "SELECT * FROM stock_request WHERE id ='$get_id'";
if($result = mysqli_query($link, $qry)){
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			$sr_id = $row['id'];
			$sr_product = $row['product'];
			$sr_qty = $row['qty'];
			$sr_warehouse = $row['warehouse'];
			$sr_status = $row['status'];
			$sr_remarks = $row['remarks'];
			$sr_created_by = $row['created_by'];
			$sr_date = $row['created_at'];
			//echo "<script>alert('$sr_product');</script>";
		}
	}
}

if($sr_status=='Approved'){
		echo "<script>alert('This request is already approved.'); 
		window.location.href='stock-request-manage.php';</script>"; 
		die();
	} elseif ($sr_status=='Declined'){
		echo "<script>alert('This request has been declined previously.'); 
		window.location.href='stock-request-manage.php';</script>"; 
		die();
	} elseif ($sr_status=='Cancelled') {
		echo "<script>alert('This request has been cancelled by requestor.'); 
		window.location.href='stock-request-manage.php';</script>"; 
		die();
	} else {	
		//Proceed
	}

$query = "UPDATE `stock_request` SET status = 'Declined'  WHERE id ='$get_id'"; //Prepare insert query
$result = mysqli_query($link, $query) or die(mysqli_error($link));

$info = $_SESSION['username']."  declined stock request";
$info2 = "Details: ".$sr_product.", ".$sr_qty." pcs on: " .$sr_warehouse;
$alertlogsuccess = "Request has been declined";
include "logs.php";
echo "<script>window.location.href='stock-request-manage.php'</script>"; 

?>