
<?php

$query_stock = "UPDATE stocks SET quantity = quantity - '".$package_qty."' WHERE product = '".$package_model."'";
 $resultss = mysqli_query($link, $query_stock) or die(mysqli_error($link)); //Execute  insert query
                                    
if($resultss){
   return;
}else{
   //If execution failed
   echo "<script>alert('An Error has Occured. ERROR CODE: 223');</script>";
}

mysqli_close($link);

?>