<?php
include ("session.php");
  $Admin_auth = 1;
  $Stock_auth = 0;
  $Area_Center_auth = 0;
 include('includes/user_auth.php');
?>
<?php

include("config.php");

$id=$_GET['ob_tx_id'];

$query = "DELETE FROM outboundtb WHERE ob_tx_id= '$id' ";
$res = mysqli_query($link, $query) or die(mysqli_error($link));
if ($res){
     //echo "<script>alert('new staff added succesfully');</script>";
                                    $info = $_SESSION['username']." deleted invoice";
                                    $info2 = "Details: ".$id;
                                    $alertlogsuccess = "Invoice has been deleted succesfully!";
                                    include('logs.php');
                                    echo "<script>window.location.href='invoice-unpaid.php';</script>";
}else {
    echo "Error deleting record: " . mysqli_error($link) ." please contact support.";
}


?>
