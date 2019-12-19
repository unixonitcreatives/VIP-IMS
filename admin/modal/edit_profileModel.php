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

if(!empty($_POST['auth_id']) && !empty($_POST['auth_username']) && !empty($_POST['full_name']) )
{
	$auth_id      = strip_tags($_POST['auth_id']);
  	$user_name      = strip_tags($_POST['auth_username']);
    $full_name     = strip_tags($_POST['full_name']);
	$auth_password     = md5(trim($_POST['password']));	
	if(empty($_POST['password'])) {    
	   $sql = "UPDATE auth SET auth_username='$user_name', full_name='$full_name' WHERE auth_id='$auth_id'";   
		
			if ($conn->query($sql) === TRUE) {
				$response['status'] = 'successfully'; 
			} else {
				$response['status']= 'error';
			}
		
	}else{		
		     
  	 $sql = "UPDATE auth SET auth_username='$user_name', full_name='$full_name',auth_password='$auth_password' WHERE auth_id='$auth_id'";   
	
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