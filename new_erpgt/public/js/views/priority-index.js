// Afficher la liste
$(document).ready(function(){
	PriorityList();
});

// Fonction pour afficher la liste
var PriorityList = function()
{
	$.ajax({
		type:'get',
		url: routePriorityAjax,
		success: function(data){
			$('#priorityList').empty().html(data);
			DataTable('#PriorityTable');
		}
	});
}

var DeletePriority = function(id)
{
	swal({
	  title: PriorityDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routePriority+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    PriorityDeletedText,
					    'success'
					);
					PriorityList();
				}
			}
		});
	});
};

var NewPriority = function()
{	
	ResetFields();
	
	$('.modal-title').text(PriorityAddText);
	$('.btn-save').text(validate_btn);
	$('#priority_id').val("");
	$('#Priority').val("");
	$('#Priority').focus();
	$('#PriorityModal').modal('show');
};

var EditPriority = function(id)
{	
	ResetFields();
    
	$.get(routePriority+"/"+id+"/edit", function(data){
		$('.modal-title').text(PriorityEditText);
		$('.btn-save').text(validmodif_btn);
		$('#priority_id').val(data.id);
		$('#Priority').val(data.name);
		$('#Priority').focus();
		$('#PriorityModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#savePriority").click(function(e)
{
	var form = $('#frmPriority')[0];
	var formData = new FormData(form);
	var id = $("#priority_id").val();
	var Saveroute = routePriority;
	var state = $('#savePriority').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = routePriority+"/"+id;
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
				PriorityList();
				$("#PriorityModal").modal('toggle');
				$('#frmPriority').trigger('reset');
				$('#priority').focus();

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
                var input = '#frmPriority input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmPriority textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmPriority select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
})