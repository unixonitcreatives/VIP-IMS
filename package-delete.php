<?php
session_start();
require_once 'config.php';
$id = $_GET['id'];
$query = "DELETE FROM `product_model` WHERE custID='$id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
//echo "<script>alert('new staff added succesfully');</script>";
                                    $info = $_SESSION['username']." deleted Package";
                                    $info2 = "Details: ".$id;
                                    $alertlogsuccess = $id.": has been deleted succesfully!";
                                    include('logs.php');
                                    echo "<script>window.location.href='package-manage.php';</script>";
}else {
    echo "Error deleteing record: " . mysqli_error($link) ." please contact support.";
}
// Close connection
mysqli_close($link);
?>