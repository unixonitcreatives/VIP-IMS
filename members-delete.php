<?php
session_start();
require_once 'config.php';
$id = $_GET['id'];
$query = "DELETE FROM `customers` WHERE custID='$id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
     //echo "<script>alert('new staff added succesfully');</script>";
                                    $info = $_SESSION['username']." deleted warehouse";
                                    $info2 = "Details: ".$id;
                                    $alertlogsuccess = $id.": has been deleted succesfully!";
                                    include('logs.php');
                                    echo "<script>window.location.href='members-manage.php';</script>";
}else {
    echo "Error deleteing record: " . mysqli_error($link) ." please contact support.";
}
// Close connection
mysqli_close($link);
?>
