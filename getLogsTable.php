 <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">

 <thead>
                  <tr>
                    <th width="40%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Log</th>
                    <th width="40%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Details</th>
                    <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Time Created</th>
                    <!-- <th>Action</th> -->
                  </tr>
                </thead>
<tbody>
    <?php
// Include config file
    require_once 'config.php';

// Attempt select query execution
    $query = "SELECT * FROM logs ORDER BY id desc LIMIT 50";
    if($result = mysqli_query($link, $query)){
      if(mysqli_num_rows($result) > 0){
        $ctr = 0;
        while($row = mysqli_fetch_array($result)){
          $ctr++;
          echo "<tr>";
            echo "<td>" . $row['info'] . "</td>";
            echo "<td>" . $row['info2'] . "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
          echo "</tr>";
        }
// Free result set
        mysqli_free_result($result);
      } else{
        echo "<p class='lead'><em>No records were found.</em></p>";
      }
    } else{
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

// Close connection
    mysqli_close($link);
    ?>
      
    </tbody>
  </table>


