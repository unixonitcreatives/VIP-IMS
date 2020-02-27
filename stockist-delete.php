<!-- <?php
  /*$Admin_auth = 1;
  $Stock_auth = 0;
  $Area_Center_auth = 0;
 include('includes/user_auth.php');*/
?> -->

<?php
session_start();
require_once 'config.php';
$get_stockist_id = $_GET['id'];
$query = "DELETE FROM `stockist` WHERE id ='$get_stockist_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
     //echo "<script>alert('new staff added succesfully');</script>";
                                    $info = $_SESSION['username']." deleted stockist";
                                    $info2 = "Details: ".$get_stockist_id;
                                    $alertlogsuccess = $get_stockist_id.": has been deleted succesfully!";
                                    include('logs.php');
                                    echo "<script>window.location.href='stockist-manage.php';</script>";
}else {
    echo "Error deleteing record: " . mysqli_error($link) ." please contact support.";
}
// Close connection
mysqli_close($link);
?>
