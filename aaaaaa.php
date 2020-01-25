//UPDATE query to packages table
    $updatePackageQuery = "
    UPDATE `product_model` SET description = '$packName', sku = '$sku' WHERE custID = '$id' ";
    $packageResult = mysqli_query($link, $updatePackageQuery) or die(mysqli_error($link));


    if ($packageResult === TRUE) {
      

      echo "<script>alert('Insert 1 Updated')</script>";


      $j = 0;

      //Counts the elements in array
      $count = count($_POST['packlist']);

      
      for ($j = 0; $j < $count; $j++) {

        $listquery = "UPDATE package_list SET pack_list_model = '$packList[$j]', pack_list_qty = '$packQty[$j]' WHERE packID = '$id' ";
        $listresult = mysqli_multi_query($link, $listquery) or die(mysqli_error($link));

        }

        if($listresult === TRUE){
          //logs
          $info = $_SESSION['username']." update package";
          $info2 = "Details: ".$packname.", ".$id;
          $alertlogsuccess = $packname.": has been updated succesfully!";
          include "logs.php";
          echo "<script>window.location.href='package-manage.php'</script>";
                // Free result set
                //mysqli_free_result($result);
              } else{
                //echo "<p class='lead'><em>No records were found.</em></p>";
              }
            } else{
              echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
           } else{
          $alertMessage = "<div class='alert alert-danger' role='alert'>
          Error Creating Package.
          </div>";}
          //INSERT query to so_transactions table end

        } } } // ./validation