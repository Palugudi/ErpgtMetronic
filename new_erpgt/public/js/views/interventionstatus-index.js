// Afficher la liste
$(document).ready(function(){
	InterventionstatusList();
});

// Fonction pour afficher la liste
var InterventionstatusList = function()
{
	$.ajax({
		type:'get',
		url: routeInterventionstatusAjax,
		success: function(data){
			$('#interventionstatusList').empty().html(data);
			DataTable('#InterventionStatusTable');
		}
	});
}

var DeleteInterventionstatus = function(id)
{
	swal({
	  title: InterventionstatusDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routeInterventionstatus+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    InterventionstatusDeletedText,
					    'success'
					);
					InterventionstatusList();
				}
			}
		});
	});
};

var NewInterventionstatus = function()
{	
	ResetFields();

	$('.modal-title').text(InterventionstatusAddText);
	$('.btn-save').text(validate_btn);
	$('#interventionstatus_id').val("");
	$('#Interventionstatus').val("");
	$('#Interventionstatus').focus();
	$('#InterventionstatusModal').modal('show');
};

var EditInterventionstatus = function(id)
{	
	ResetFields();
    
	$.get(routeInterventionstatus+"/"+id+"/edit", function(data){
		$('.modal-title').text(InterventionstatusEditText);
		$('.btn-save').text(validmodif_btn);
		$('#interventionstatus_id').val(data.id);
		$('#Interventionstatus').val(data.name);
		$('#Interventionstatus').focus();
		$('#InterventionstatusModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveInterventionstatus").click(function(e)
{
	var form = $('#frmInterventionstatus')[0];
	var formData = new FormData(form);
	var id = $("#interventionstatus_id").val();
	var Saveroute = routeInterventionstatus;
	var state = $('#saveInterventionstatus').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = routeInterventionstatus+"/"+id;
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
				InterventionstatusList();
				$("#InterventionstatusModal").modal('toggle');
				$('#frmInterventionstatus').trigger('reset');
				$('#interventionstatus').focus();

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
                var input = '#frmInterventionstatus input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmInterventionstatus textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmInterventionstatus select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
})