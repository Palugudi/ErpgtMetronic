// Afficher la liste  des types de documents
$(document).ready(function(){
	DocumentTypeList();
});

// Fonction pour afficher la liste des types de documents
var DocumentTypeList = function()
{
	$.ajax({
		type:'get',
		url: routeDocumentTypesAjax,
		success: function(data){
			$('#documentList').empty().html(data);
			DataTable('#DocumentTypeTable');
		}
	});
}

var DeleteDocumentType = function(id)
{
	swal({
	  title: DocumentDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routeDocumentTypes+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    DocumentDeletedText,
					    'success'
					);
					DocumentTypeList();
				}
			}
		});
	});
};

var NewDocumentType = function()
{	
	ResetFields();

	$('.btn-save').text(validate_btn);
	$('.modal-title').text(DocumentAddText);
	$('#documenttype_id').val("");
	$('#Document_type').val("");
	$('#Icon').val("");
	$('#image_preview').find('.thumbnail').addClass('hidden');
	$('#Document_type').focus();
	$('#DocumentTypeModal').modal('show');
};

var EditDocumentType = function(id)
{	
	ResetFields();
    
	$.get(routeDocumentTypes+"/"+id+"/edit", function(data){
		$('.modal-title').text(DocumentEditText);
		$('.btn-save').text(validmodif_btn);
		$('#documenttype_id').val(data.id);
		$('#Document_type').val(data.name);
		$('#Icon').val("");
		$('#image_preview').find('.thumbnail').addClass('hidden');
		$('#Document_type').focus();
		$('#DocumentTypeModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveDocumentType").click(function(e)
{
	var form = $('#frmDocumentType')[0];
	var formData = new FormData(form);
	formData.append('Icon', $('#Icon')[0].files[0]); 
	var id = $("#documenttype_id").val();
	var Saveroute = routeDocumentTypes;
	var token = $("#token").val();
	var state = $('#saveDocumentType').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = routeDocumentTypes+"/"+id;
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
				DocumentTypeList();
				$("#DocumentTypeModal").modal('toggle');
				$('#frmDocumentType').trigger('reset');
				$('#Document_type').focus();

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
                var input = '#frmDocumentType input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmDocumentType textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmDocumentType select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
})

$(function () {
    // A chaque sélection de fichier
    $('#frmDocumentType').find('#Icon').on('change', function (e) {
        var files = $(this)[0].files;
 
        if (files.length > 0) {
            // On part du principe qu'il n'y qu'un seul fichier
            // étant donné que l'on a pas renseigné l'attribut "multiple"
            var file = files[0],
                $image_preview = $('#image_preview');
 
            // Ici on injecte les informations recoltées sur le fichier pour l'utilisateur
            $image_preview.find('.thumbnail').removeClass('hidden');
            $image_preview.find('img').attr('src', window.URL.createObjectURL(file));
        }
    });
});