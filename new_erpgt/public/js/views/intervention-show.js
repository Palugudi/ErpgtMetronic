// Fonction pour afficher la liste des commentaires généraux
var GeneralComments = function(id)
{
	$.ajax({
		type:'get',
		url: routeGeneralcommentsAjax,
		success: function(data){
			$('#generalcomments_fill').empty().html(data);
		}
	});
};

// Afficher la liste des commentaires généraux
$(document).ready(function(){
	GeneralComments();
	InternalComments();
	TimeList();
	ReportList();
	OrderList();
	Datepickerinit();

	var options = $('#Assigned option');
    var arr = options.map(function(_, o) {
        return {
            t: $(o).text(),
            v: o.value
        };
    }).get();
    arr.sort(function(o1, o2) {
        return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0;
    });
    options.each(function(i, o) {
    	if(arr[i].v != 0) {
	        o.value = arr[i].v;
	        $(o).text(arr[i].t);
	    }
    });
});

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
};

var NewOrder = function(site_id, user_id)
{	
	ResetFields();

	$('#OrderModalTitle').text(OrderAddText);	
	$('.btn-save').text(validate_btn);
	$('#order_id').val("");
	$('#site_id').val(site_id);	
	//$('#user_id').val(user_id);
	$("input[id=user_id]").val(user_id);
	$('#Order_status').val("");
	$('#material').val("");
	$('#equipment_type').val("");
	$('#quantity').val("");
	$('#reference').val("");
	$('#brand').val("");
	$('#model').val("");
	$('#comment').val("");
	$('#equipment').val("");
	$('#localisation').val("");
	$('#localisation_div').toggle(false);
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
		$('#equipment_type').val(data.equipment_type_id);
		$('#material').val(data.material);
		$('#quantity').val(data.quantity);
		$('#reference').val(data.reference);
		$('#brand').val(data.brand_id);
		$('#model').val(data.model);
		$('#comment').val(data.comment);
		$('#equipment').val(data.equipment_id);
		$('#localisation').val(data.localisation_id);
		if(data.equipment_id == 0) {
			$('#localisation_div').toggle(true);
		} else {
			$('#localisation_div').toggle(false);
		}
		$('#OrderModal').modal('show');
	});
};

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
		Saveroute = routeOrder+"/updateintervention/"+id;
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

$("#equipment").change(function () {
	if($(this).val() == 0) {
    	$('#localisation_div').toggle(true);
	} else {
		$('#localisation_div').toggle(false);
	}
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
	$('#user_id').val(user_id);
	$('#ReportDate').val("");
	$('#Equipment').val("");
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
		$('#Equipment').val(data.equipment_id);
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
		Saveroute = routeReport+"/update/"+id;
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

// Fonction pour afficher la popup avec les informations, lors d'une modification de commentaires
var EditGeneralComment = function(id)
{	
	ResetFields();

	$.get(routeGeneralcomment+"/"+id+"/edit", function(data){
		$('#generalCommentModalTitle').text(GeneralcommentEditText);
		$('.btn-save').text(validmodif_btn);
		$('#generalcomment_id').val(data.id);
		$('#g_comment').val(data.comment);
		$('#GeneralcommentModal').modal('show');
	});
};

var CreateGeneralComment = function(id) {

	ResetFields();

	$('#generalCommentModalTitle').text(GeneralcommentAddText);
	$('.btn-save').text(validate_btn);
	$('#generalcomment_id').val('');
	$('#generalcomment_intervention').val(id);
	$('#g_comment').val('');
	$('#GeneralcommentModal').modal('show');
}

var DeleteGeneralcomment = function(id)
{
	swal({
	  title: GeneralcommentDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routeGeneralcomment+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    GeneralcommentDeletedText,
					    'success'
					);
					GeneralComments();
				}
			}
		});
	});
};

$("#saveGeneralcomment").click(function(e)
{
	var id = $("#generalcomment_id").val();
	var SaverouteGeneralComment = routeGeneralcomment;
	var token = $("#token").val();
	var form = $('#frmGeneralcomment');
	var formData = form.serialize();
	var state = $('#saveGeneralcomment').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state != validate_btn){
		type = 'PUT';
		SaverouteGeneralComment = routeGeneralcomment+"/"+id;
	}

	$.ajax({
		url: SaverouteGeneralComment,
		headers: {'X-CSRF-TOKEN': token},
		type: type,
		data : formData,
		success: function(data){
			if (data.success == 'true')
			{ 
				GeneralComments();
				$("#GeneralcommentModal").modal('toggle');
				$('#frmGeneralcomment').trigger('reset');

				if (state!=validate_btn){
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
                var input = '#frmGeneralcomment input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmGeneralcomment textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmGeneralcomment select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
});

//////////////////////////////////////////
var InternalComments = function(id)
{
	$.ajax({
		type:'get',
		url: routeInternalcommentsAjax,
		success: function(data){
			$('#internalcomments_fill').empty().html(data);
		}
	});
};

// Fonction pour afficher la popup avec les informations, lors d'une modification de commentaires internes
var EditInternalcomment = function(id)
{	
	ResetFields();

	$.get(routeInternalcomment+"/"+id+"/edit", function(data){
		$('#internalCommentModalTitle').text(InternalcommentEditText);
		$('.btn-save').text(validmodif_btn);
		$('#internalcomment_id').val(data.id);
		$('#i_comment').val(data.comment);
		$('#InternalcommentModal').modal('show');
	});
};

var CreateInternalComment = function(id) {
	ResetFields();

	$('#internalCommentModalTitle').text(InternalcommentAddText);
	$('.btn-save').text(validate_btn);
	$('#internalcomment_id').val('');
	$('#internalcomment_intervention').val(id);
	$('#i_comment').val('');
	$('#InternalcommentModal').modal('show');
}

var DeleteInternalcomment = function(id)
{
	swal({
	  title: InternalcommentDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routeInternalcomment+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    InternalcommentDeletedText,
					    'success'
					);
					InternalComments();
				}
			}
		});
	});
};

