@extends('layouts.master')

@section('body', "map-index")

@section('title', trans('gtb.Maps_list'))

@section('stylesheets')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
    	<div class="row">
	        <div class="col-md-8">
	            <h1>{{trans('gtb.Maps_list')}}</h1>
	        </div>

	        <div class="col-md-4">
	        	<button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewMap();' data-toggle="modal">
	                {{trans('gtb.Map_add_new')}} 
	            </button>
	        </div>

	        <div class="col-md-12">
	            <hr>
	        </div>
	    </div><!-- end of header .row -->

	    <div class="row">
	        <div class="col-md-12">
		        <div id="mapList"></div>
	        </div>
	    </div>

	</section>
	@include('pages.maps.modal')
@endsection

@section('scripts')
	@include('partials.scripts.table')
	<script>
	    var token = "{{ csrf_token() }}";
		var route = "{{ url('map') }}";
		var routeAjax = "{{ route('map.listajax') }}";
		var validate_btn = "{{ trans('general.Validate') }}";
	</script>
	{!! Html::script('js/views/sites-show.js') !!}
@endsection