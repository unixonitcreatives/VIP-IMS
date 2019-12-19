<?php 
session_start();
if(isset($_SESSION['auth_username']) && (!empty($_SESSION['auth_username']))){
        
	session_unset();    
    session_destroy();
	unset($_SESSION['auth_id']);
	unset($_SESSION['auth_username']);
    
	header('location: ../index.php');
}



?>