@extends('layouts.master')

@section('body', "status-index")

@section('title', trans('gtb.Statuses_list'))

@section('stylesheets')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
    	<div class="row">
	        <div class="col-md-8">
	            <h1>{{trans('gtb.Statuses_list')}}</h1>
	        </div>

	        <div class="col-md-4">
	        	<button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewStatus();' data-toggle="modal">
	                {{trans('gtb.Status_add_new')}} 
	            </button>
	        </div>

	        <div class="col-md-12">
	            <hr>
	        </div>
	    </div><!-- end of header .row -->

	    <div class="row">
	        <div class="col-md-12">
		        <div id="statusList"></div>
	        </div>
	    </div>

	</section>
	@include('pages.statuses.modal')
@endsection

@section('scripts')
	@include('partials.scripts.table')
	<script>
	    var token = "{{ csrf_token() }}";
		var route = "{{ url('status') }}";
		var routeAjax = "{{ route('status.listajax') }}";

		var StatusesEditText = "{{ trans('gtb.Status_edit') }}";
        var StatusesAddText = "{{ trans('gtb.Status_add?') }}";
        var StatusesDeleteText = "{{ trans('gtb.Status_delete') }}";
        var StatusesDeletedText = "{{ trans('gtb.Status_deleted') }}";
	</script>
	{!! Html::script('js/views/statuses-index.js') !!}
@endsection