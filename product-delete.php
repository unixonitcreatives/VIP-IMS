<?php
session_start();
require_once 'config.php';
$username = $usertype ='';
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
$id = $_GET['id'];
$query = "DELETE FROM `product_model` WHERE custID='$id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){

	                                //echo "<script>alert('new staff added succesfully');</script>";
                                    $info = $username." deleted Product Model";
                                    $info2 = "Details: ".$id;
                                    $alertlogsuccess = $username.", ".$id .": has been deleted succesfully!";
                                    include('logs.php');
                                    echo "<script>window.location.href='product-manage.php';</script>";

}else {
    echo "Error deleteing record: " . mysqli_error($link) ." please contact support.";
}
// Close connection
mysqli_close($link);
?>
