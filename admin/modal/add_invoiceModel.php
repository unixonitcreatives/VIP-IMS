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

if((!empty($_POST['customer_name'])) || (!empty($_POST['new_customer'])) && (!empty($_POST['product_id'][0])) ) {

 	$auth_id     = strip_tags($_POST['auth_id']);
	$customer_name      = strip_tags($_POST['customer_name']);
	$customer_id     = strip_tags($_POST['customer_id']);
	$new_customer      = strip_tags($_POST['new_customer']);
	$cus_mobile     = strip_tags($_POST['cus_mobile']);
    $new_customer_address     = strip_tags($_POST['new_customer_address']);
	$datepicker_invoice_date     = strip_tags($_POST['datepicker_invoice_date']);
	
	if(empty($customer_name) && empty($customer_id)) {
    $cus_sql = "INSERT INTO customers (cus_name, cus_mobile, cus_email, cus_address)
VALUES ('$new_customer', '$cus_mobile', '', '$new_customer_address')";    
	$conn->query($cus_sql);
    $cus_last_id = $conn->insert_id;	
		}else{
			 $cus_last_id =$customer_id;
			
		}
			
	$order_sql = "INSERT INTO orders (customer_id, auth_id,date_order_placed) VALUES ('$cus_last_id','$auth_id', '$datepicker_invoice_date')";  
	$order_sqlq=$conn->query($order_sql);
	$order_last_id=$conn->insert_id;
	
	$invoice_sql = "INSERT INTO invoices (order_id) VALUES ('$order_last_id')";  
	$invoice_sqlq=$conn->query($invoice_sql);
	 $invoice_last_id=$conn->insert_id;
	
	 $items_lines=sizeof($_POST['product_id']);	
		
	for($x = 0; $x < $items_lines; $x++) {
		if(strip_tags($_POST['discount'][$x])==''){ 
		$line_item_discount=0;
		}else{
			$line_item_discount=strip_tags($_POST['discount'][$x]);
		}
	$inv_line_sql = "INSERT INTO invoice_line_items (order_id,invoice_no_id,product_id,product_quantity,product_rate,discount,total_price) 
	VALUES ('$order_last_id','$invoice_last_id','".strip_tags($_POST['product_id'][$x])."','".strip_tags($_POST['product_quantity'][$x])."','".strip_tags($_POST['product_rate'][$x])."', '$line_item_discount', '".strip_tags($_POST['total_price'][$x])."')";  
	$inv_line_sqlq=$conn->query($inv_line_sql);	
	
	$update_product_table = "UPDATE product_detail SET `product_quantity` = `product_quantity` - '".strip_tags($_POST['product_quantity'][$x])."' where p_id='".strip_tags($_POST['product_id'][$x])."'";    
	$conn->query($update_product_table);
		
	}
		
	$total_discount      = strip_tags($_POST['total_discount']);
	$grand_total_price     = strip_tags($_POST['grand_total_price']);
	if(strip_tags($_POST['paid_amount'])==''){ 
		$paid_amount=0;
		}else{
			$paid_amount=strip_tags($_POST['paid_amount']);
		}
	//$paid_amount      = strip_tags($_POST['paid_amount']);
	$due_amount     = strip_tags($_POST['due_amount']);
	if($due_amount==0) { $payment_status=0; } else { $payment_status=1; }

	$inv_pay_sql = "INSERT INTO invoice_payment_detail (customer_id,order_id,invoice_no_id,total_discount,grand_total_price,paid_amount,due_amount,payment_detail_date,auth_id,payment_detail_status) 
	VALUES ('$cus_last_id', '$order_last_id', '$invoice_last_id','$total_discount', '$grand_total_price','$paid_amount', '$due_amount','$datepicker_invoice_date','$auth_id','$payment_status')";  
	$inv_pay_sqlq=$conn->query($inv_pay_sql);
 	
	$response['status'] = 'successfully';		

}else{	
		
	$response['status']= 'error';
	
	}



echo json_encode($response);
?>