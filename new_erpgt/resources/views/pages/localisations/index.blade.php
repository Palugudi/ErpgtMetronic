@extends('layouts.master')

@section('body', "localisation-index")

@section('title', trans('gtb.Localisations_list'))

@section('stylesheets')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
    	<div class="row">
	        <div class="col-md-8">
	            <h1>{{trans('gtb.Localisations_list')}}</h1>
	        </div>

	        <div class="col-md-4">
	        	<button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewLocalisation();' data-toggle="modal">
	                {{trans('gtb.Localisation_add_new')}} 
	            </button>
	        </div>

	        <div class="col-md-12">
	            <hr>
	        </div>
	    </div><!-- end of header .row -->

	    <div class="row">
	        <div class="col-md-12">
		        <div id="localisationList"></div>
	        </div>
	    </div>

	</section>
	@include('pages.localisations.modal')
@endsection

@section('scripts')
	@include('partials.scripts.table')
	<script>
	    var token = "{{ csrf_token() }}";
		var route = "{{ url('localisation') }}";
		var routeAjax = "{{ route('localisation.listajax') }}";
		var validate_btn = "{{ trans('general.Validate') }}";

		var LocalisationEditText = "{{ trans('gtb.Localisation_edit') }}";
        var LocalisationAddText = "{{ trans('gtb.Localisation_add?') }}";
        var LocalisationDeleteText = "{{ trans('gtb.Localisation_delete') }}";
        var LocalisationDeletedText = "{{ trans('gtb.Localisation_deleted') }}";
	</script>
	{!! Html::script('js/views/localisations-index.js') !!}
@endsection