// Afficher la liste des questions
$(document).ready(function(){
	DomainList();
});

// Fonction pour afficher la liste des questions
var DomainList = function()
{
	$.ajax({
		type:'get',
		url: routeAjax,
		success: function(data){
			$('#domainList').empty().html(data);
			//DataTable('#DomainTable');
			DataTableListDomain.init();
		}
	});
}

var DataTableListDomain = function() {
	//== Private functions
  
	// demo initializer
	var demo = function() {
  
	  var datatable = $('#DomainTable').mDatatable({
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

var DeleteDomain = function(id)
{
	swal({
	  title: DomainDeleteText,
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
					    DomainDeletedText,
					    'success'
					);
					DomainList();
				}
			}
		});
	});
};

var NewDomain = function()
{	
	ResetFields();

	$('.modal-title').text(DomainAddText);
	$('.btn-save').val(validate_btn);
	$('#domain_id').val("");
	$('#Domain').val("");
	$('#Icon').val("");
	$('#image_preview').find('.thumbnail').addClass('hidden');
	$('#Domain').focus();
	$('#DomainModal').modal('show');
};

var EditDomain = function(id)
{
	ResetFields();
    
	$.get(route+"/"+id+"/edit", function(data){
		$('.modal-title').text(DomainEditText);
		$('.btn-save').val(validmodif_btn);
		$('#domain_id').val(data.id);
		$('#Domain').val(data.name);
		$('#Icon').val("");
		$('#image_preview').find('.thumbnail').addClass('hidden');
		document.getElementById('color').jscolor.fromString(data.color);
		$('#Domain').focus();
		$('#DomainModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveDomain").click(function(e)
{
	var form = $('#frmDomain')[0];
	var formData = new FormData(form);
	formData.append('Icon', $('#Icon')[0].files[0]); 
	var id = $("#domain_id").val();
	var Saveroute = route;
	var state = $('.btn-save').val();
	var type = 'POST';

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = route+"/"+id;
	}

	$.post({
		url: Saveroute,
		headers: {'X-CSRF-TOKEN': token},
		data:formData,
		contentType: false,
    	processData: false,
		success: function(data){
			if (data.success == 'true')
			{
				DomainList();
				$("#DomainModal").modal('toggle');
				$('#frmDomain').trigger('reset');
				$('#Domain').focus();

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
                var input = '#frmDomain input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmDomain textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmDomain select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
})

$(function () {
    // A chaque sélection de fichier
    $('#frmDomain').find('#Icon').on('change', function (e) {
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