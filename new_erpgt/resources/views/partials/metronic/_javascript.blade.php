
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Datatable Bootstrap -->
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.js"></script>
{!! Html::script('js/global.js') !!}


<script type="text/javascript">
	var FlagChange = function(lang) {
		var locale = lang;
		var token = $("input[name=_token]").val();
		var route = "{{ url('language') }}";
		$.ajax({
			url: route,
			headers: {'X-CSRF-TOKEN': token},
			type: "post",
			data: {locale: locale},
			datatype: 'json',
			success: function (data) {

			},
			error: function (data) {

			},
			beforeSend: function () {

			},
			complete: function (data) {
				window.location.reload(true);
			}
		});
	};
    var validate_btn = "{{ trans('general.Validate') }}";
    var validmodif_btn = "{{ trans('general.ValidateModif') }}";
    var noReturnBackText = "{{ trans('general.NoReturn') }}";
    var deletedText = "{{ trans('general.Delete!') }}";
    var cancelText = "{{ trans('general.Cancel') }}";
    var yesDeleteText = "{{ trans('general.YesDelete') }}";
    var LocaleLanguage = "{{ trans('general.locale_language') }}";
    var see = "{{ trans('general.See') }}";
    var edit = "{{ trans('general.Edit') }}";
    var del = "{{ trans('general.Delete') }}";
    var quit = "{{ trans('general.Quit')}}";
    var reminder = "{{ trans('general.Reminder')}}";
	
	function parseToJsDate(date) {
	    date = date.split('-');
	    return Date.UTC(date[0], date[1]-1, date[2]);
	}

    $('.loading-btn').click(function() {
        var $this = $(this);
        $this.button('loading');
    });
</script>

<!-- begin::Quick Nav -->	
<!--begin::Base Scripts -->
<script src="assets/metronic/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="assets/metronic/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<!--end::Base Scripts -->   
<!--begin::Page Vendors -->
<script src="assets/metronic/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->  
<!--begin::Page Snippets -->
<script src="assets/metronic/app/js/dashboard.js" type="text/javascript"></script>
<!--end::Page Snippets -->