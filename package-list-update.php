<?php
  $Admin_auth = 1;
  $Stock_auth = 0;
  $Area_Center_auth = 0;
 include('includes/user_auth.php');
?>

<?php

require_once "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

$model = valData($_POST['model']);
$qty = valData($_POST['qty']);
$id = valData($_POST['pack_id']);


$query = "UPDATE package_list SET pack_list_model='$model', pack_list_qty='$qty' WHERE pack_list_id='$id'";
$result = mysqli_query($link,$query);

}

function valData($data){
  $data = trim($data);
  $data = stripcslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>