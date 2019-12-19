<?php require_once ('../connection/connection.php'); 
$sql = "SELECT * FROM customers";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{
	$cc=array();
	while($row = $result->fetch_assoc()) 
	{
		$cc[]='{"label":"'.$row['cus_name'].'","value":"'.$row['cus_id'].'"}';
	}
}


?>
<script type="text/javascript">
var customerList = [<?php echo @implode(",", $cc);?>]; 

APchange = function(event, ui){
	$(this).data("autocomplete").menu.activeMenu.children(":first-child").trigger("click");
}
    $(function() {
      
        $( ".customerSelection" ).autocomplete(
		{
            source:customerList,
			delay:300,
			focus: function(event, ui) {
				$(this).parent().find(".hidden_value").val(ui.item.value);
				$(this).val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$(this).parent().find(".hidden_value").val(ui.item.value);
				$(this).val(ui.item.label);
				$(this).unbind("change");
				return false;
			}
		});
			$( ".customerSelection" ).focus(function(){
				$(this).change(APchange);
			
			});
    });
	</script>