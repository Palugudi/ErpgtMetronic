// Afficher la liste des questions
$(document).ready(function(){
	Equipment_typeList();
});

// Fonction pour afficher la liste des questions
var Equipment_typeList = function()
{
	$.ajax({
		type:'get',
		url: routeAjax,
		success: function(data){
			$('#equipment_typeList').empty().html(data);
			//DataTable('#EquipmentTypeTable');
			DataTableListEquipmentType.init();
		}
	});
}

var DataTableListEquipmentType = function() {
	//== Private functions
  
	// demo initializer
	var demo = function() {
  
	  var datatable = $('#EquipmentTypeTable').mDatatable({
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


var DeleteEquipment_type = function(id)
{
	swal({
	  title: Equipment_typeDeleteText,
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
					    Equipment_typeDeletedText,
					    'success'
					);
					Equipment_typeList();
				}
			}
		});
	});
};

var NewEquipment_type = function()
{	
	ResetFields();

	$('.modal-title').text(Equipment_typeAddText);
	$('.btn-save').text(validate_btn);
	$('#equipment_type_id').val("");
	$('#Equipment_type').val("");
	$('#Domain').val("");
	$('#Icon').val("");
	$('#Maintenance').val("");
	$('#image_preview').find('.thumbnail').addClass('hidden');
	$('#Equipment_type').focus();
	$('#Equipment_typeModal').modal('show');
};

var EditEquipment_type = function(id)
{	
	ResetFields();
    
	$.get(route+"/"+id+"/edit", function(data){
		$('.modal-title').text(Equipment_typeEditText);
		$('.btn-save').text(validmodif_btn);
		$('#equipment_type_id').val(data.id);
		$('#Equipment_type').val(data.name);
		$('#Domain').val(data.domain_id);
		$('#Icon').val("");
		$('#Maintenance').val("");
		$('#image_preview').find('.thumbnail').addClass('hidden');
		$('#Equipment_type').focus();
		$('#Equipment_typeModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveEquipment_type").click(function(e)
{
	var form = $('#frmEquipment_type')[0];
	var formData = new FormData(form);
	formData.append('Icon', $('#Icon')[0].files[0]); 
	var id = $("#equipment_type_id").val();
	var Saveroute = route;
	var token = $("#token").val();
	var state = $('#saveEquipment_type').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = route+"/"+id;
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
				Equipment_typeList();
				$("#Equipment_typeModal").modal('toggle');
				$('#frmEquipment_type').trigger('reset');
				$('#Equipment_type').focus();

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
                var input = '#frmEquipment_type input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmEquipment_typed textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmEquipment_type select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
})

$(function () {
    // A chaque sélection de fichier
    $('#frmEquipment_type').find('#Icon').on('change', function (e) {
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