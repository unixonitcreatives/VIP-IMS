<?php
session_start();
require_once 'config.php';

$username = $usertype ='';

$username = $_SESSION['username'];

$usertype = $_SESSION['usertype'];

$get_id = $_GET['compId'];

$query = "DELETE FROM `company` WHERE compId='$get_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){

	                                //echo "<script>alert('new staff added succesfully');</script>";
                                    $info = $username." deleted Company";
                                    $info2 = "Details: ".$get_id;
                                    $alertlogsuccess = $username.", ".$get_id .": has been deleted succesfully!";
                                    include('logs.php');
                                    echo "<script>window.location.href='profile-manage.php';</script>";

}else {
    echo "Error deleteing record: " . mysqli_error($link) ." please contact support.";
}
// Close connection
mysqli_close($link);
?>
