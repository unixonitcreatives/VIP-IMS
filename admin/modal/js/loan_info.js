// Supplier information
$(document).ready(function(){	

	$('#loanInfo').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var loan_contract_id = button.data('whatever');
		var modal = $(this);
		
		$.ajax({

				type : 'GET',
				url  : 'modal/loan-info.php',
				data : 'loan_contract_id='+loan_contract_id,				
				success :  function (response) {																		
				$('.modal-body').html(response);					
				}			
		})
	})

});