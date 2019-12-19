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

if((!empty($_POST['supplier_id'])) || (!empty($_POST['auth_id'])) && (!empty($_POST['product_name'][0]))) {

 	$supplier_id      = strip_tags($_POST['supplier_id']);
	$warehouse_id      = strip_tags($_POST['warehouse_id']);	
	$auth_id     = strip_tags($_POST['auth_id']);
	$datepicker_invoice_exp      = strip_tags($_POST['datepicker_invoice_exp']);	
			
	$exp_order_sql = "INSERT INTO suppliers_orders (auth_id, exp_order_date) VALUES ('$auth_id', '$datepicker_invoice_exp')";  
	$exp_order_sqlq=$conn->query($exp_order_sql);
	$exp_order_last_id=$conn->insert_id;
	
	$exp_invoice_sql = "INSERT INTO sup_invoices (exp_order_id) VALUES ('$exp_order_last_id')";  
	$exp_invoice_sqlq=$conn->query($exp_invoice_sql);
	$exp_invoice_last_id=$conn->insert_id;
	
	$exp_items_lines=sizeof($_POST['product_name']);	
	
	$exp_grand_total_price     = strip_tags($_POST['grand_total_price']);
	//$exp_paid_amount      = strip_tags($_POST['paid_amount']);
	if(strip_tags($_POST['paid_amount'])==''){ 
		$exp_paid_amount=0;
		}else{
			$exp_paid_amount=strip_tags($_POST['paid_amount']);
		}	
    $exp_due_amount     = strip_tags($_POST['due_amount']);
	
	
	if(!empty($_FILES['userfile']['name'])) {
		$uploaddir = '../uploads/';
		$uploadfile = basename($_FILES['userfile']['name']);			 
		$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' ); 
		$ext = pathinfo($uploadfile, PATHINFO_EXTENSION);		
		$final_image = rand(1000,1000000).$uploadfile;
	if(in_array($ext, $valid_extensions)) { 
		$path = $uploaddir.$final_image;		  
		  if (move_uploaded_file($_FILES['userfile']['tmp_name'], $path)) {
	
		
	for($x = 0; $x < $exp_items_lines; $x++) {
		
	$exp_inv_line_sql = "INSERT INTO sup_invoice_line_items (exp_order_id,exp_invoice_id,exp_product_name,exp_product_quantity,exp_product_rate,exp_total_price) 
	VALUES ('$exp_order_last_id', '$exp_invoice_last_id','".strip_tags($_POST['product_name'][$x])."', '".strip_tags($_POST['product_quantity'][$x])."','".strip_tags($_POST['product_rate'][$x])."', '".strip_tags($_POST['total_price'][$x])."')";  
	$exp_inv_line_sqlq=$conn->query($exp_inv_line_sql);	
		
	}		
	
	if($exp_due_amount==0) { $payment_status=0; } else { $payment_status=1; }

	$exp_inv_pay_sql = "INSERT INTO sup_invoice_payment_detail (auth_id,exp_order_id,warehouse_id,exp_invoice_id,supplier_id,exp_grand_total_price,exp_paid_amount,exp_due_amount,sup_invoice_image,exp_payment_detail_date,exp_payment_detail_status) 
	VALUES ('$auth_id', '$exp_order_last_id','$warehouse_id', '$exp_invoice_last_id','$supplier_id','$exp_grand_total_price', '$exp_paid_amount', '$exp_due_amount','$final_image','$datepicker_invoice_exp','$payment_status')";  
	$inv_pay_sqlq=$conn->query($exp_inv_pay_sql);
 	
	$response['status'] = 'successfully';	
	
	 } else {	$response['status']= 'image-error'; }
	}else{ $response['status']= 'image-ext'; }	
	
	}else {			
	
			for($x = 0; $x < $exp_items_lines; $x++) {
		
	$exp_inv_line_sql = "INSERT INTO sup_invoice_line_items (exp_order_id,exp_invoice_id,exp_product_name,exp_product_quantity,exp_product_rate,exp_total_price) 
	VALUES ('$exp_order_last_id', '$exp_invoice_last_id','".strip_tags($_POST['product_name'][$x])."', '".strip_tags($_POST['product_quantity'][$x])."','".strip_tags($_POST['product_rate'][$x])."', '".strip_tags($_POST['total_price'][$x])."')";  
	$exp_inv_line_sqlq=$conn->query($exp_inv_line_sql);	
		
	}		
	
	if($exp_due_amount==0) { $payment_status=0; } else { $payment_status=1; }

	$exp_inv_pay_sql = "INSERT INTO sup_invoice_payment_detail (auth_id,exp_order_id,warehouse_id,exp_invoice_id,supplier_id,exp_grand_total_price,exp_paid_amount,exp_due_amount,exp_payment_detail_date,exp_payment_detail_status) 
	VALUES ('$auth_id', '$exp_order_last_id','$warehouse_id', '$exp_invoice_last_id','$supplier_id','$exp_grand_total_price', '$exp_paid_amount', '$exp_due_amount','$datepicker_invoice_exp','$payment_status')";  
	$inv_pay_sqlq=$conn->query($exp_inv_pay_sql);
 	
	$response['status'] = 'successfully';
	
		} 

}else{	
		
	$response['status']= 'error';
	
	}



echo json_encode($response);
?>