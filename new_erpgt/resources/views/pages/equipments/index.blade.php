@extends('layouts.master')

@section('body', "equipment-index")

@section('title', trans('gtb.Equipments_list'))

@section('stylesheets')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')equipment
    <section id="section-1" class="parallax">
    	<div class="row">
	        <div class="col-md-8">
	            <h1>{{trans('gtb.Equipments_list')}}</h1>
	        </div>

	        <div class="col-md-4">
	        	<button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewEquipment();' data-toggle="modal">
	                {{trans('gtb.Equipment_add_new')}} 
	            </button>
	        </div>

	        <div class="col-md-12">
	            <hr>
	        </div>
	    </div><!-- end of header .row -->

	    <div class="row">
	        <div class="col-md-12">
		        <div id="equipmentList"></div>
	        </div>
	    </div>

	</section>
	@include('pages.equipments.modal')
@endsection

@section('scripts')
	@include('partials.scripts.table')
	<script>
	    var token = "{{ csrf_token() }}";
		var route = "{{ url('equipment') }}";
		var routeAjax = "{{ route('equipment.listajax') }}";
		var validate_btn = "{{ trans('general.Validate') }}";

		var EquipmentEditText = "{{ trans('equipment.Equipment_edit') }}";
        var EquipmentDeleteText = "{{ trans('equipment.Equipment_delete') }}";
        var EquipmentDeletedText = "{{ trans('equipment.Equipment_deleted') }}";
	</script>
	{!! Html::script('js/views/equipments-index.js') !!}
@endsection