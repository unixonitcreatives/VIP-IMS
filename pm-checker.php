<?php 

//select type if package
$query = "SELECT type FROM product_model WHERE type = 'package' ";

          if($result = mysqli_query($link, $query)){
            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_array($result)){
                $type = "";
                
                $type = $row['type'];

                //if pachage
                if($type == 'package'){

                	//execute
                	include('stock-package-update.php');
                	return;

                }else {

                	//execute
                	include('stock-update.php');
                	return;

                }
                
                

              }
              // Free result set
              mysqli_free_result($result);
            } else{
              echo "<p class='lead'><em>No records were found.</em></p>";
            }
          } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
          }



?>