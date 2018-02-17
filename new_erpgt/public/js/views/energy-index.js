// Afficher la liste
$(document).ready(function(){
	EnergyList();
});

// Fonction pour afficher la liste
var EnergyList = function()
{
	$.ajax({
		type:'get',
		url: routeEnergyAjax,
		success: function(data){
			$('#energyList').empty().html(data);
			DataTable('#EnergyTable');
		}
	});
}

var DeleteEnergy = function(id)
{
	swal({
	  title: EnergyDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routeEnergy+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    EnergyDeletedText,
					    'success'
					);
					EnergyList();
				}
			}
		});
	});
};

var NewEnergy = function()
{	
	ResetFields();

	$('.btn-save').text(validate_btn);
	$('#energy_id').val("");
	$('#Energy').val("");
	$('#Energy').focus();
	$('#EnergyModal').modal('show');
};

var EditEnergy = function(id)
{	
	ResetFields();
    
	$.get(routeEnergy+"/"+id+"/edit", function(data){
		$('.modal-title').text(EnergyEditText);
		$('.btn-save').text(validmodif_btn);
		$('#energy_id').val(data.id);
		$('#Energy').val(data.name);
		$('#Energy').focus();
		$('#EnergyModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveEnergy").click(function(e)
{
	var form = $('#frmEnergy')[0];
	var formData = new FormData(form);
	var id = $("#energy_id").val();
	var Saveroute = routeEnergy;
	var state = $('#saveEnergy').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = routeEnergy+"/"+id;
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
				EnergyList();
				$("#EnergyModal").modal('toggle');
				$('#frmEnergy').trigger('reset');
				$('#energy').focus();

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
                var input = '#frmEnergy input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmEnergy textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmEnergy select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
})