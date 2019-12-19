<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Adapt Inventory License
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.adaptinventory.com/license.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to adaptinventory@gmail.com so we can send you a copy immediately.
 *
 * @author   Adapt Inventory
 * @author-email  adaptinventory@gmail.com
 * @copyright  Copyright © adaptinventory.com. All Rights Reserved
 */
session_start();
header('Content-type: application/json');
require_once ('../../connection/connection.php');
$response = array();

if((!empty($_POST['inv']))) {


	$inv=strip_tags($_POST['inv']);	
	$payment_detail_date=strip_tags($_POST['payment_detail_date']);	
	$paid_amount     = strip_tags($_POST['remainingamount']);
	$due_amount     = strip_tags($_POST['due_amount']);
	//$remainingamount     = ;
	if($due_amount==0) { $payment_status=0; } else { $payment_status=1; }
	
	$update_invoice_table = "UPDATE  invoice_payment_detail  SET `paid_amount` = `paid_amount` + '$paid_amount',`due_amount` = '$due_amount', payment_detail_date='$payment_detail_date', payment_detail_status='$payment_status' where invoice_no_id='$inv'";    
	$conn->query($update_invoice_table);
 	
	$response['status'] = 'successfully';		

}else{	
		
	$response['status']= 'error';
	
	}



echo json_encode($response);
?>