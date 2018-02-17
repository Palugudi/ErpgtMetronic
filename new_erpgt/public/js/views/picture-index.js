// Afficher la liste
$(document).ready(function(){
	PictureList();
});

// Fonction pour afficher la liste
var PictureList = function()
{
	$.ajax({
		type:'get',
		url: routePictureAjax,
		success: function(data){
			$('#pictureList').empty().html(data);
		}
	});
}

var DeletePicture = function(id)
{
	swal({
	  title: PictureDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routePicture+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    PictureDeletedText,
					    'success'
					);
					PictureList();
				}
			}
		});
	});
};

var NewPicture = function()
{	
	ResetFields();

	$('#savePicture').button('reset');
	$('.btn-save').text(validate_btn);
	$('#picture_id').val("");
	$('#Picture').val("");
	$('#Picture').focus();
	$('#PictureModal').modal('show');
};

var EditPicture = function(id)
{	
	ResetFields();
	
	$('#savePicture').button('reset');
	$.get(routePicture+"/"+id+"/edit", function(data){
		$('.modal-title').text(PictureEditText);
		$('.btn-save').text(validmodif_btn);
		$('#picture_id').val(data.id);
		$('#Picture').focus();
		$('#PictureModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#savePicture").click(function(e)
{
	var form = $('#frmPicture')[0];
	var formData = new FormData(form);
	var id = $("#picture_id").val();
	var Saveroute = routePicture;
	var state = $('#savePicture').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = routePicture+"/"+id;
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
				PictureList();
				$("#PictureModal").modal('toggle');
				$('#frmPicture').trigger('reset');
				$('#picture').focus();

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
                var input = '#frmPicture input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmPicture textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmPicture select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
});