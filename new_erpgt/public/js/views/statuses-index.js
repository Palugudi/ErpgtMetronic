// Afficher la liste des questions
$(document).ready(function(){
	StatusList();
});

// Fonction pour afficher la liste des questions
var StatusList = function()
{
	$.ajax({
		type:'get',
		url: routeAjax,
		success: function(data){
			$('#statusList').empty().html(data);
			DataTable('#StatusesTable');
		}
	});
}

var DeleteStatus = function(id)
{
	swal({
	  title: StatusesDeleteText,
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
					    StatusesDeletedText,
					    'success'
					);
					StatusList();
				}
			}
		});
	});
};

var NewStatus = function()
{	
	ResetFields();

	$('.modal-title').text(StatusesAddText);
	$('.btn-save').text(validate_btn);
	$('#status_id').val("");
	$('#Status').val("");
	$('#Status').focus();
	$('#StatusModal').modal('show');
};

var EditStatus = function(id)
{	
	ResetFields();
	
	$.get(route+"/"+id+"/edit", function(data){
		$('.modal-title').text(StatusesEditText);
		$('.btn-save').text(validmodif_btn);
		$('#status_id').val(data.id);
		$('#Status').val(data.name);
		$('#Status').focus();
		$('#StatusModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveStatus").click(function(e)
{
	var id = $("#status_id").val();
	var Saveroute = route;
	var token = $("#token").val();
	var form = $('#frmStatus');
	var formData = form.serialize();
	var state = $('#saveStatus').text();
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
				StatusList();
				$("#StatusModal").modal('toggle');
				$('#frmStatus').trigger('reset');
				$('#Status').focus();

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
                var input = '#frmStatus input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmStatus textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmStatus select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
})