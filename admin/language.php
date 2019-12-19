<?php 
require_once ('../connection/connection.php');
if(!empty($_GET['lang'])){
	$lang=strip_tags($_GET['lang']);
	$sql = "UPDATE lang SET lang='$lang' where lang_id='1'";
	$conn->query($sql);
	header("location: index.php");
}

$sql = "SELECT * FROM lang where lang_id='1'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();		
$_SESSION['lang'] = $row['lang'];   
include('languages/'.$_SESSION['lang'].'/lang.'.$_SESSION['lang'].'.php');
?>