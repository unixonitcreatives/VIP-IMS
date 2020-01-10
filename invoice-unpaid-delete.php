<?php
include("config.php");

$id=$_GET['id'];

$query = "DELETE FROM outboundtb WHERE id=$id";
$res = mysqli_query($link,$query);

if($res){
  echo "<script>
  alert('succesfully deleted');
  window.location.href='invoice-paid.php';
  </script>";
  exit;
}

?>
