// Afficher la liste
$(document).ready(function(){
	SiteList();
});

// Fonction pour afficher la liste
var SearchSiteList = function()
{
	$.ajax({
		type:'get',
		url: 'searchroute',
		success: function(data){
			$('#siteList').empty().html(data);
			//DataTableListSites.init();
		}
	});
}

// Fonction pour afficher la liste
var SiteList = function()  
{
	$.ajax({
		type:'get',
		url: routeAjax,
		success: function(data){
			$('#siteList').empty().html(data);
			//DataTable('#SitesTable');
			DataTableListSites.init();
		}
	});
}

////////
//== Class definition
var DataTableListSites = function() {
	//== Private functions
  
	// demo initializer
	var demo = function() {
  
	  var datatable = $('.m-datatables').mDatatable({
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

var DeleteSite = function(id)
{
	swal({
	  title: SiteDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: route+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    SiteDeletedText,
					    'success'
					);
					SiteList();
				}
			}
		});
	});
};

var NewSite = function()
{	
	ResetFields();

	$('.btn-save').text(validate_btn);
	$('#site_id').val("");
	$('#Site').val("");
	$('#Address').val("");
	$('#Postal_code').val("");
	$('#City').val("");
	$('#Phone').val("");
	$('#Email').val("");
	$('#Site').focus();
	$('#SiteModal').modal('show');
};

var EditSite = function(id)
{	
	ResetFields();
	
	$.get(route+"/"+id+"/edit", function(data){
		$('.modal-title').text(SiteEditText);
		$('.btn-save').text(validmodif_btn);
		$('#site_id').val(data.id);
		$('#Site').val(data.name);
		$('#Address').val(data.address);
		$('#Postal_code').val(data.postal_code);
		$('#City').val(data.city);
		$('#Phone').val(data.phone);
		$('#Email').val(data.email);
		$('#Site').focus();
		$('#SiteModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveSite").click(function(e)
{
	var id = $("#site_id").val();
	var Saveroute = route;
	var token = $("#token").val();
	var form = $('#frmSite');
	var formData = form.serialize();
	var state = $('#saveSite').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		type = 'PUT';
		Saveroute = route+"/"+id;
	}

	$.ajax({
		url: Saveroute,
		headers: {'X-CSRF-TOKEN': token},
		type: type,
		data : formData,
		success: function(data){
			if (data.success == 'true')
			{
				SiteList();
				$("#SiteModal").modal('toggle');
				$('#frmSite').trigger('reset');
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
})