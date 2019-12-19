<?php
session_start();
header('Content-type: application/json');
require_once ('../connection/connection.php');
$response = array();

if(!empty($_POST['username']) && !empty($_POST['password']))
{
  
	$username      = strip_tags(trim($_POST['username']));
    $password     = md5(trim($_POST['password']));    
	$q="SELECT * FROM auth WHERE auth_username='$username' and auth_password='$password'";	
     $result = $conn->query($q);
        if($result->num_rows > 0){
			while($row1=$result->fetch_assoc()) {	
		 
				$auth_id=$row1['auth_id'];
				$_SESSION['auth_id']=$auth_id;
				$auth_username=$row1['auth_username'];
				$_SESSION['auth_username']=$auth_username;
				$full_name=$row1['full_name'];
				$_SESSION['full_name']=$full_name;
				$user_type_id=$row1['user_type_id'];
				$_SESSION['user_type_id']=$user_type_id;			
			   $response['status'] = 'login'; 
			}		
		
		}else{
            
			$response['status'] = 'error';
        }

  
}

echo json_encode($response);
?>