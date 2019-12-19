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
if(!empty($_GET['product_id']))
{
  
	$productId = strip_tags($_GET['product_id']); 
$q = "SELECT s.*,c.*,w.*, prInfo.*, prDetail.* FROM suppliers as s, categories as c,
warehouse as w, product as prInfo, product_detail as prDetail 
where prInfo.product_id=prDetail.p_id AND
s.supplier_id=prDetail.s_id AND
w.war_id=prDetail.w_id AND
c.cat_id=prDetail.c_id AND 
prInfo.product_id='$productId'";	       
		
     $result = $conn->query($q);
        if($result->num_rows > 0){ ?>

<div class="table-responsive" data-pattern="priority-columns">
  <div class="row">
    <div class="col-md-8">
      <h5 class="gradient-info text-white box-block"><?php echo $lang['Suppliers'];?></h5>
      <table class="footable-details table table-hover toggle-circle">
        <tbody>
          <?php 
			while($row1=$result->fetch_assoc()) {	?>
          <tr>
            <th><?php echo $lang['Suppliers'];?></th>
            <td><?php echo $row1['supplier_name'];?></td>
          </tr>
          <tr>
            <th><?php echo $lang['ContactPerson'];?></th>
            <td><?php echo $row1['supplier_contact_name'];?></td>
          </tr>
          <tr>
            <th><?php echo $lang['Email'];?></th>
            <td><?php echo $row1['supplier_email'];?></td>
          </tr>
          <tr>
            <th><?php echo $lang['Phone'];?></th>
            <td><?php echo $row1['supplier_phone'];?></td>
          </tr>
          <tr>
            <th><?php echo $lang['Address'];?></th>
            <td><p><?php echo $row1['supplier_address'];?></p></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-4"><img class="card-img-top img-fluid" src="uploads/<?php echo $row1['product_image'];?>" alt="<?php echo $row1['product_name'];?>"></div>
  </div>
 <div class="row">
    <div class="col-md-6">
      <h5 class="gradient-info text-white box-block"><?php echo $lang['Categoryinfo'];?></h5>
      <table class="table table-striped table-hover">
        <tbody>
          <tr>
            <th><?php echo $lang['Categories'];?></th>
            <td><?php echo $row1['cat_name'];?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-6">
      <h5 class="gradient-info text-white box-block"><?php echo $lang['Warehouseinfo'];?></h5>
      <table class="table table-striped table-hover">
        <tbody>
          <tr>
            <th><?php echo $lang['Warehouse'];?></th>
            <td><?php echo $row1['war_name'];?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
<div class="row">
  <div class="col-md-12">
    <h5 class="gradient-info text-white box-block"><?php echo $lang['Productinfo'];?></h5>
    <table class="table table-striped table-hover">
      <tbody>
        <tr>
          <th><?php echo $lang['Products'];?> </th>
          <th><?php echo $lang['Model'];?></th>
          <th>SKU</th>
          <th>Mfg.<?php echo $lang['Date'];?></th>
           <th>Exp.<?php echo $lang['Date'];?></th>
          <th><?php echo $lang['Quantity'];?></th>
          <th><?php echo $lang['SellPrice'];?></th>
          <th><?php echo $lang['SupplierPrice'];?></th>
        </tr>
        <tr>
          <td><?php echo $row1['product_name'];?></td>
          <td><?php echo $row1['product_model'];?></td>
          <td><?php echo $row1['product_sku'];?></td>
          <td><?php echo date("d-m-Y",strtotime($row1['datepicker_mfg_date']));?></td>
      	  <td><?php echo date("d-m-Y",strtotime($row1['datepicker_exp_date']));?></td>
          <td><?php echo $row1['product_quantity'];?></td>
          <td><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php echo $row1['product_sell_price'];?></td>
          <td><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php echo $row1['product_supplier_price'];?></td>
        </tr>
        <tr>
          <th><?php echo $lang['SupplierPrice'];?></th>
          <td  colspan="7"><?php echo $row1['product_detail'];?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<?php } ?>
</div>
<?php }else { echo "No Record found"; }
}

?>
