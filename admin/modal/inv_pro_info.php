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
require_once ('../../connection/connection.php');
$data = array();

if(!empty($_POST['product_id']))
{
  	$product_id = trim($_POST['product_id']);
		
   $q="SELECT * FROM product_detail where p_id='$product_id'";          
	$result = $conn->query($q);
	
	while($row = $result->fetch_assoc()) {	
	
	$data['product_quantity']=$row['product_quantity'];
	$data['product_sell_price']=$row['product_sell_price'];	
		
	}
}
echo json_encode($data);
?>