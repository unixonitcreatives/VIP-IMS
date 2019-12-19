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

if((!empty($_POST['exp_order_id']))) {


	$expense_type_id=strip_tags($_POST['expense_type_id']);	
	$exp_order_id=strip_tags($_POST['exp_order_id']);	
	$exp_payment_detail_date=strip_tags($_POST['exp_payment_detail_date']);	
	$grand_total_price     = strip_tags($_POST['grand_total_price']);
	$paid_amount=strip_tags($_POST['paid_amount']);	
	$exp_invoice_number     = strip_tags($_POST['exp_invoice_number']);
	$due_amount     = strip_tags($_POST['due_amount']);
	$exp_invoice_payment_id     = strip_tags($_POST['exp_invoice_payment_id']);
	$exp_invoice_items_id     = $_POST['exp_invoice_items_id'];
	$remainingamount     = $_POST['remainingamount']+$paid_amount;
	if($due_amount==0) { $payment_status=0; } else { $payment_status=1; }
	
	$exp_items_lines=sizeof($_POST['product_name']);	
		
	for($x = 0; $x < $exp_items_lines; $x++) {
		
	$exp_inv_line_sql = "UPDATE exp_invoice_line_items SET exp_product_name='".strip_tags($_POST['product_name'][$x])."', 
	exp_product_quantity='".strip_tags($_POST['product_quantity'][$x])."', exp_product_rate='".strip_tags($_POST['product_rate'][$x])."', 
	exp_total_price='".strip_tags($_POST['total_price'][$x])."' where exp_invoice_items_id='".strip_tags($_POST['exp_invoice_items_id'][$x])."'";  
	$exp_inv_line_sqlq=$conn->query($exp_inv_line_sql);	
		
	}
	
	
	$update_invoice_table = "UPDATE  exp_invoice_payment_detail  SET `exp_grand_total_price` = '$grand_total_price', `exp_paid_amount` = '$remainingamount',`exp_due_amount` = '$due_amount',`expense_type_id` = '$expense_type_id', exp_payment_detail_date='$exp_payment_detail_date', exp_payment_detail_status='$payment_status' where exp_invoice_payment_id='$exp_invoice_payment_id'";    
	$conn->query($update_invoice_table);
	
 	$response['status']= 'successfully';
	
}else{	
		
	$response['status']= 'error';
	
	}



echo json_encode($response);
?>