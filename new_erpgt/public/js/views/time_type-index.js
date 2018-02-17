// Afficher la liste
$(document).ready(function(){
	Time_typeList();
});

// Fonction pour afficher la liste
var Time_typeList = function()
{
	$.ajax({
		type:'get',
		url: routeTime_typeAjax,
		success: function(data){
			$('#time_typeList').empty().html(data);
			DataTable('#TimeTypeTable');
		}
	});

}

var DeleteTime_type = function(id)
{
	swal({
	  title: Time_typeDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routeTime_type+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    Time_typeDeletedText,
					    'success'
					);
					Time_typeList();
				}
			}
		});
	});
};

var NewTime_type = function()
{	
	ResetFields();

	$('.modal-title').text(Time_typeAddText);
	$('.btn-save').text(validate_btn);
	$('#time_type_id').val("");
	$('#Time_type').val("");
	$('#Time_type').focus();
	$('#Time_typeModal').modal('show');
};

var EditTime_type = function(id)
{	
	ResetFields();
	
	$.get(routeTime_type+"/"+id+"/edit", function(data){
		$('.modal-title').text(Time_typeEditText);
		$('.btn-save').text(validmodif_btn);
		$('#time_type_id').val(data.id);
		$('#Time_type').val(data.name);
		$('#Time_type').focus();
		$('#Time_typeModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveTime_type").click(function(e)
{
	var form = $('#frmTime_type')[0];
	var formData = new FormData(form);
	var id = $("#time_type_id").val();
	var Saveroute = routeTime_type;
	var state = $('#saveTime_type').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = routeTime_type+"/"+id;
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
				Time_typeList();
				$("#Time_typeModal").modal('toggle');
				$('#frmTime_type').trigger('reset');
				$('#time_type').focus();

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
                var input = '#frmTime_type input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmTime_type textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmTime_type select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
})