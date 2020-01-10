<?php
session_start();
require_once 'config.php';
$id = $_GET['id'];
$query = "DELETE FROM `warehouse` WHERE custID='$id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
    echo "<script>
	alert('succesfully deleted.');
	window.location.href='warehouse-manage.php';
	</script>";
}else {
    echo "Error deleteing record: " . mysqli_error($link) ." please contact support.";
}
// Close connection
mysqli_close($link);
?>