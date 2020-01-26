<?php
session_start();
require_once 'config.php';
$get_warehouse_id = $_GET['warehouse_id'];
$query = "DELETE FROM `warehouse` WHERE warehouse_id='$get_warehouse_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
     //echo "<script>alert('new staff added succesfully');</script>";
                                    $info = $_SESSION['username']." deleted warehouse";
                                    $info2 = "Details: ".$get_warehouse_id;
                                    $alertlogsuccess = $get_warehouse_id.": has been deleted succesfully!";
                                    include('logs.php');
                                    echo "<script>window.location.href='warehouse-manage.php';</script>"; 
}else {
    echo "Error deleteing record: " . mysqli_error($link) ." please contact support.";
}
// Close connection
mysqli_close($link);
?>
