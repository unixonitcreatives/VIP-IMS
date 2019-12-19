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

if(!empty($_POST['loan_amount']))
{
  
	$loaner_id      = strip_tags($_POST['loaner_id']);    
	$loan_amount      = strip_tags($_POST['loan_amount']);
	$datepicker_start_date     = strip_tags($_POST['datepicker_start_date']);	
	$datepicker_end_date     = strip_tags($_POST['datepicker_end_date']);	
	$detail     = strip_tags($_POST['detail']);	
    $sql = "INSERT INTO loan_contract (loaner_id, loan_amount, date_contract_start, date_contract_end, terms_and_conditions)
VALUES ('$loaner_id', '$loan_amount', '$datepicker_start_date', '$datepicker_end_date', '$detail')";    
	
     	if ($conn->query($sql) === TRUE) {	
			
			$last_id = $conn->insert_id;	
			 
			$sql1 = "INSERT INTO loan_payments (`loan_contract_id`, `date_of_payment`, `amount_of_payment`, `remarks`) VALUES ('$last_id', '$datepicker_start_date','0','None')"; 
			$conn->query($sql1);
			
			$response['status'] = 'successfully'; 
		} else {
			
			$response['status']= 'error';
		}
		   
				
		
}else{
            
		$response['status'] = 'error';
}

  


echo json_encode($response);
?>