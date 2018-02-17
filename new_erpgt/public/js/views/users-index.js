// Afficher la liste
$(document).ready(function(){
	UserList();
});

// Fonction pour afficher la liste
var UserList = function()
{
	$.ajax({
		type:'get',
		url: routeUserAjax,
		success: function(data){
			$('#UserList').empty().html(data);
			console.log(data);
			//DataTable('#UserTable');
			DataTableListUsers.init();
		}
	});
}

////////////////////
//== Class definition

////////
//== Class definition
var DataTableListUsers = function() {
	//== Private functions
  
	// demo initializer
	var demo = function() {
  
	  var datatable = $('.table').mDatatable({
		data: {
		  saveState: {cookie: false},
		},
		search: {
		  input: $('#generalSearch'),
		},
		columns: [
		  {
			field: 'Deposit Paid',
			type: 'number',
		  },
		  {
			field: 'Order Date',
			type: 'date',
			format: 'YYYY-MM-DD',
		  },
		],
	  });
	};
  
	return {
	  //== Public functions
	  init: function() {
		// init dmeo
		demo();
	  },
	};
  }();
////////
///////////////////

// var DeleteUser = function(id)
// {
// 	swal({
// 	  title: UserDeleteText,
// 	  text: noReturnBackText,
// 	  type: 'warning',
// 	  showCancelButton: true,
// 	  confirmButtonColor: '#3085d6',
// 	  cancelButtonColor: '#d33',
// 	  cancelButtonText: cancelText,
// 	  confirmButtonText: yesDeleteText
// 	}).then(function () {
// 		$.ajax({
// 			url: routeUser+"/"+id,
// 			headers: {'X-CSRF-TOKEN': token},
// 			type: 'DELETE',
// 			data: id,
// 			success:function(data){
// 				if (data.success == 'true') 
// 				{
// 					swal(
// 					    deletedText,
// 					    UserDeletedText,
// 					    'success'
// 					);
// 					UserList();
// 				}
// 			}
// 		});
// 	});
// };

var NewUser = function()
{
	$('#UserModalTitle').text(UserAddText);
	$('.btn-save').text(validate_btn);
	$('#user_id').val("");
	$('#First_name').val("");
	$('#Last_name').val("");
	$('#Job').val("");
	$('#Email').val("");
	$('#Phone').val("");
	$('#First_name').focus();
	$( "#Intern_contact" ).prop( "checked", true );
	$('#intern_contact_div').toggle(true);
	$('#extern_contact_div').toggle(false);
	$('#CompanyName').val("");
	$('#CompanyAddress').val("");
	$('#CompanyPostalCode').val("");
	$('#CompanyCity').val("");
	$('#InterventionDomain').val("");
	$('#UserModal').modal('show');
};

$("#saveUser").click(function(e)
{
	var form = $('#frmUser');
	var formData = form.serialize();
	var id = $("#user_id").val();
	var Saveroute = routeUser;
	var state = $('#saveUser').text();
	var type = 'POST';

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		type = 'PUT';
		Saveroute = routeUser+"/"+id+"/update";
	}

	$.ajax({
		url: Saveroute,
		headers: {'X-CSRF-TOKEN': token},
		type: type,
		data : formData,
		success: function(data){
			if (data.success == 'true')
			{
				UserList();
				$("#UserModal").modal('toggle');
				$('#frmUser').trigger('reset');
				$('#User').focus();

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
                var input = '#frmUser input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmUser textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmUser select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
});

$("#Intern_contact").change(function () {
    $('#extern_contact_div').toggle();
    $('#intern_contact_div').toggle();
});


$("#changePassword").click(function(e)
{
	var form = $('#frmPassword');
	var formData = form.serialize();
	var id = $("#user_id").val();
	var Saveroute = routePassword;
	var state = $('#changePassword').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');

	$.ajax({
		url: Saveroute,
		headers: {'X-CSRF-TOKEN': token},
		type: type,
		data : formData,
		success: function(data){
			if (data.success == 'true')
			{
				location.reload();
				$('#frmPassword').trigger('reset');

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
                var input = '#frmPassword input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmPassword textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmPassword select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
});

// var EditUser = function(id)
// {
// 	$.get(routeUser+"/"+id+"/edit", function(data){
// 		$('.modal-title').text(UserEditText);
// 		$('.btn-save').text(validmodif_btn);
// 		$('#User_id').val(data.id);
// 		$('#First_name').val(data.first_name);
// 		$('#Last_name').val(data.last_name);
// 		$('#Job').val(data.job);
// 		$('#Email').val(data.email);
// 		$('#Number').val(data.number);
// 		$('#First_name').focus();
// 		$('#UserModal').modal('show');
// 	});
// };

// // Fonction pour faire un update ou une création
// $("#saveUser").click(function(e)
// {
// 	var form = $('#frmUser')[0];
// 	var formData = new FormData(form);
// 	var id = $("#User_id").val();
// 	var Saveroute = routeUser;
// 	var state = $('#saveUser').text();
// 	var type = 'POST'

// 	e.preventDefault();
// 	$('input+small').text('');
//     $('input').parent().removeClass('has-error');
	
// 	if (state!=validate_btn){
// 		Saveroute = routeUser+"/"+id;
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
// 				UserList();
// 				$("#UserModal").modal('toggle');
// 				$('#frmUser').trigger('reset');
// 				$('#User').focus();

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
//                 var input = '#frmUser input[name=' + key + ']';
//                 $(input + '+small').text(value);
//                 $(input).parent().addClass('has-error');

//                 var textarea = '#frmUser textarea[name=' + key + ']';
//                 $(textarea + '+small').text(value);
//                 $(textarea).parent().addClass('has-error');

//                 var select = '#frmUser select[name=' + key + ']';
//                 $(select + '+small').text(value);
//                 $(select).parent().addClass('has-error');
//             });
// 		}
// 	});
// })