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

if(!empty($_POST['setting_id']) && !empty($_POST['setting_name']) )
{
  	$setting_id      = strip_tags($_POST['setting_id']);
	$setting_name      = strip_tags($_POST['setting_name']);
    $setting_web     = strip_tags($_POST['setting_web']);
	$setting_address      = strip_tags($_POST['setting_address']);
    $setting_city     = strip_tags($_POST['setting_city']); 
	$setting_country      = strip_tags($_POST['setting_country']);
	$setting_phone     = strip_tags($_POST['setting_phone']); 
	$setting_fax      = strip_tags($_POST['setting_fax']);
	$setting_currency      = strip_tags($_POST['setting_currency']);
	
	if(!empty($_FILES['userfile']['name'])) {
		$uploaddir = '../img/logo/';
		$uploadfile = basename($_FILES['userfile']['name']);			 
		$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' ); 
		$ext = pathinfo($uploadfile, PATHINFO_EXTENSION);		
		$final_image = rand(1000,1000000).$uploadfile;
		if(in_array($ext, $valid_extensions)) { 
		$path = $uploaddir.$final_image;		  
		  if (move_uploaded_file($_FILES['userfile']['tmp_name'], $path)) {
	
    $sql = "UPDATE setting SET setting_name='$setting_name', setting_logo='$final_image', setting_address='$setting_address', setting_city='$setting_city', setting_country='$setting_country', setting_phone='$setting_phone', setting_fax='$setting_fax', setting_web='$setting_web', setting_currency='$setting_currency'  where setting_id='$setting_id'";  
	
     	if ($conn->query($sql) === TRUE) {
			
			$response['status'] = 'successfully'; 
			
		} else {
			
			$response['status']= 'error';
		}
		   
		  }else {	$response['status']= 'image-error'; }
		  
		  }else{ $response['status']= 'image-ext'; }	
		  
		  }else {			
	
			
    		$sql = "UPDATE setting SET setting_name='$setting_name', setting_address='$setting_address', setting_city='$setting_city', setting_country='$setting_country', setting_phone='$setting_phone', setting_fax='$setting_fax', setting_web='$setting_web', setting_currency='$setting_currency' where setting_id='$setting_id'";  
			
			if ($conn->query($sql) === TRUE) {
			
			$response['status'] = 'successfully'; 
			
			} else {
			
			$response['status']= 'error';
			
			}
	
		} 
		
}else{
            
		$response['status'] = 'error';
	}

  


echo json_encode($response);
?>