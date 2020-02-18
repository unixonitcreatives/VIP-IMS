<?php
  $Admin_auth = 1;
  $Stock_auth = 0;
  $Area_Center_auth = 0;
 include('includes/user_auth.php');
?>

<?php
session_start();
require_once 'config.php';
$id = $_GET['id'];
$query = "DELETE FROM `users` WHERE custID='$id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
     //echo "<script>alert('new staff added succesfully');</script>";
                                    $info = $_SESSION['username']." deleted staff";
                                    $info2 = "Details: ".$id;
                                    $alertlogsuccess = $id.": has been deleted succesfully!";
                                    include('logs.php');
                                    echo "<script>window.location.href='staff-manage.php';</script>";
}else {
    echo "Error deleteing record: " . mysqli_error($link) ." please contact support.";
}
// Close connection
mysqli_close($link);
?>
