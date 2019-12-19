<?php
 /**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Adapt Inventory License
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.adaptinventory.com/license.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to adaptinventory@gmail.com so we can send you a copy immediately.
 *
 * @author   Adapt Inventory
 * @author-email  adaptinventory@gmail.com
 * @copyright  Copyright © adaptinventory.com. All Rights Reserved
 */
session_start();
require_once ('../../connection/connection.php');

include('../languages/'.$_SESSION['lang'].'/lang.'.$_SESSION['lang'].'.php');
if(!empty($_GET['cus_id']))
{
  
	$cusId = strip_tags($_GET['cus_id']);        
	$q="SELECT * FROM customers where cus_id='$cusId'";	
     $result = $conn->query($q);
        if($result->num_rows > 0){ ?>
        <div class="table-responsive" data-pattern="priority-columns">
        <table class="footable-details table table-striped table-hover toggle-circle">
        <tbody> 
        <?php 
			while($row1=$result->fetch_assoc()) {	?>
			<tr>
				<th><?php echo $lang['Customers'];?></th>
				<td><?php echo $row1['cus_name'];?></td>
			  </tr>
			  <tr>
				<th><?php echo $lang['Mobile'];?></th>
				<td><?php echo $row1['cus_mobile'];?></td>
			  </tr>
			  <tr>
				<th><?php echo $lang['Email'];?></th>
				<td><?php echo $row1['cus_email'];?></td>
			  </tr>			  
			  <tr>
				<th><?php echo $lang['BillingAddress'];?></th>
				<td><p><?php echo $row1['cus_address'];?></p></td>
			  </tr>
			  
			<?php } ?>        
			</tbody>
			</table>   
			</div>
   
	<?php }else { echo "No Record found"; }
}

?>