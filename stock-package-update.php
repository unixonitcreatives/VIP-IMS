
	<?php

	 $query = "SELECT pack_list_model, pack_list_qty FROM package_list 
	 WHERE pack_list_model = '$order_product_model' ";

	          if($result = mysqli_query($link, $query)){
	            if(mysqli_num_rows($result) > 0){
	              while($row = mysqli_fetch_array($result)){
	               $pack_model = $pack_qty = "";

	               $pack_model = $row['pack_list_model'];
	               $pack_qty = $row['pack_list_qty'];
	                

	              }
	              // Free result set
	              //mysqli_free_result($result);
	            } else{
	              echo "<p class='lead'><em>No records were found.</em></p>";
	            }
	          } else{
	            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	          }

	//update stocks
	$query_stock = "UPDATE stocks SET quantity = quantity - '$pack_qty' WHERE product = '$pack_model' ";

	$resultss = mysqli_query($link, $query_stock) or die(mysqli_error($link)); //Execute  insert query
	                                    
	if($resultss){
	   return;
	}else{
	   //If execution failed
	   echo "<script>alert('An Error has Occured. ERROR CODE: 223');</script>";
	}

	//mysqli_close($link);

	?>