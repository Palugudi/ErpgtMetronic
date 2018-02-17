// Afficher la liste
$(document).ready(function(){
	Equipment_pictureList();
});

// Fonction pour afficher la liste
var Equipment_pictureList = function()
{
	$.ajax({
		type:'get',
		url: routeEquipment_pictureAjax,
		success: function(data){
			$('#equipment_pictureList').empty().html(data);
			//DataTable();
		}
	});
}

var DeleteEquipment_picture = function(id)
{
	swal({
	  title: Equipment_pictureDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routeEquipment_picture+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    Equipment_pictureDeletedText,
					    'success'
					);
					Equipment_pictureList();
				}
			}
		});
	});
};

var NewEquipment_picture = function()
{	
	ResetFields();

	$('.btn-save').text(validate_btn);
	$('#equipment_picture_id').val("");
	$('#Equipment_picture').val("");
	$('#Equipment_picture').focus();
	$('#Equipment_pictureModal').modal('show');
};

var EditEquipment_picture = function(id)
{	
	ResetFields();
    
	$.get(routeEquipment_picture+"/"+id+"/edit", function(data){
		$('.modal-title').text(Equipment_pictureEditText);
		$('.btn-save').text(validmodif_btn);
		$('#equipment_picture_id').val(data.id);
		$('#Equipment_picture').val(data.name);
		$('#Equipment_picture').focus();
		$('#Equipment_pictureModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveEquipment_picture").click(function(e)
{
	var form = $('#frmEquipment_picture')[0];
	var formData = new FormData(form);
	var id = $("#equipment_picture_id").val();
	var Saveroute = routeEquipment_picture;
	var state = $('#saveEquipment_picture').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = routeEquipment_picture+"/"+id;
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
				Equipment_pictureList();
				$("#Equipment_pictureModal").modal('toggle');
				$('#frmEquipment_picture').trigger('reset');
				$('#equipment_picture').focus();

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
                var input = '#frmEquipment_picture input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmEquipment_picture textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmEquipment_picture select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
})