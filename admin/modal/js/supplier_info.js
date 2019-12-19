// Supplier information
$(document).ready(function(){	

	$('#supInfo').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var supplier_id = button.data('whatever');
		var modal = $(this);
		
		$.ajax({

				type : 'GET',
				url  : 'modal/supplier-info.php',
				data : 'supplier_id='+supplier_id,				
				success :  function (response) {																		
				$('.modal-body').html(response);					
				}			
		})
	})

});