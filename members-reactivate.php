<?php
session_start();
require_once 'config.php';
$get_member_id = $_GET['member_id'];
$query = "UPDATE customers SET status = 'Active' WHERE member_id = '$get_member_id' ";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
     //echo "<script>alert('new staff added succesfully');</script>";
                                    $info = $_SESSION['username']." update member status";
                                    $info2 = "Details: ".$get_member_id;
                                    $alertlogsuccess = "Member status is now Active succesfully!";
                                    include('logs.php');
                                    echo "<script>window.location.href='members-manage.php';</script>";
}else {
    echo "Error deleteing record: " . mysqli_error($link) ." please contact support.";
}
// Close connection
mysqli_close($link);
?>
