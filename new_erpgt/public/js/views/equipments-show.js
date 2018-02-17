// Afficher la liste
$(document).ready(function(){
	PlanningList();
	PictureList();
	Equipment_documentList();
	Datepickerinit();
	Datetimepickerinit();
	OrderList();
	ReportList();

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $('#calendar').fullCalendar('render');
    });
});

var ReportList = function()
{
	$.ajax({
		type:'get',
		url: routeReportAjax,
		success: function(data){
			$('#reportList').empty().html(data);
			DataTable('#ReportTable');
		}
	});
};

var NewReport = function(user_id)
{	
	ResetFields();

	$('#myReportModalLabel').text(ReportAddText);
	$('#saveReport').text(validate_btn);
	$('#report_id').val("");
	//$('#user_id').val(user_id);
	$("input[id=user_id]").val(user_id);
	$('#Date').val("");
	$('#Intervention').val("");
	$('#Flaw').val("");
	$('#Cause').val("");
	$('#Solution').val("");
	$('#ReportModal').modal('show');
};

var EditReport = function(id)
{	
	ResetFields();
    
	$.get(routeReport+"/"+id+"/edit", function(data){
		$('#myReportModalLabel').text(ReportEditText);
		$('#saveReport').text(validmodif_btn);
		$('#report_id').val(data.id);

		var date = data.date;
		if(LocaleLanguage == "en") {
			var dateFinale = date.substring(5,7)+"/"+date.substring(8,10)+"/"+date.substring(0,4);
		} else if (LocaleLanguage == "fr") {
			var dateFinale = date.substring(8,10)+"/"+date.substring(5,7)+"/"+date.substring(0,4);
		}

		$('#ReportDate').val(dateFinale);
		$('#Intervention').val(data.intervention_id);
		$('#Flaw').val(data.flaw);
		$('#Cause').val(data.cause);
		$('#Solution').val(data.solution);
		$('#ReportModal').modal('show');
	});
};

$("#saveReport").click(function(e)
{
	//var form = $('#frmReport')[0]; // Code lors d'un envoi de fichier
	//var formData = new FormData(form);
	var form = $('#frmReport');
	var formData = form.serialize();
	var id = $("#report_id").val();
	var Saveroute = routeReportCreate;
	var state = $('#saveReport').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = routeReport+"/updateequipment/"+id;
		type = 'PUT';
	}

	$.ajax({
		url: Saveroute,
		headers: {'X-CSRF-TOKEN': token},
		type: type,
		data : formData,
		//contentType: false, // Code lors de l'envoi d'un fichier
    	//processData: false,
		success: function(data){
			if (data.success == 'true')
			{
				ReportList();
				$("#ReportModal").modal('toggle');
				$('#frmReport').trigger('reset');
				$('#report').focus();

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
                var input = '#frmReport input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmReport textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmReport select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
});

var DeleteReport = function(id)
{
	swal({
	  title: ReportDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routeReport+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    ReportDeletedText,
					    'success'
					);
					ReportList();
				}
			}
		});
	});
};

// Fonction pour afficher la liste
var OrderList = function()
{
	$.ajax({
		type:'get',
		url: routeOrderAjax,
		success: function(data){
			$('#orderList').empty().html(data);
			DataTable('#OrderTable');
		}
	});
}

var NewOrder = function(user_id)
{	
	ResetFields();

	$('#OrderModalTitle').text(OrderAddText);	
	$('.btn-save').text(validate_btn);
	$('#order_id').val("");
	$('#user_id').val(user_id);
	$('#Order_status').val("");
	$('#material').val("");
	$('#quantity').val("");
	$('#reference').val("");
	$('#brand').val("");
	$('#model').val("");
	$('#comment').val("");
	$('#intervention').val("");
	$('#OrderModal').modal('show');
};

