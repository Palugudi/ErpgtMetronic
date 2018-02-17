<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
	var DataTable = function(name) {
		$(document).ready(function(){
	    	$(name).DataTable( {
	    		dom: '<"top"<"pull-left"l><"pull-right"f><"clearfix">>t<"bottom"ip>',
	    		info:     false,
	    		language: {
			        processing:     "{{trans('table.processing')}}",
			        search:         "{{trans('table.search')}}",
			        lengthMenu:     "{{trans('table.lengthMenu')}}",
			        info:           "{{trans('table.info')}}",
			        infoEmpty:      "{{trans('table.infoEmpty')}}",
			        infoFiltered:   "{{trans('table.infoFiltered')}}",
			        infoPostFix:    "",
			        loadingRecords: "{{trans('table.loadingRecords')}}",
			        zeroRecords:    "{{trans('table.zeroRecords')}}",
			        emptyTable:     "{{trans('table.emptyTable')}}",
			        paginate: {
			            first:      "{{trans('table.first')}}",
			            previous:   "{{trans('table.previous')}}",
			            next:       "{{trans('table.next')}}",
			            last:       "{{trans('table.last')}}"
			        },
			        aria: {
			            sortAscending:  "{{trans('table.sortAscending')}}",
			            sortDescending: "{{trans('table.sortDescending')}}"
			        }
	    		},
	    		columnDefs: [
			    	{ "orderable": false, "targets": 0 }
			  	]
	    	} );
		});
	}
</script>