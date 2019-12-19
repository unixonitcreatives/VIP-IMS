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
if(!empty($_GET['loan_contract_id']))
{
  
	$loan_contract_id = $_GET['loan_contract_id'];   
	$q="SELECT SUM(amount_of_payment) as return_amount,ln.*,lc.* from loan_contract as lc , loan_payments as lp,loan_needer as ln WHERE lc.loan_contract_id =lp.loan_contract_id and ln.loaner_id=lc.loaner_id and lc.loan_contract_id='$loan_contract_id' group by lp.loan_contract_id";     
	     $result = $conn->query($q);
        if($result->num_rows > 0){ ?>
        <div class="table-responsive" data-pattern="priority-columns">
        <table class="footable-details table table-hover toggle-circle">  
        <tbody>      
        <?php 
			while($row1=$result->fetch_assoc()) {	?>
			<tr>
            <th><?php echo $lang['Loaner'];?></th>
            <td><?php echo $row1['loaner_name'];?></td>
          </tr>
          <tr>
            <th><?php echo $lang['Mobile'];?></th>
            <td><?php echo $row1['loaner_mobile'];?></td>
          </tr>
          <tr>
            <th><?php echo $lang['Address'];?></th>
            <td><?php echo $row1['loaner_address'];?></td>
          </tr>
          <tr>
            <th><?php echo $lang['LoanAmount'];?></th>
            <td><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php echo $row1['loan_amount'];?></td>
          </tr>
          <tr>
            <th><?php echo $lang['DateContractStart'];?></th>
            <td><?php echo date("d-m-Y", strtotime($row1['date_contract_start']));?></td>
          </tr>
          <tr>
            <th><?php echo $lang['LoanContractEnd-Date'];?></th>
            <td><?php echo date("d-m-Y", strtotime($row1['date_contract_end']));?></td>
          </tr>       
          <tr>
            <th><?php echo $lang['TermsandConditions'];?></th>
            <td><?php echo $row1['terms_and_conditions'];?></td>
          </tr>
           </tbody>
      </table>
       <table class="table table-striped table-bordered dataTable table-hover">
        <tbody>
            <tr>                
                <th><?php echo $lang['PaymentRecieveDate'];?></th>
                <th><?php echo $lang['AmountRecieved'];?></th>                
                <th><?php echo $lang['LoanAmount'];?></th>										
                <th><?php echo $lang['Remarks'];?></th>			
                </tr>
            <?php 
	$lpquery="SELECT * from loan_payments where loan_contract_id='$loan_contract_id' order by date_of_payment ASC";	
     $resultlp = $conn->query($lpquery);
       if($resultlp->num_rows > 0){ 
	   		$sumofrecieve=0;
		while($row2=$resultlp->fetch_assoc()) {	?>
            <tr>				
				<td><?php echo date("d-m-Y", strtotime($row2['date_of_payment']));?></td>
                <td><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php echo $row2['amount_of_payment'];?></td>
                <td><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php echo $row1['loan_amount'];?></td>                
                <td><?php echo $row2['remarks'];?></td>                               
            </tr>        
            
			<?php 			
				}
				$totalrecieve=$row1['return_amount']; 
				$totalremaining=$row1['loan_amount']-$row1['return_amount']; 
	 	  }
			
			} ?> 
            <tr>				
				<td><?php echo $lang['TotalReceived'];?></td>
                <td><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php echo $totalrecieve;?></td>
                <td><?php echo $lang['RemainingAmount'];?></td>                
                <td><?php if(isset($setting_currency)){ echo $setting_currency;}?><?php echo $totalremaining;?></td>                               
            </tr>       
			</tbody>
			</table>   
			</div>
   
	<?php }else { echo "No Record found"; }
}

?>