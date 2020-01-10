<?php
session_start();
require_once 'config.php';
$id = $_GET['id'];
$query = "DELETE FROM `product_model` WHERE custID='$id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
    header("Location: product-manage.php?alert=deletesuccess");
}else {
    echo "Error deleteing record: " . mysqli_error($link) ." please contact support.";
}
// Close connection
mysqli_close($link);
?>