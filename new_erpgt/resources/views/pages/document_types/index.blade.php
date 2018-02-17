@extends('layouts.master')

@section('body', "document_type-index")

@section('title', trans('gtb.Document_types_list'))

@section('stylesheets')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
    	<div class="row">
	        <div class="col-md-8">
	            <h1>{{trans('gtb.Document_types_list')}}</h1>
	        </div>

	        <div class="col-md-4">
	        	<button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewDocumentType();' data-toggle="modal">
	                {{trans('gtb.Document_type_add_new')}} 
	            </button>
	        </div>

	        <div class="col-md-12">
	            <hr>
	        </div>
	    </div><!-- end of header .row -->

	    <div class="row">
	        <div class="col-md-12">
		        <div id="documentList"></div>
	        </div>
	    </div>

	</section>
	@include('pages.document_types.modal')
@endsection

@section('scripts')
	@include('partials.scripts.table')
	<script>
	    var token = "{{ csrf_token() }}";
		var routeDocumentTypes = "{{ url('document_type') }}";
		var routeDocumentTypesAjax = "{{ route('document_type.listajax') }}";
		var validate_btn = "{{ trans('general.Validate') }}";

		var DocumentAddText = "{{ trans('gtb.Document_type_add?')}}";
		var DocumentEditText = "{{ trans('gtb.Document_types_edit') }}";
        var DocumentDeleteText = "{{ trans('gtb.Document_types_delete') }}";
        var DocumentDeletedText = "{{ trans('gtb.Document_types_deleted') }}";
	</script>
	{!! Html::script('js/views/document_types-index.js') !!}
@endsection