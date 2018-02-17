// Afficher la liste
$(document).ready(function(){
	InterventionList();

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
	        o.value = arr[i].v;
	        $(o).text(arr[i].t);
    });

    options[1] = "placeholder !!!!";
});

// Fonction pour afficher la liste
var InterventionList = function()
{
	$.ajax({
		type:'get',
		url: routeInterventionAjax,
		success: function(data){
			$('#interventionList').empty().html(data);
			DataTable('#InterventionTable');
		}
	});
}

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
					);
					InterventionList();
				}
			}
		});
	});
};

var NewIntervention = function()
{	
	ResetFields();

	$('.btn-save').text(validate_btn);
	$('#intervention_id').val("");
	$('#Site').val("");
	$('#Assigned').val("");
	$('#Domain').val("");
	$('#ReferenceWO').val("");
	$('#Interventionstatus').val(1);
	$('#Interventiontype').val("");
	$('#Request').val("");
	$('#Priority').val(1);
	$('#InterventionModal').modal('show');
};

var EditIntervention = function(id)
{	
	ResetFields();
    
	$.get(routeIntervention+"/"+id+"/edit", function(data){
		$('.modal-title').text(InterventionEditText);
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

// Fonction pour faire un update ou une création
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
				InterventionList();
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
})