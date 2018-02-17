$(document).ready(function(){
	PictureList();
	Report_documentList();
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

	$('#saveReport_picture').button('reset');
	$('.btn-save').text(validate_btn);
	$('#report_picture_id').val("");
	$('#Report_pictureModal').modal('show');
};

var EditPicture = function(id)
{	
	ResetFields();

	$('#saveReport_picture').button('reset');
	$.get(routePicture+"/"+id+"/edit", function(data){
		$('#reportPictureModalTitle').text(PictureEditText);
		$('.btn-save').text(validmodif_btn);
		$('#report_picture_id').val(data.id);
		$('#Report_pictureModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveReport_picture").click(function(e)
{
	var form = $('#frmReport_picture')[0];
	var formData = new FormData(form);
	console.log(formData);
	var id = $("#report_picture_id").val();
	var Saveroute = routePicture;
	var state = $('#saveReport_picture').text();
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
				$("#Report_pictureModal").modal('toggle');
				$('#frmReport_picture').trigger('reset');
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
                var input = '#frmReport_picture input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmReport_picture textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmReport_picture select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
});



// Fonction pour afficher la liste
var Report_documentList = function()
{
	$.ajax({
		type:'get',
		url: routeReport_documentAjax,
		success: function(data){
			$('#report_documentList').empty().html(data);
		}
	});
}

var DeleteReport_document = function(id)
{
	swal({
	  title: Report_documentDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routeReport_document+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    Report_documentDeletedText,
					    'success'
					);
					Report_documentList();
				}
			}
		});
	});
};

var NewReport_document = function()
{	
	ResetFields();

	$('.btn-save').text(validate_btn);
	$('#report_document_id').val("");
	$('#Report_document').val("");
	$('#Document_type').val("");
	$('#Report_document').focus();
	$('#Report_documentModal').modal('show');
};

var EditReport_document = function(id)
{	
	ResetFields();

	$.get(routeReport_document+"/"+id+"/edit", function(data){
		$('#planningModalTitle').text(Report_documentEditText);
		$('.btn-save').text(validmodif_btn);
		$('#report_document_id').val(data.id);
		$('#Report_document').val(data.name);
		$('#Report_document').focus();
		$('#Report_documentModal').modal('show');
	});
};

$("#saveReport_document").click(function(e)
{
	var form = $('#frmReport_document')[0];
	var formData = new FormData(form);
	var id = $("#report_document_id").val();
	var Saveroute = routeReport_document;
	var state = $('#saveReport_document').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = routeReport_document+"/"+id;
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
				Report_documentList();
				$("#Report_documentModal").modal('toggle');
				$('#frmReport_document').trigger('reset');
				$('#report_document').focus();

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
                var input = '#frmReport_document input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmReport_document textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmReport_document select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
});