$("#saveInternalcomment").click(function(e)
{
	var id = $("#internalcomment_id").val();
	var SaverouteInternalComment = routeInternalcomment;
	var token = $("#token").val();
	var form = $('#frmInternalcomment');
	var formData = form.serialize();
	var state = $('#saveInternalcomment').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state != validate_btn){
		type = 'PUT';
		SaverouteInternalComment = routeInternalcomment+"/"+id;
	}

	$.ajax({
		url: SaverouteInternalComment,
		headers: {'X-CSRF-TOKEN': token},
		type: type,
		data : formData,
		success: function(data){
			if (data.success == 'true')
			{ 
				InternalComments();
				$("#InternalcommentModal").modal('toggle');
				$('#frmInternalcomment').trigger('reset');

				if (state!=validate_btn){
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
                var input = '#frmInternalcomment input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmInternalcomment textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmInternalcomment select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
});

////////////////////////

var EditIntervention = function(id)
{	
	ResetFields();

	$.get(routeIntervention+"/"+id+"/edit", function(data){
		$('#interventionModalTitle').text(InterventionEditText);
		$('.btn-save').text(validmodif_btn);
		$('#intervention_id').val(data.id);
		$('#Site').val(data.site_id);
		$('#Assigned').val(data.assigned_id);
		$('#Domain').val(data.domain_id);
		$('#ReferenceWO').val(data.reference_WO);
		$('#Interventionstatus').val(data.status_id);
		$('#Interventiontype').val(data.type);
		$('#Request').val(data.request);
		$('#Priority').val(data.priority_id);
		$('#InterventionModal').modal('show');
	});
};

$("#saveIntervention").click(function(e)
{
	var form = $('#frmIntervention')[0];
	var formData = new FormData(form);
	var id = $("#intervention_id").val();
	var Saveroute = routeIntervention;
	var state = $('#saveIntervention').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = routeIntervention+"/"+id;
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
				location.reload();
				$("#InterventionModal").modal('toggle');
				$('#frmIntervention').trigger('reset');
				$('#intervention').focus();

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
                var input = '#frmIntervention input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmIntervention textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmIntervention select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
});

var DeleteIntervention = function(id)
{
	swal({
	  title: InterventionDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routeIntervention+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    InterventionDeletedText,
					    'success'
					).then(function() {
						document.location.href = routeIntervention;
					});
					
				}
			}
		});
	});
};

/////////////////////////////////////////////////

// Fonction pour afficher la liste
var TimeList = function()
{
	$.ajax({
		type:'get',
		url: routeTimeAjax,
		success: function(data){
			$('#planning_fill').empty().html(data);
			DataTable('#TimeTable');
		}
	});
}

var EditTime = function(id)
{	
	ResetFields();

	$.get(routeTime+"/"+id+"/edit", function(data){
		var date = data.date;
		if(LocaleLanguage == "en") {
			var dateFinale = date.substring(5,7)+"/"+date.substring(8,10)+"/"+date.substring(0,4);
		} else if (LocaleLanguage == "fr") {
			var dateFinale = date.substring(8,10)+"/"+date.substring(5,7)+"/"+date.substring(0,4);
		}
		
		$('#timeUsedModalTitle').text(TimeEditText);
		$('.btn-save').text(validmodif_btn);
		$('#time_id').val(data.id);
		$('#date').val(dateFinale);
		$('#time_used').val(data.time_used);
		$('#type').val(data.time_type_id);
		$('#TimeModal').modal('show');
	});
};

var NewTime = function(id)
{	
	ResetFields();
    
	$('.btn-save').text(validate_btn);
	$('#timeUsedModalTitle').text(TimeAddText);
	$('#time_id').val("");
	$('#time_intervention').val(id);
	$('#date').val("");
	$('#time_used').val("");
	$('#type').val("");
	$('#TimeModal').modal('show');
};

$("#saveTime").click(function(e)
{
	var form = $('#frmTime');
	var formData = form.serialize();
	var id = $("#time_id").val();
	var Saveroute = routeTime;
	var state = $('#saveTime').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		type = 'PUT';
		Saveroute = routeTime+"/"+id;
	}

	$.ajax({
		url: Saveroute,
		headers: {'X-CSRF-TOKEN': token},
		type: type,
		data : formData,
		success: function(data){
			if (data.success == 'true')
			{
				TimeList();
				$("#TimeModal").modal('toggle');
				$('#frmTime').trigger('reset');
				$('#time').focus();

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
                var input = '#frmTime input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmTime textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmTime select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
});

var DeleteTime = function(id)
{
	swal({
	  title: TimeDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routeTime+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    TimeDeletedText,
					    'success'
					);
					TimeList();
				}
			}
		});
	});
};

var Datepickerinit = function() {
	$('#date').datetimepicker({
    	locale: LocaleLanguage,
    	format: "L"
    });
    $('#ReportDate').datetimepicker({
    	locale: LocaleLanguage,
    	format: "L"
    });
};