var EditOrder = function(id)
{	
	ResetFields();

	$.get(routeOrder+"/"+id+"/edit", function(data){
		$('#OrderModalTitle').text(OrderEditText);
		$('.btn-save').text(validmodif_btn);
		$('#order_id').val(data.id);
		$('#user_id').val(data.user_id);
		$('#Order_status').val(data.status_id);
		$('#material').val(data.material);
		$('#quantity').val(data.quantity);
		$('#reference').val(data.reference);
		$('#brand').val(data.brand_id);
		$('#model').val(data.model);
		$('#comment').val(data.comment);
		$('#intervention').val(data.intervention_id);
		$('#OrderModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveOrder").click(function(e)
{

	var form = $('#frmOrder');
	var formData = form.serialize();
	var id = $("#order_id").val();
	var Saveroute = routeOrderCreate;
	var state = $('#saveOrder').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		type = 'PUT';
		Saveroute = routeOrder+"/update/"+id;
	}

	$.ajax({
		url: Saveroute,
		headers: {'X-CSRF-TOKEN': token},
		type: type,
		data : formData,
		success: function(data){
			if (data.success == 'true')
			{
				OrderList();
				$("#OrderModal").modal('toggle');
				$('#frmOrder').trigger('reset');
				$('#order').focus();

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
                var input = '#frmOrder input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmOrder textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmOrder select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
});

var DeleteOrder = function(id)
{
	swal({
	  title: OrderDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routeOrder+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    OrderDeletedText,
					    'success'
					);
					OrderList();
				}
			}
		});
	});
};


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

			$('#equipmentModalTitle').text(EquipmentEditText);
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
	
	if (state==validmodif_btn){
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
				location.reload();
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

	$('#saveEquipment_picture').button('reset');
	$('.btn-save').text(validate_btn);
	$('#equipment_picture_id').val("");
	$('#Equipment_pictureModal').modal('show');
};

var EditPicture = function(id)
{	
	ResetFields();

	$('#saveEquipment_picture').button('reset');
	$.get(routePicture+"/"+id+"/edit", function(data){
		$('#equipmentPictureModalTitle').text(PictureEditText);
		$('.btn-save').text(validmodif_btn);
		$('#equipment_picture_id').val(data.id);
		$('#Equipment_pictureModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveEquipment_picture").click(function(e)
{
	var form = $('#frmEquipment_picture')[0];
	var formData = new FormData(form);
	var id = $("#equipment_picture_id").val();
	var Saveroute = routePicture;
	var state = $('#saveEquipment_picture').text();
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
				$("#Equipment_pictureModal").modal('toggle');
				$('#frmEquipment_picture').trigger('reset');
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
                var input = '#frmEquipment_picture input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmEquipment_picture textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmEquipment_picture select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
});

// Fonction pour afficher la liste
var Equipment_documentList = function()
{
	$.ajax({
		type:'get',
		url: routeEquipment_documentAjax,
		success: function(data){
			$('#equipment_documentList').empty().html(data);
		}
	});
}

var DeleteEquipment_document = function(id)
{
	swal({
	  title: Equipment_documentDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routeEquipment_document+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    Equipment_documentDeletedText,
					    'success'
					);
					Equipment_documentList();
				}
			}
		});
	});
};

var NewEquipment_document = function()
{	
	ResetFields();

	$('.btn-save').text(validate_btn);
	$('#equipment_document_id').val("");
	$('#Equipment_document').val("");
	$('#Equipment_document').focus();
	$('#Equipment_documentModal').modal('show');
};

