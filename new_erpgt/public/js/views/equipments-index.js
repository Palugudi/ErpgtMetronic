// Afficher la liste des questions
$(document).ready(function(){
	EquipmentList();
});

// Fonction pour afficher la liste des questions
var EquipmentList = function()
{
	$.ajax({
		type:'get',
		url: routeAjax,
		success: function(data){
			$('#equipmentList').empty().html(data);
			//DataTable('#EquipmentTable');
			DataTableListEquipment.init();
		}
	});
}

var DataTableListEquipment = function() {
	//== Private functions
  
	// demo initializer
	var demo = function() {
  
	  var datatable = $('#EquipmentTable').mDatatable({
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


var DeleteEquipment = function(id)
{
	swal({
	  title: EquipementDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: route+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    EquipmentDeletedText,
					    'success'
					);
					EquipmentList();
				}
			}
		});
	});
};

var NewEquipment = function()
{	
	ResetFields();

	$('.btn-save').text(validate_btn);
	$('#equipment_id').val("");
	$('#Equipment').val("");
	$('#Equipment').focus();
	$('#EquipmentModal').modal('show');
};

var EditEquipment = function(id)
{	
	ResetFields();
    
	$.get(route+"/"+id+"/edit", function(data){
		$('.modal-title').text(EquipmentEditText);	
		$('.btn-save').text(validmodif_btn);
		$('#equipment_id').val(data.id);
		$('#Equipment').val(data.name);
		$('#Equipment').focus();
		$('#EquipmentModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveEquipment").click(function(e)
{
	var id = $("#equipment_id").val();
	var Saveroute = route;
	var token = $("#token").val();
	var form = $('#frmEquipment');
	var formData = form.serialize();
	var state = $('#saveEquipment').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		type = 'PUT';
		Saveroute = route+"/"+id;
	}

	$.ajax({
		url: Saveroute,
		headers: {'X-CSRF-TOKEN': token},
		type: type,
		data : formData,
		success: function(data){
			if (data.success == 'true')
			{
				EquipmentList();
				$("#EquipmentModal").modal('toggle');
				$('#frmEquipment').trigger('reset');
				$('#Equipment').focus();

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
                var input = '#frmEquipment input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmEquipment textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmEquipment select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
})