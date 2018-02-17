// Afficher la liste des questions
$(document).ready(function(){
	BrandList();
});

// Fonction pour afficher la liste des questions
var BrandList = function()
{
	$.ajax({
		type:'get',
		url: routeAjax,
		success: function(data){
			$('#brandList').empty().html(data);
			//DataTable('#BrandTable');
			DataTableListBrands.init();
		}
	});
}

var DataTableListBrands = function() {
	//== Private functions
  
	// demo initializer
	var demo = function() {
  
	  var datatable = $('#BrandTable').mDatatable({
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

var DeleteBrand = function(id)
{
	swal({
	  title: BrandDeleteText,
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
					    BrandDeletedText,
					    'success'
					);
					BrandList();
				}
			}
		});
	});
};

var NewBrand = function()
{	
	ResetFields();

	$('.modal-title').text(BrandAddText);
	$('.btn-save').text(validate_btn);
	$('#brand_id').val("");
	$('#Brand').val("");
	$('#Brand').focus();
	$('#BrandModal').modal('show');
};

var EditBrand = function(id)
{	
	ResetFields();
    
	$.get(route+"/"+id+"/edit", function(data){
		$('.modal-title').text(BrandEditText);
		$('.btn-save').text(validmodif_btn);
		$('#brand_id').val(data.id);
		$('#Brand').val(data.name);
		$('#Brand').focus();
		$('#BrandModal').modal('show');
	});
};

// Fonction pour faire un update ou une création
$("#saveBrand").click(function(e)
{
	var id = $("#brand_id").val();
	var Saveroute = route;
	var token = $("#token").val();
	var form = $('#frmBrand');
	var formData = form.serialize();
	var state = $('#saveBrand').text();
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
				BrandList();
				$("#BrandModal").modal('toggle');
				$('#frmBrand').trigger('reset');
				$('#Brand').focus();

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
                var input = '#frmBrand input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmBrand textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmBrand select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
})