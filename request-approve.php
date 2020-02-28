<?php
	session_start();
require_once 'config.php';
  $Admin_auth = 1;
  $Stock_auth = 1;
  $Area_Center_auth = 0;
 include('includes/user_auth.php');
?>

<?php


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

	$qry = "SELECT * FROM area_center WHERE username ='$sr_created_by'";
	if($result = mysqli_query($link, $qry)){
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				$ac_id = $row['id'];
				$ac_name = $row['name'];
				$ac_username = $row['username'];
				$ac_usertype = $row['usertype'];
				$ac_warehouse = $row['warehouse'];
				$ac_created_by = $row['created_by'];
				$ac_date = $row['created_at'];
				// echo "<script>alert('$ac_username');</script>";
			}

		}

	}

	$sql_check = "SELECT * FROM stocks WHERE product ='$sr_product' AND warehouse = 'MAIN'";
    if($result = mysqli_query($link, $sql_check)){
      if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
            $stocks_qty = $row['quantity'];
            $stocks_product = $row['product'];
                  if($stocks_qty < $sr_qty){
                    echo "<script>alert('Insufficient Stock in MAIN Warehouse');
                    window.location.href = 'stock-request-manage.php';</script>";
                    die();
                  } else {
                    //Proceed
                  }
            } 
      } else {
        echo "<script>alert('Stock doesnt exist in Warehouse MAIN');
        window.location.href = 'stock-request-manage.php';</script>"; 
        die();
      }

    }
    
	$account = $_SESSION["username"];//session name
	$IDtype = "TRTX";
	$m = date('m');
	$y = date('y');
	$d = date('d');

	$qryID = mysqli_query($link,"SELECT MAX(transferId) FROM `transfertb` "); // Get the latest ID
	$resulta = mysqli_fetch_array($qryID);
	$newID = $resulta['MAX(transferId)'] + 1; //Get the latest ID then Add 1
	$custID = str_pad($newID, 8, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
	$tranxid = $IDtype.$custID; //Prepare custom ID

	$query = "
	INSERT INTO `transfertb` (trans_Id, warehouse_origin, warehouse_dest, product, quantity, trans_date, refNum, remarks, created_by, created_at)
	VALUES ('$tranxid', 'MAIN', '$sr_warehouse', '$sr_product', '$sr_qty', '$sr_date', 'Transfer Request', '$sr_remarks','$account', '$date')"; //Prepare insert query
	$result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query

	if($result){ 

		$sql_check = "SELECT * FROM stocks WHERE product ='$sr_product' AND warehouse ='$sr_warehouse'";
        if($result = mysqli_query($link, $sql_check)){ //CHECK KUNG EXISTING UNG PRODUCT SA WAREHOUSE

			if(mysqli_num_rows($result) > 0){ //KAPAG EXISTING UNG PRODUCT SA WAREHOUSE, ADD LANG NG QUANTITY
				//echo "<script>alert('Existing')</script>";
				$query = "UPDATE `stocks` SET quantity = quantity + '$sr_qty' WHERE product ='$sr_product' AND warehouse ='$sr_warehouse'"; //Prepare insert query
				$result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query
				
				if($result){
					$query = "UPDATE `stocks` SET quantity = quantity - '$sr_qty' WHERE product ='$sr_product' AND warehouse ='MAIN'"; //Prepare insert query
					$result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query
					if($result){   
					$info = $_SESSION['username']."  approve stock request";
					$info2 = "Details: ".$sr_product.", ".$sr_qty." pcs on: " .$sr_warehouse. " from: MAIN";
					$alertlogsuccess = $sr_product.", ".$sr_qty." pcs: has been transfered succesfully!";
					include "logs.php";

					$query = "UPDATE `stock_request` SET status = 'Approved'  WHERE id ='$get_id'"; //Prepare insert query
					$result = mysqli_query($link, $query) or die(mysqli_error($link));

					echo "<script>window.location.href='stock-request-manage.php'</script>"; 

					} else {
					echo "<script>alert('Failed deducting stocks from warehouse orig')</script>";
					}      
				} else {
				echo "<script>alert('Failed transfering stocks')</script>";
				}

			} else { 
				// echo "<script>alert('Not Existing')</script>";
				$account = $_SESSION["username"];//session name

				$query = "
				INSERT INTO `stocks` (product, warehouse, quantity, status, created_by)
				VALUES ('$sr_product', '$sr_warehouse', '$sr_qty', 'In Stock', '$account')"; //Prepare insert query
				$result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query

				if($result){
					$query = "UPDATE `stocks` SET quantity = quantity - '$sr_qty' WHERE product ='$sr_product' AND warehouse ='$sr_warehouse_orig'"; //Prepare insert query
					$result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query
					if($result){   
					$info = $_SESSION['username']."  approve stock request";
					$info2 = "Details: ".$sr_product.", ".$sr_qty." pcs on: " .$sr_warehouse. " from: MAIN";
					$alertlogsuccess = $sr_product.", ".$sr_qty." pcs: has been created and transfered succesfully!";
					include "logs.php";

					$query = "UPDATE `stock_request` SET status = 'Approved'  WHERE id ='$get_id'"; //Prepare insert query
					$result = mysqli_query($link, $query) or die(mysqli_error($link));

					echo "<script>window.location.href='stock-request-manage.php'</script>";
					} else {
					echo "<script>alert('Failed deducting stocks from warehouse orig')</script>";
					}
				} else {
				echo "<script>alert('Failed adding new stocks')</script>";
				}
				mysqli_close($link);
			}

		} else {
		echo "<script>alert('Failed adding new stock transfer')</script>";
		} 
	}








?>
