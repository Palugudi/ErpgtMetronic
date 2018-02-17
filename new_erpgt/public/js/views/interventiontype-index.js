// Afficher la liste
$(document).ready(function(){
	InterventiontypeList();
});

// Fonction pour afficher la liste
var InterventiontypeList = function()
{
	$.ajax({
		type:'get',
		url: routeInterventiontypeAjax,
		success: function(data){
			$('#interventiontypeList').empty().html(data);
			DataTable('#InterventionTypeTable');
		}
	});
}

var DeleteInterventiontype = function(id)
{
	swal({
	  title: InterventiontypeDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routeInterventiontype+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    InterventiontypeDeletedText,
					    'success'
					);
					InterventiontypeList();
				}
			}
		});
	});
};

var NewInterventiontype = function()
{	
	ResetFields();

	$('.modal-title').text(InterventiontypeAddText);
	$('.btn-save').text(validate_btn);
	$('#interventiontype_id').val("");
	$('#Interventiontype').val("");
	$('#Interventiontype').focus();
	$('#InterventiontypeModal').modal('show');
};

var EditInterventiontype = function(id)
{	
	ResetFields();
    
	$.get(routeInterventiontype+"/"+id+"/edit", function(data){
		$('.modal-title').text(InterventiontypeEditText);
		$('.btn-save').text(validmodif_btn);
		$('#interventiontype_id').val(data.id);
		$('#Interventiontype').val(data.name);
		$('#Interventiontype').focus();
		$('#InterventiontypeModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveInterventiontype").click(function(e)
{
	var form = $('#frmInterventiontype')[0];
	var formData = new FormData(form);
	var id = $("#interventiontype_id").val();
	var Saveroute = routeInterventiontype;
	var state = $('#saveInterventiontype').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = routeInterventiontype+"/"+id;
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
				InterventiontypeList();
				$("#InterventiontypeModal").modal('toggle');
				$('#frmInterventiontype').trigger('reset');
				$('#interventiontype').focus();

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
                var input = '#frmInterventiontype input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmInterventiontype textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmInterventiontype select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
})