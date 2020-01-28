<?php
include("config.php");

$id=$_GET['ob_tx_id'];

$query = "DELETE FROM outboundtb WHERE ob_tx_id=$id";
$res = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
     //echo "<script>alert('new staff added succesfully');</script>";
                                    $info = $_SESSION['username']." deleted warehouse";
                                    $info2 = "Details: ".$get_member_id;
                                    $alertlogsuccess = "Member has been deleted succesfully!";
                                    include('logs.php');
                                    echo "<script>window.location.href='invoice-manage.php';</script>";
}else {
    echo "Error deleteing record: " . mysqli_error($link) ." please contact support.";
}


?>
