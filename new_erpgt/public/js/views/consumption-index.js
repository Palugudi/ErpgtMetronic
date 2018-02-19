// Afficher la liste
$(document).ready(function(){  
	ConsumptionList();
	
    $('#Consumption_date').datetimepicker({
    	locale: LocaleLanguage,
    	format: "L"
	});
});

// Fonction pour afficher les listes et graphes
var ConsumptionList = function()
{
	$.ajax({
		type:'get',
		url: routeConsumptionWaterAjax,
		success: function(data){
			$('#waterList').empty().html(data);
			// DataTable('#WaterTable');
			DataTableM.init('#WaterTable');
		}
	});

	$.ajax({
		type:'get',
		url: routeConsumptionGasAjax,
		success: function(data){
			$('#gasList').empty().html(data);
			// DataTable('#GasTable');
			DataTableM.init('#GasTable');
		}
	});

	$.ajax({
		type:'get',
		url: routeConsumptionElecHpAjax,
		success: function(data){
			$('#elecHPList').empty().html(data);
			// DataTable('#ElecHPTable');
			DataTableM.init('#ElecHPTable');
		}
	});

	$.ajax({
		type:'get',
		url: routeConsumptionElecHcAjax,
		success: function(data){
			$('#elecHCList').empty().html(data);
			// DataTable('#ElecHCTable');
			DataTableM.init('#ElecHCTable');
		}
	});

	$.ajax({
		type:'get',
		url: routeGraphWater,
		success: function(data){
			$('#waterGraph').empty().html(data);
		}
	});

	$.ajax({
		type:'get',
		url: routeGraphGas,
		success: function(data){
			$('#gasGraph').empty().html(data);
		}
	});

	$.ajax({
		type:'get',
		url: routeGraphElecHp,
		success: function(data){
			$('#elecHPGraph').empty().html(data);
		}
	});

	$.ajax({
		type:'get',
		url: routeGraphElecHc,
		success: function(data){
			$('#elecHCGraph').empty().html(data);
		}
	});

}

var DeleteConsumption = function(id)
{
	swal({
	  title: ConsumptionDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routeConsumption+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    ConsumptionDeletedText,
					    'success'
					);
					ConsumptionList();
				}
			}
		});
	});
};

var NewConsumption = function()
{
	ResetFields();

	$('.btn-save').text(validate_btn);
	$('#consumption_id').val("");
	$('#Consumption').val("");
	$('#Consumption').focus();
	$('#ConsumptionModal').modal('show');
};

var EditConsumption = function(id)
{	
	ResetFields();
    
	$.get(routeConsumption+"/"+id+"/edit", function(data){
		var date = data.date;
	   	if(LocaleLanguage == "en") {
			var dateFinale = date.substring(5,7)+"/"+date.substring(8,10)+"/"+date.substring(0,4);
		} else if (LocaleLanguage == "fr") {
			var dateFinale = date.substring(8,10)+"/"+date.substring(5,7)+"/"+date.substring(0,4);
		}
		$('.modal-title').text(ConsumptionEditText);
		$('.btn-save').text(validmodif_btn);
		$('#consumption_id').val(data.id);
		$('#Consumption_date').val(dateFinale);
		$('#Energy').val(data.energy_id);
		$('#Consumption').val(data.statement);
		$('#Comment').val(data.comment);
		$('#Consumption_date').focus();
		$('#ConsumptionModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveConsumption").click(function(e)
{
	var form = $('#frmConsumption')[0];
	var formData = new FormData(form);
	var id = $("#consumption_id").val();
	var Saveroute = routeConsumption;
	var state = $('#saveConsumption').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = routeConsumption+"/"+id;
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
				ConsumptionList();
				$("#ConsumptionModal").modal('toggle');
				$('#frmConsumption').trigger('reset');
				$('#consumption').focus();

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
                var input = '#frmConsumption input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmConsumption textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmConsumption select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
})

var DataTableM = function() {
	//== Private functions
  
	// demo initializer
	var demo = function(class_name) {
  
	  var datatable = $(class_name).mDatatable({
		data: {
		  saveState: {cookie: false},
		},
		search: {
		  input: $('#generalSearch'),
		},
	  });
	};
  
	return {
	  //== Public functions
	  init: function(class_name) {
		// init dmeo
		demo(class_name);
	  },
	};
  }();
////////
