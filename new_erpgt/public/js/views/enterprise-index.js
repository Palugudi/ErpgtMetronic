// Afficher la liste
$(document).ready(function(){
	EnterpriseList();
});

// Fonction pour afficher la liste
var EnterpriseList = function()
{
	$.ajax({
		type:'get',
		url: routeEnterpriseAjax,
		success: function(data){
			$('#enterpriseList').empty().html(data);
			DataTable('#EntrepriseTable');
		}
	});
}

// var DeleteEnterprise = function(id)
// {
// 	swal({
// 	  title: EnterpriseDeleteText,
// 	  text: noReturnBackText,
// 	  type: 'warning',
// 	  showCancelButton: true,
// 	  confirmButtonColor: '#3085d6',
// 	  cancelButtonColor: '#d33',
// 	  cancelButtonText: cancelText,
// 	  confirmButtonText: yesDeleteText
// 	}).then(function () {
// 		$.ajax({
// 			url: routeEnterprise+"/"+id,
// 			headers: {'X-CSRF-TOKEN': token},
// 			type: 'DELETE',
// 			data: id,
// 			success:function(data){
// 				if (data.success == 'true') 
// 				{
// 					swal(
// 					    deletedText,
// 					    EnterpriseDeletedText,
// 					    'success'
// 					);
// 					EnterpriseList();
// 				}
// 			}
// 		});
// 	});
// };

// var NewEnterprise = function()
// {
// 	$('.btn-save').text(validate_btn);
// 	$('#enterprise_id').val("");
// 	$('#Company').val("");
// 	$('#Contact_first_name').val("");
// 	$('#Contact_last_name').val("");
// 	$('#Contact_email').val("");
// 	$('#Contact_number').val("");
// 	$('#Address').val("");
// 	$('#Postal_code').val("");
// 	$('#City').val("");
// 	$('#Activity_domain').val("");
// 	$('#Company').focus();
// 	$('#EnterpriseModal').modal('show');
// };

// var EditEnterprise = function(id)
// {
// 	$.get(routeEnterprise+"/"+id+"/edit", function(data){
// 		$('.modal-title').text(EnterpriseEditText);
// 		$('.btn-save').text(validmodif_btn);
// 		$('#enterprise_id').val(data.id);
// 		$('#Company').val(data.company);
// 		$('#Contact_first_name').val(data.contact_first_name);
// 		$('#Contact_last_name').val(data.contact_last_name);
// 		$('#Contact_email').val(data.contact_email);
// 		$('#Contact_number').val(data.contact_number);
// 		$('#Address').val(data.address);
// 		$('#Postal_code').val(data.postal_code);
// 		$('#City').val(data.city);
// 		$('#Activity_domain').val(data.activity_domain);
// 		$('#Enterprise').focus();
// 		$('#EnterpriseModal').modal('show');
// 	});
// };

// Fonction pour faire un update ou une création
// $("#saveEnterprise").click(function(e)
// {
// 	var form = $('#frmEnterprise')[0];
// 	var formData = new FormData(form);
// 	var id = $("#enterprise_id").val();
// 	var Saveroute = routeEnterprise;
// 	var state = $('#saveEnterprise').text();
// 	var type = 'POST'

// 	e.preventDefault();
// 	$('input+small').text('');
//     $('input').parent().removeClass('has-error');
	
// 	if (state!=validate_btn){
// 		Saveroute = routeEnterprise+"/"+id;
// 	}

// 	$.ajax({
// 		url: Saveroute,
// 		headers: {'X-CSRF-TOKEN': token},
// 		type: type,
// 		data : formData,
// 		contentType: false,
//     	processData: false,
// 		success: function(data){
// 			if (data.success == 'true')
// 			{
// 				EnterpriseList();
// 				$("#EnterpriseModal").modal('toggle');
// 				$('#frmEnterprise').trigger('reset');
// 				$('#enterprise').focus();

// 				if (state==validmodif_btn){
// 					$("#message-update").fadeIn();
// 					$('#message-update').show().delay(3000).fadeOut(1);
// 				}else {
// 					$("#message-new").fadeIn();
// 					$('#message-new').show().delay(3000).fadeOut(1);
// 				}
// 			}
// 		},
// 		error:function(data)
// 		{
// 			// Permet d'afficher les messages d'erreur sous les champs
// 			$.each(data.responseJSON, function (key, value) {
//                 var input = '#frmEnterprise input[name=' + key + ']';
//                 $(input + '+small').text(value);
//                 $(input).parent().addClass('has-error');

//                 var textarea = '#frmEnterprise textarea[name=' + key + ']';
//                 $(textarea + '+small').text(value);
//                 $(textarea).parent().addClass('has-error');

//                 var select = '#frmEnterprise select[name=' + key + ']';
//                 $(select + '+small').text(value);
//                 $(select).parent().addClass('has-error');
//             });
// 		}
// 	});
// })