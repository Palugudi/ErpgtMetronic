// Afficher la liste
$(document).ready(function(){
	ContactList();
});

// Fonction pour afficher la liste
var ContactList = function()
{
	$.ajax({
		type:'get',
		url: routeContactAjax,
		success: function(data){
			$('#contactList').empty().html(data);
			DataTable('#ContactTable');
		}
	});
}

// var DeleteContact = function(id)
// {
// 	swal({
// 	  title: ContactDeleteText,
// 	  text: noReturnBackText,
// 	  type: 'warning',
// 	  showCancelButton: true,
// 	  confirmButtonColor: '#3085d6',
// 	  cancelButtonColor: '#d33',
// 	  cancelButtonText: cancelText,
// 	  confirmButtonText: yesDeleteText
// 	}).then(function () {
// 		$.ajax({
// 			url: routeContact+"/"+id,
// 			headers: {'X-CSRF-TOKEN': token},
// 			type: 'DELETE',
// 			data: id,
// 			success:function(data){
// 				if (data.success == 'true') 
// 				{
// 					swal(
// 					    deletedText,
// 					    ContactDeletedText,
// 					    'success'
// 					);
// 					ContactList();
// 				}
// 			}
// 		});
// 	});
// };

// var NewContact = function()
// {
// 	$('.btn-save').text(validate_btn);
// 	$('#contact_id').val("");
// 	$('#First_name').val("");
// 	$('#Last_name').val("");
// 	$('#Job').val("");
// 	$('#Email').val("");
// 	$('#Number').val("");
// 	$('#First_name').focus();
// 	$('#ContactModal').modal('show');
// };

// var EditContact = function(id)
// {
// 	$.get(routeContact+"/"+id+"/edit", function(data){
// 		$('.modal-title').text(ContactEditText);
// 		$('.btn-save').text(validmodif_btn);
// 		$('#contact_id').val(data.id);
// 		$('#First_name').val(data.first_name);
// 		$('#Last_name').val(data.last_name);
// 		$('#Job').val(data.job);
// 		$('#Email').val(data.email);
// 		$('#Number').val(data.number);
// 		$('#First_name').focus();
// 		$('#ContactModal').modal('show');
// 	});
// };

// // Fonction pour faire un update ou une création
// $("#saveContact").click(function(e)
// {
// 	var form = $('#frmContact')[0];
// 	var formData = new FormData(form);
// 	var id = $("#contact_id").val();
// 	var Saveroute = routeContact;
// 	var state = $('#saveContact').text();
// 	var type = 'POST'

// 	e.preventDefault();
// 	$('input+small').text('');
//     $('input').parent().removeClass('has-error');
	
// 	if (state!=validate_btn){
// 		Saveroute = routeContact+"/"+id;
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
// 				ContactList();
// 				$("#ContactModal").modal('toggle');
// 				$('#frmContact').trigger('reset');
// 				$('#contact').focus();

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
//                 var input = '#frmContact input[name=' + key + ']';
//                 $(input + '+small').text(value);
//                 $(input).parent().addClass('has-error');

//                 var textarea = '#frmContact textarea[name=' + key + ']';
//                 $(textarea + '+small').text(value);
//                 $(textarea).parent().addClass('has-error');

//                 var select = '#frmContact select[name=' + key + ']';
//                 $(select + '+small').text(value);
//                 $(select).parent().addClass('has-error');
//             });
// 		}
// 	});
// })