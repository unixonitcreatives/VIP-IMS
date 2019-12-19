<?php require_once ('../connection/connection.php');
$sql = "SELECT dp.*, p.* FROM product as p, product_detail as dp where p.product_id=dp.p_id and dp.dead_stock='0' and dp.datepicker_mfg_date <= dp.datepicker_exp_date";

$result = $conn->query($sql);
if ($result->num_rows > 0) 
{
	$pp=array();
	while($row = $result->fetch_assoc()) 
	{
		$pp[]='{"label":"'.$row['product_name'].'","value":"'.$row['product_id'].'"}';
	}
}
?>

<script type="text/javascript">
var productList = [<?php echo @implode(",", $pp);?>]; 

APchange = function(event, ui){
	$(this).data("autocomplete").menu.activeMenu.children(":first-child").trigger("click");
}
    function invoice_productList(cName) {		
		var item_price = 'item_price_'+cName;	
		var available_quantity = 'available_quantity_'+cName;
        $( ".productSelection" ).autocomplete(
		{
            source: productList,
			delay:300,
			focus: function(event, ui) {
				$(this).parent().find(".autocomplete_hidden_value").val(ui.item.value);
				$(this).val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$(this).parent().find(".autocomplete_hidden_value").val(ui.item.value);
				$(this).val(ui.item.label);
				
				var id=ui.item.value;
				var dataString = 'product_id='+ id;
								
				$.ajax
				   ({
						type: "POST",
						url: "modal/inv_pro_info.php",
						data: dataString,
						cache: false,
						success: function(data)
						{
													
							var obj = jQuery.parseJSON(data);
							//alert(obj);						
							$('.'+item_price).val(obj.product_sell_price);
							$('.'+available_quantity).val(obj.product_quantity);						
							
							quantity_calculate(cName);
							
						} 
					});
				
				$(this).unbind("change");
				return false;
			}
		});
		$( ".productSelection" ).focus(function(){
			$(this).change(APchange);
		
		});
    }
</script>