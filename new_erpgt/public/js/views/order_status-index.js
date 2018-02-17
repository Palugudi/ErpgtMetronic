// Afficher la liste
$(document).ready(function(){
	Order_statusList();
});

// Fonction pour afficher la liste
var Order_statusList = function()
{
	$.ajax({
		type:'get',
		url: routeOrder_statusAjax,
		success: function(data){
			$('#order_statusList').empty().html(data);
			DataTable('#OrderStatusTable');
		}
	});
}

var DeleteOrder_status = function(id)
{
	swal({
	  title: Order_statusDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routeOrder_status+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    Order_statusDeletedText,
					    'success'
					);
					Order_statusList();
				}
			}
		});
	});
};

var NewOrder_status = function()
{	
	ResetFields();

	$('#OrderStatusModalTitle').text(Order_statusAddText);
	$('.btn-save').text(validate_btn);
	$('#order_status_id').val("");
	$('#Order_status').val("");
	$('#Order_status').focus();
	$('#Order_statusModal').modal('show');
};

var EditOrder_status = function(id)
{	
	ResetFields();
    
	$.get(routeOrder_status+"/"+id+"/edit", function(data){
		$('#OrderStatusModalTitle').text(Order_statusEditText);
		$('.btn-save').text(validmodif_btn);
		$('#order_status_id').val(data.id);
		$('#Order_status').val(data.name);
		$('#Order_status').focus();
		$('#Order_statusModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveOrder_status").click(function(e)
{
	var form = $('#frmOrder_status')[0];
	var formData = new FormData(form);
	var id = $("#order_status_id").val();
	var Saveroute = routeOrder_status;
	var state = $('#saveOrder_status').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = routeOrder_status+"/"+id;
	}

	$.ajax({
		url: Saveroute,
		headers: {'X-CSRF-TOKEN': token},
		type: type,
		data : formData,
		contentType: false,
    	processData: false,
		success: function(data){
			if (data.success == 'true')
			{
				Order_statusList();
				$("#Order_statusModal").modal('toggle');
				$('#frmOrder_status').trigger('reset');
				$('#order_status').focus();

				if (state==validmodif_btn){
					$("#message-update").fadeIn();
					$('#message-update').show().delay(3000).fadeOut(1);
				}else {
					$("#message-new").fadeIn();
					$('#message-new').show().delay(3000).fadeOut(1);
				}
			}
		},
		error:function(data)
		{
			// Permet d'afficher les messages d'erreur sous les champs
			$.each(data.responseJSON, function (key, value) {
                var input = '#frmOrder_status input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmOrder_status textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmOrder_status select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
})