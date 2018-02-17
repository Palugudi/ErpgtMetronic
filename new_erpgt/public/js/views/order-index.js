// Afficher la liste
$(document).ready(function(){
	OrderList();
});

// Fonction pour afficher la liste
var OrderList = function()
{
	$.ajax({
		type:'get',
		url: routeOrderAjax,
		success: function(data){
			$('#orderList').empty().html(data);
			//DataTable('#OrderTable');
			DataTableListOrder.init();
		}
	});
}

//////////
var DataTableListOrder = function() {
	//== Private functions
  
	// demo initializer
	var demo = function() {
  
	  var datatable = $('#OrderTable').mDatatable({
		data: {
		  saveState: {cookie: false},
		},
		search: {
		  input: $('#generalSearch'),
		},
		columns: [
		  {
			field: 'Deposit Paid',
			type: 'number',
		  },
		  {
			field: 'Order Date',
			type: 'date',
			format: 'YYYY-MM-DD',
		  },
		],
	  });
	};
  
	return {
	  //== Public functions
	  init: function() {
		// init dmeo
		demo();
	  },
	};
  }();
/////////
var DeleteOrder = function(id)
{
	swal({
	  title: OrderDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routeOrder+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    OrderDeletedText,
					    'success'
					);
					OrderList();
				}
			}
		});
	});
};

var NewOrder = function(site_id, user_id)
{	
	ResetFields();

	$('#OrderModalTitle').text(OrderAddText);	
	$('.btn-save').text(validate_btn);
	$('#order_id').val("");
	$('#site_id').val(site_id);
	$('#user_id').val(user_id);
	$('#Order_status').val("");
	$('#material').val("");
	$('#equipment_type').val("");
	$('#quantity').val("");
	$('#reference').val("");
	$('#brand').val("");
	$('#model').val("");
	$('#comment').val("");
	$('#equipment').val("");
	$('#intervention').val("");
	$('#localisation').val("");
	$('#localisation_div').toggle(false);
	$('#OrderModal').modal('show');
};

var EditOrder = function(id)
{	
	ResetFields();
    
	$.get(routeOrder+"/"+id+"/edit", function(data){
		$('#OrderModalTitle').text(OrderEditText);
		$('.btn-save').text(validmodif_btn);
		$('#order_id').val(data.id);
		$('#user_id').val(data.user_id);
		$('#Order_status').val(data.status_id);
		$('#equipment_type').val(data.equipment_type_id);
		$('#material').val(data.material);
		$('#quantity').val(data.quantity);
		$('#reference').val(data.reference);
		$('#brand').val(data.brand_id);
		$('#model').val(data.model);
		$('#comment').val(data.comment);
		$('#equipment').val(data.equipment_id);
		$('#intervention').val(data.intervention_id);
		$('#localisation').val(data.localisation_id);
		if(data.equipment_id == 0) {
			$('#localisation_div').toggle(true);
		} else {
			$('#localisation_div').toggle(false);
		}
		$('#OrderModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveOrder").click(function(e)
{

	var form = $('#frmOrder');
	var formData = form.serialize();
	var id = $("#order_id").val();
	var Saveroute = routeOrder;
	var state = $('#saveOrder').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		type = 'PUT';
		Saveroute = routeOrder+"/"+id;
	}

	$.ajax({
		url: Saveroute,
		headers: {'X-CSRF-TOKEN': token},
		type: type,
		data : formData,
		success: function(data){
			if (data.success == 'true')
			{
				OrderList();
				$("#OrderModal").modal('toggle');
				$('#frmOrder').trigger('reset');
				$('#order').focus();

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
                var input = '#frmOrder input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmOrder textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmOrder select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
});

$("#equipment").change(function () {
	if($(this).val() == 0) {
    	$('#localisation_div').toggle(true);
	} else {
		$('#localisation_div').toggle(false);
	}
});