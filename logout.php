<?php
// Initialize the session
session_start();

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

require_once "config.php";
$info = $_SESSION['username']." Logged Out";
$info2 = "Details: ".$_SESSION['username'].", ".$_SESSION['usertype']." IP:".getRealIpAddr();
$query="
INSERT INTO logs (info, info2) 
VALUES ('$info', '$info2')"; //Prepare insert query
$result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query

 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: login.php");
exit;
?>