var EditEquipment_document = function(id)
{	
	ResetFields();

	$.get(routeEquipment_document+"/"+id+"/edit", function(data){
		$('#planningModalTitle').text(Equipment_documentEditText);
		$('.btn-save').text(validmodif_btn);
		$('#equipment_document_id').val(data.id);
		$('#Equipment_document').val(data.name);
		$('#Equipment_document').focus();
		$('#Equipment_documentModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveEquipment_document").click(function(e)
{
	var form = $('#frmEquipment_document')[0];
	var formData = new FormData(form);
	var id = $("#equipment_document_id").val();
	var Saveroute = routeEquipment_document;
	var state = $('#saveEquipment_document').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = routeEquipment_document+"/"+id;
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
				Equipment_documentList();
				$("#Equipment_documentModal").modal('toggle');
				$('#frmEquipment_document').trigger('reset');
				$('#equipment_document').focus();

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
                var input = '#frmEquipment_document input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmEquipment_document textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmEquipment_document select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
});

var NewPlanning = function()
{	
	ResetFields();

	$('#planningModalTitle').text(EventAddText);
	$('#savePlanning').text(validate_btn);
	$('#planning_id').val("");
	$('#Name').val("");
	$('#Date').val("");
	$('#Description').val("");
	$('#Reminder').val("");
	$('#Planning').val("");
	$('#Planning').focus();
	$('#PlanningModal').modal('show');
};

// Fonction pour faire un update ou une création
$("#savePlanning").click(function(e)
{
	var form = $('#frmPlanning')[0];
	var formData = new FormData(form);
	var id = $("#planning_id").val();
	var Saveroute = routePlanning;
	var state = $('#savePlanning').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = routePlanning+"/"+id;
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
				PlanningList();
				$("#PlanningModal").modal('toggle');
				$('#frmPlanning').trigger('reset');

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
                var input = '#frmPlanning input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmPlanning textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmPlanning select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
});

// Fonction pour afficher la liste
var PlanningList = function()
{
	$.ajax({
		type:'get',
		url: routePlanningAjax,
		success: function(data){
			$('#planningList').empty().html(data);
			Planning();
		}
	});
};

var Planning = function()
{
	$('#calendar').fullCalendar({
        header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay,listMonth'
			},
		locale: LocaleLanguage,
		navLinks: true, // can click day/week names to navigate views
		editable: true,
		eventLimit: true, // allow "more" link when too many events
		events: plannings,
		eventRender: function(event, element) {
			var originalClass = element[0].className;
            element[0].className = originalClass + ' rightMenu';
            element[0].setAttribute("id", event.id);
			$(element).tooltip({title: event.description, placement: "bottom"});
			/*$(element).bind('mousedown', function (e) {
	            if (e.which == 3) {
	            	
	            };
	        });*/
	        /*$(element).on("contextmenu",function(){
		       return false;
		    });*/
        },
        eventDrop: function(event, delta, revertFunc) {
    	$.ajax({
			url: routePlanning+"/"+event.id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'POST',
			data : "Date="+event.start.format() +
				   "&drop=" + 1 + 
				   "&site_id=" + event.site_id + 
				   "&equipment_id=" + event.equipment_id + 
				   "&Name=" + event.name + 
				   "&Description=" + event.description ,
			success: function(data){
				if (data.success == 'true')
				{
        			//alert(event.start.format());
				}
			},
			error:function(data)
			{
		        revertFunc();
			}
		});
	    }
    })
};

//Afficher un menu lors du clic droit
$(function(){
    $.contextMenu({
        selector: '.rightMenu', 
        build: function($trigger, e) {
        	//console.log($trigger[0].offsetTop, $trigger[0].offsetLeft);
            // this callback is executed every time the menu is to be shown
            // its results are destroyed every time the menu is hidden
            // e is the original contextmenu event, containing e.pageX and e.pageY (amongst other data)
            return {
                items: {
                    "edit": {name: edit, icon: "edit", callback: function(key, options) {
						$.get(routePlanning+"/"+$trigger[0].id+"/edit", function(data){
							var date = data.date;
						   	if(LocaleLanguage == "en") {
								var dateFinale = date.substring(5,7)+"/"+date.substring(8,10)+"/"+date.substring(0,4);
							} else if (LocaleLanguage == "fr") {
								var dateFinale = date.substring(8,10)+"/"+date.substring(5,7)+"/"+date.substring(0,4);
							}

							var remDate = data.reminder;
							if(remDate != null) {
								if(LocaleLanguage == "en") {
									var rem = remDate.substring(5,7)+"/"+remDate.substring(8,10)+"/"+remDate.substring(0,4);
										//+" "+remDate.substring(11,13)+":"+remDate.substring(14,16);
									if (remDate.substring(11,13) > 12) {
										var hours = remDate.substring(11,13)-12;
										rem = rem + (hours > 9 ? " " : " 0") + hours + ":" + remDate.substring(14,16) + " PM";
									} else if (remDate.substring(11,13) == 12) {
										rem = rem +" "+remDate.substring(11,13)+":"+remDate.substring(14,16) + " PM";
									}
									else if (remDate.substring(11,13) == 0) {
										var hours = 12;
										rem = rem + (hours > 9 ? " " : " 0") + hours + ":" + remDate.substring(14,16) + " AM";
									}
									else {
										rem = rem +" "+remDate.substring(11,13)+":"+remDate.substring(14,16) + " AM";
									}
								}
								else {
									var rem = remDate.substring(8,10)+"/"+remDate.substring(5,7)+"/"+remDate.substring(0,4)+" "+remDate.substring(11,13)+":"+remDate.substring(14,16);
								}
							}

							ResetFields();
							
							$('#planningModalTitle').text(EventEditText);
							$('.btn-save').text(validmodif_btn);
							$('#planning_id').val(data.id);
							$('#site_id').val(data.site_id);
							$('#equipment_id').val(data.equipment_id);
							$('#Name').val(data.name);
							$('#Date').val(dateFinale);
							$('#Description').val(data.description);
							$('#Reminder').val(rem);
							$('#PlanningModal').modal('show');
						});
                    }},
                    "delete": {name: del, icon: "delete", callback: function(key, options) {
                    	swal({
							title: EventDeleteText,
							text: noReturnBackText,
							type: 'warning',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
						 	cancelButtonText: cancelText,
						 	confirmButtonText: yesDeleteText
						}).then(function () {
							$.ajax({
							    url: routePlanning+"/"+$trigger[0].id,
								headers: {'X-CSRF-TOKEN': token},
							    type: 'DELETE',
							    success: function(result) {
								  	swal(
									    deletedText,
									    EventDeletedText,
									    'success'
									);
		                    		$trigger.remove(); // Supprime l'élément
							    }
							});
						})
                    }},
                    "sep1": "---------",
                    "quit": {name: quit, icon: "quit", callback: function(key, options) {}}
                }
            };
        }
    });
});

var Datepickerinit = function() {
	$('#Date').datetimepicker({
    	locale: LocaleLanguage,
    	format: "L"
    });

    $('#ReportDate').datetimepicker({
    	locale: LocaleLanguage,
    	format: "L"
    });
};

var Datetimepickerinit = function() {
	if(LocaleLanguage == "en") {
		var formatDate = "L hh:mm A";
	}
	else {
		var formatDate = "L HH:mm";
	}

	$('#Reminder').datetimepicker({
    	locale: LocaleLanguage,
    	format: formatDate
    });
};