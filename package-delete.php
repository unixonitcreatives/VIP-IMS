<?php
  $Admin_auth = 1;
  $Stock_auth = 0;
  $Area_Center_auth = 0;
 include('includes/user_auth.php');
?>

<?php
session_start();
require_once 'config.php';

$username = $_SESSION['username'];
$get_model_id = $_GET['model_id'];
$get_model = $_GET['model'];
$query = "DELETE FROM `product_model` WHERE model_id='$get_model_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
//echo "<script>alert('new staff added succesfully');</script>";
                                    $info = $_SESSION['username']." deleted Package";
                                    $info2 = "Details: ".$get_model;
                                    $alertlogsuccess = $get_model.": has been deleted succesfully!";
                                    include('logs.php');
                                    echo "<script>window.location.href='package-manage.php';</script>";
}else {
    echo "Error deleteing record: " . mysqli_error($link) ." please contact support.";
}
// Close connection
mysqli_close($link);
?>
