// Afficher la liste
$(document).ready(function(){
	ReportList();
	Datepickerinit();
});

// Fonction pour afficher la liste
var ReportList = function()
{
	$.ajax({
		type:'get',
		url: routeReportAjax,
		success: function(data){
			$('#reportList').empty().html(data);
			//DataTable('#ReportTable');
			DataTableListreports.init();
		}
	});
}

var DataTableListreports = function() {
	//== Private functions
  
	// demo initializer
	var demo = function() {
  
	  var datatable = $('#ReportTable').mDatatable({
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

var NewReport = function(user_id)
{	
	ResetFields();

	$('#myReportModalLabel').text(ReportAddText);
	$('#saveReport').text(validate_btn);
	$('#report_id').val("");
	$('#user_id').val(user_id);
	$('#ReportDate').val("");
	$('#Equipment').val("");
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
		$('#Equipment').val(data.equipment_id);
		$('#Intervention').val(data.intervention_id);
		$('#Flaw').val(data.flaw);
		$('#Cause').val(data.cause);
		$('#Solution').val(data.solution);
		$('#ReportModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveReport").click(function(e)
{
	//var form = $('#frmReport')[0]; // Code lors d'un envoi de fichier
	//var formData = new FormData(form);
	var form = $('#frmReport');
	var formData = form.serialize();
	var id = $("#report_id").val();
	var Saveroute = routeReport;
	var state = $('#saveReport').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = routeReport+"/"+id;
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

var Datepickerinit = function() {
	$('#ReportDate').datetimepicker({
    	locale: LocaleLanguage,
    	format: "L"
    });
};