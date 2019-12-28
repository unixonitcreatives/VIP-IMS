


<?php

$query="
INSERT INTO logs (info, info2) 
VALUES ('$info', '$info2')"; //Prepare insert query

$result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query
                                    
                                    
if($result){
   echo "<script>alert('".$alertlogsuccess."');</script>";
}else{
   //If execution failed
   echo "<script>alert('An Error has Occured. ERROR CODE: 222');</script>";
}

mysqli_close($link);

?>