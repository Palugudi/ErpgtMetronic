// Action pour le menu à gauche qui affiche la liste des plans
$('#toolbar .hamburger').on('click', function() {
	$(this).parent().toggleClass('open');
});

// Afficher les informations sur la page
$(document).ready(function(){
	MapList();
	EquipmentList();
	DocumentList();
	InterventionList();
});

// Fonction pour afficher la liste des questions
var MapList = function()
{
	$.ajax({
		type:'get',
		url: routeAjaxMap,
		success: function(data){
			$('#mapList').empty().html(data);
		}
	});
}

// Fonction pour afficher la liste des équipements
var EquipmentList = function()
{
	$.ajax({
		type:'get',
		url: routeAjaxEquipment,
		success: function(data){
			$('#equipmentList').empty().html(data);
			DataTable('#EquipmentTable');
		}
	});
}

// Fonction pour afficher la liste des équipements
var InterventionList = function()
{
	$.ajax({
		type:'get',
		url: routeAjaxIntervention,
		success: function(data){
			$('#interventionList').empty().html(data);
			DataTable('#InterventionTable');
		}
	});
}

var DeleteMap = function(id)
{
	swal({
	  title: MapDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routeMap+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    MapDeletedText,
					    'success'
					);
					MapList();
				}
			}
		});
	});
};

var NewMap = function()
{	
	ResetFields();

	$('#saveEquipment_picture').button('reset');
	$('.btn-save').text(validate_btn);
	$('#map_id').val("");
	$('#Map').val("");
	$('#MapModal').modal('show');
};

var EditMap = function(id)
{	
	ResetFields();

	$('#saveEquipment_picture').button('reset');
	$.get(routeMap+"/"+id+"/edit", function(data){
		$('.modal-title').text(MapEditText);
		$('.btn-save').text(validmodif_btn);
		$('#map_id').val(data.id);
		$('#Map').val(data.name);
		$('#MapModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveMap").click(function(e)
{
	var id = $("#map_id").val();
	var Saveroute = routeMap;
	var token = $("#token").val();
	var form = $('#frmMap');
	var formData = form.serialize();
	var state = $('#saveMap').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		type = 'PUT';
		Saveroute = routeMap+"/"+id;
	}

	$.ajax({
		url: Saveroute,
		headers: {'X-CSRF-TOKEN': token},
		type: type,
		data : formData,
		success: function(data){
			if (data.success == 'true')
			{
				MapList();
				$("#MapModal").modal('toggle');
				$('#frmMap').trigger('reset');
				$('#Map').focus();

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
                var input = '#frmMap input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmMap textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmMap select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
})


var EditEquipment = function(id)
{
	$.get(routeEquipment+"/"+id+"/edit", function(data){
		// Lister les types d'équipement suivant le domaine sélectionné
        $.get(routeDomain+"/"+data.domain_id+"/equipment_types", function(response, state){
			$('#Equipment_type').empty();
			for(j=0; j<response.length; j++){
				$('#Equipment_type').append("<option value='"+response[j].id+"'> "+response[j].name+"</option>");
			};

			ResetFields();

			$('.modal-title').text(DocumentEditText);
			$('.btn-save').text(validmodif_btn);
			$('#equipment_id').val(data.id);
			$('#equipment_map_id').val(data.map_id);
			$('#equipment_name').val(data.equipment_name);
			$('#domain_id').val(data.domain_id);
			$('#position_left').val(data.position_left);
			$('#position_top').val(data.position_top);
			$('#picture').val(data.picture);
			$('#Equipment_type').val(data.equipment_type_id);
			$('#Brand').val(data.brand_id);
			$('#Status').val(data.status_id);
			$('#Localisation').val(data.localisation_id);
			$('#Model').val(data.model);
			$('#Quantity').val(data.quantity);
			$('#Serial_number').val(data.serial_number);
			$('#Manufacture_date').val(data.manufacture_date);
			$('#JLL_reference').val(data.JLL_reference);
			$('#Informations').val(data.informations);
    		$('#EquipmentModal').modal('show');
		});
	});
};

// Fonction pour faire un update ou une création
$("#saveEquipment").click(function(e)
{
	var id = $("#equipment_id").val();
	var SaverouteEquipment = routeEquipment;
	var token = $("#token").val();
	var form = $('#frmEquipment');
	var formData = form.serialize();
	var state = $('#saveEquipment').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		type = 'PUT';
		SaverouteEquipment = routeEquipment+"/"+id;
	}

	$.ajax({
		url: SaverouteEquipment,
		headers: {'X-CSRF-TOKEN': token},
		type: type,
		data : formData,
		success: function(data){
			if (data.success == 'true')
			{ 
				EquipmentList();
				$("#EquipmentModal").modal('toggle');
				$('#frmEquipment').trigger('reset');
			}
		},
		error:function(data)
		{
			// Permet d'afficher les messages d'erreur sous les champs
			$.each(data.responseJSON, function (key, value) {
                var input = '#frmEquipment input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmEquipment textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmEquipment select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
})


// Fonction pour afficher la liste
var DocumentList = function()
{
	$.ajax({
		type:'get',
		url: routeDocumentAjax,
		success: function(data){
			$('#documentList').empty().html(data);
			DataTable('#DocumentTable');
		}
	});
}

var DeleteDocument = function(id)
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
			url: routeDocument+"/"+id,
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
					DocumentList();
				}
			}
		});
	});
};

var NewDocument = function()
{	
	ResetFields();

	$('.btn-save').text(validate_btn);
	$('#document_id').val("");
	$('#Document').val("");
	$('#Document_type').val("");
	$('#Document').focus();
	$('#DocumentModal').modal('show');
};

var EditDocument = function(id)
{	
	ResetFields();
	
	$.get(routeDocument+"/"+id+"/edit", function(data){
		$('.modal-title').text(DocumentEditText);
		$('.btn-save').text(validmodif_btn);
		$('#document_id').val(data.id);
		$('#Document').val(data.name);
		$('#Document_type').val(data.document_type_id);
		$('#Document').focus();
		$('#DocumentModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveDocument").click(function(e)
{
	var form = $('#frmDocument')[0];
	var formData = new FormData(form);
	var id = $("#document_id").val();
	var Saveroute = routeDocument;
	var state = $('#saveDocument').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = routeDocument+"/"+id;
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
				DocumentList();
				$("#DocumentModal").modal('toggle');
				$('#frmDocument').trigger('reset');
				$('#document').focus();

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
                var input = '#frmDocument input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmDocument textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmDocument select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
})