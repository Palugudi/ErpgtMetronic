$(document).ready(function(){
	InterventionList();
	SiteList();
});

var InterventionList = function()
{
	$.ajax({
		type:'get',
		url: routeAjaxIntervention,
		success: function(data){
			$('#intervention_fill').empty().html(data);
			DataTable('#InterventionTable');
		}
	});
};

var SiteList = function()
{
	$.ajax({
		type:'get',
		url: routeSiteAjax,
		success: function(data){
			$('#sites_fill').empty().html(data);
			DataTable('#SitesTable');
		}
	});
}

var EditUser = function(id)
{	
	ResetFields();

	$.get(routeUser+"/"+id+"/edit", function(data){

		$('#UserModalTitle').text(UserEditText);
		$('.btn-save').text(validmodif_btn);
		$('#user_id').val(data.id);
		$('#First_name').val(data.first_name);
		$('#Last_name').val(data.last_name);
		$('#Job').val(data.role_id);
		$('#Email').val(data.email);
		$('#Phone').val(data.phone);
		$('#First_name').focus();
		if(data.map_creator == 1) {
			$('#Map_creator').prop("checked", true);
		} else {
			$('#Map_creator').prop("checked", false);
		}
		if(data.intern_contact == 1) {
			$( "#Intern_contact" ).prop( "checked", true );
			$('#extern_contact_div').toggle(false);
			$('#intern_contact_div').toggle(true);
		} else {
			$( "#Intern_contact" ).prop( "checked", false );
			$('#intern_contact_div').toggle(false);
			$('#extern_contact_div').toggle(true);
			$('#CompanyName').val(data.company_name);
			$('#CompanyAddress').val(data.company_address);
			$('#CompanyPostalCode').val(data.company_postal_code);
			$('#CompanyCity').val(data.company_city);
			$('#InterventionDomain').val(data.intervention_domain);
		}
		$('#UserModal').modal('show');
	});
};

$("#saveUser").click(function(e)
{
		var form = $('#frmUser');
	var formData = form.serialize();
	var id = $("#user_id").val();
	var Saveroute = routeUser;
	var state = $('#saveUser').text();
	var type = 'POST'

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
				location.reload();
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


// Sites :

var DeleteUserSite = function(id)
{
	swal({
	  title: UserSiteDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routeDeleteSiteLink+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    UserSiteDeletedText,
					    'success'
					);
					SiteList();
				}
			}
		});
	});
};

var NewUserSite = function(id)
{	
	ResetFields();
	
	$('#UserSiteModalTitle').text(UserSiteAddText);
	$('.btn-save').text(validate_btn);
	$('#user_id').val(id);
	$('#site_id').val("");
	$('#UserSiteModal').modal('show');
};

// Fonction pour faire un update ou une création
$("#saveUserSite").click(function(e)
{
	var id = $("#site_id").val();
	var Saveroute = routeAddSiteLink;
	var token = $("#token").val();
	var form = $('#frmUserSite');
	var formData = form.serialize();
	var state = $('#saveSite').text();
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
				SiteList();
				$("#UserSiteModal").modal('toggle');
				$('#frmUserSite').trigger('reset');
				$('#site').focus();

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
                var input = '#frmSite input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmSite textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmSite select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
});