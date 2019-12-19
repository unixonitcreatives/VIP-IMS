<?php require_once ('../connection/connection.php'); 
$sql = "SELECT order_id,invoice_no_id FROM invoice_payment_detail";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{
	$qs=array();
	while($row = $result->fetch_assoc()) 
	{
		$qs[]='{"label":"'.$row['invoice_no_id'].'","value":"'.$row['order_id'].'"}';
	}
}


?>
<script type="text/javascript">
var invoiceList = [<?php echo @implode(",", $qs);?>]; 

APchange = function(event, ui){
	$(this).data("autocomplete").menu.activeMenu.children(":first-child").trigger("click");
}
    $(function() {
      
        $( ".quick_invoice_search" ).autocomplete(
		{
            source:invoiceList,
			delay:300,
			focus: function(event, ui) {
				$(this).parent().find(".hidden_value_invoice").val(ui.item.value);
				$(this).val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$(this).parent().find(".hidden_value_invoice").val(ui.item.value);
				$(this).val(ui.item.label);
				$(this).unbind("change");
				return false;
			}
		});
			$( ".quick_invoice_search" ).focus(function(){
				$(this).change(APchange);
			
			});
    });
	</script>