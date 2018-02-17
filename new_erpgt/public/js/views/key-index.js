// Afficher la liste
$(document).ready(function(){
	KeyList();
});

// Fonction pour afficher la liste
var KeyList = function()
{
	$.ajax({
		type:'get',
		url: routeKeyAjax,
		success: function(data){
			$('#keyList').empty().html(data);
			DataTable('#KeyTable');
		}
	});
}

var DeleteKey = function(id)
{
	swal({
	  title: KeyDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routeKey+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    KeyDeletedText,
					    'success'
					);
					KeyList();
				}
			}
		});
	});
};

var NewKey = function(site_id)
{
	ResetFields();

	$('#myKeyModalLabel').text(KeyAddText);
	$('#saveKey').text(validate_btn);
	$('#key_id').val("");
	$('#site_id').val(site_id);
	$('#building').val("");
	$('#floor').val("");
	$('#designation').val("");
	$('#cylinder_number').val("");
	$('#key_number').val("");
	$('#comments').val("");
	$('#KeyModal').modal('show');
};

var EditKey = function(id)
{	

	ResetFields();
    	
	$.get(routeKey+"/"+id+"/edit", function(data){
		$('#myKeyModalLabel').text(KeyEditText);
		$('#saveKey').text(validmodif_btn);
		$('#key_id').val(data.id);
		$('#site_id').val(data.site_id);	
		$('#building').val(data.building);
		$('#floor').val(data.floor);
		$('#cylinder_number').val(data.cylinder_number);
		$('#key_number').val(data.key_number);
		$('#comments').val(data.comments);
		$('#designation').val(data.designation);
		$('#KeyModal').modal('show');
	});
};

var ShowQRCode = function()
{
	$('#myKeyQRModalLabel').text(KeyQRCodeText);
	$('#KeyQRModal').modal('show');
}

// Fonction pour faire un update ou une création
$("#saveKey").click(function(e)
{
	//var form = $('#frmKey')[0]; // Code lors d'un envoi de fichier
	//var formData = new FormData(form);
	var form = $('#frmKey');
	var formData = form.serialize();
	var id = $("#key_id").val();
	var Saveroute = routeKey;
	var state = $('#saveKey').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = routeKey+"/"+id;
	}

	$.ajax({
		url: Saveroute,
		headers: {'X-CSRF-TOKEN': token},
		type: type,
		data : formData,
		//contentType: false, // Code lors de l'envoi d'un fichier
    	//processData: false,
		success: function(data){
			if (data.success == 'true')
			{
				KeyList();
				$("#KeyModal").modal('toggle');
				$('#frmKey').trigger('reset');
				$('#key').focus();

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
                var input = '#frmKey input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmKey textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmKey select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
})