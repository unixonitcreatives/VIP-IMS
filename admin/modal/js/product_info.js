// Supplier information
$(document).ready(function(){	

	$('#productInfo').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var product_id = button.data('whatever');
		var modal = $(this);
		
		$.ajax({

				type : 'GET',
				url  : 'modal/product-info.php',
				data : 'product_id='+product_id,				
				success :  function (response) {																		
				$('.modal-body').html(response);					
				}			
		})
	})

});