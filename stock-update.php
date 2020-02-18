<?php
  $Admin_auth = 1;
  $Stock_auth = 1;
  $Area_Center_auth = 0;
 include('includes/user_auth.php');
?>

<?php

$query_stock = "UPDATE stocks SET quantity = quantity - '$order_qty' WHERE product = '$order_product_model'";

mysqli_query($link, $query_stock) or die(mysqli_error($link)); //Execute  insert query

?>

<?php /*

$query_stock = "UPDATE stocks SET quantity = quantity - '$order_qty' WHERE product = '$order_product_model'";

$resultss = mysqli_query($link, $query_stock) or die(mysqli_error($link)); //Execute  insert query
                                    
if($resultss){
   return;
}else{
   //If execution failed
   echo "<script>alert('An Error has Occured. ERROR CODE: 223');</script>";
}

//mysqli_close($link);
*/
?>