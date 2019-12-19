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

if(!empty($_POST['supplier_name']) && !empty($_POST['supplier_contact_name']))
{
  
	$supplier_name      = strip_tags($_POST['supplier_name']);
    $supplier_contact_name     = strip_tags($_POST['supplier_contact_name']);
	$supplier_email      = strip_tags($_POST['supplier_email']);
    $supplier_phone     = strip_tags($_POST['supplier_phone']); 
	$supplier_address      = strip_tags($_POST['supplier_address']);
    $sql = "INSERT INTO suppliers (supplier_name, supplier_contact_name, supplier_email, supplier_phone, supplier_address)
VALUES ('$supplier_name', '$supplier_contact_name', '$supplier_email', '$supplier_phone', '$supplier_address')";    
	
     	if ($conn->query($sql) === TRUE) {
			$response['status'] = 'successfully'; 
		} else {
			$response['status']= 'error';
		}
		   
				
		
}else{
            
		$response['status'] = 'error';
}

  


echo json_encode($response);
?>