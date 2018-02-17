// Afficher la liste des questions
$(document).ready(function(){
	LocalisationList();
});

// Fonction pour afficher la liste des questions
var LocalisationList = function()
{
	$.ajax({
		type:'get',
		url: routeAjax,
		success: function(data){
			$('#localisationList').empty().html(data);
			DataTable('#LocalisationTable');
			DataTableListLocal.init();
		}
	});
}

var DataTableListLocal = function() {
	//== Private functions
  
	// demo initializer
	var demo = function() {
  
	  var datatable = $('#LocalisationTable').mDatatable({
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


var DeleteLocalisation = function(id)
{
	swal({
	  title: LocalisationDeleteText,
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
					   LocalisationDeletedText,
					    'success'
					);
					LocalisationList();
				}
			}
		});
	});
};

var NewLocalisation = function()
{	
	ResetFields();

	$('.modal-title').text(LocalisationAddText);
	$('.btn-save').text(validate_btn);
	$('#localisation_id').val("");
	$('#Localisation').val("");
	$('#Localisation').focus();
	$('#LocalisationModal').modal('show');
};

var EditLocalisation = function(id)
{	
	ResetFields();
    
	$.get(route+"/"+id+"/edit", function(data){
		$('.modal-title').text(LocalisationEditText);
		$('.btn-save').text(validmodif_btn);
		$('#localisation_id').val(data.id);
		$('#Localisation').val(data.name);
		$('#Localisation').focus();
		$('#LocalisationModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveLocalisation").click(function(e)
{
	var id = $("#localisation_id").val();
	var Saveroute = route;
	var token = $("#token").val();
	var form = $('#frmLocalisation');
	var formData = form.serialize();
	var state = $('#saveLocalisation').text();
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
				LocalisationList();
				$("#LocalisationModal").modal('toggle');
				$('#frmLocalisation').trigger('reset');
				$('#Localisation').focus();

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
                var input = '#frmLocalisation input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmLocalisation textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmLocalisation select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
})