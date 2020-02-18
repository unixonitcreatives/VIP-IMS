<?php
  $Admin_auth = 1;
  $Stock_auth = 0;
  $Area_Center_auth = 0;
 include('includes/user_auth.php');
?>
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
