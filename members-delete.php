<?php
  $Admin_auth = 1;
  $Stock_auth = 1;
  $Area_Center_auth = 0;
 include('includes/user_auth.php');
?>

<?php
session_start();
require_once 'config.php';
$get_member_id = $_GET['member_id'];
$query = "DELETE FROM `customers` WHERE member_id='$get_member_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
     //echo "<script>alert('new staff added succesfully');</script>";
                                    $info = $_SESSION['username']." deleted member";
                                    $info2 = "Details: ".$get_member_id;
                                    $alertlogsuccess = "Member has been deleted succesfully!";
                                    include('logs.php');
                                    echo "<script>window.location.href='members-manage.php';</script>";
}else {
    echo "Error deleteing record: " . mysqli_error($link) ." please contact support.";
}
// Close connection
mysqli_close($link);
?>
