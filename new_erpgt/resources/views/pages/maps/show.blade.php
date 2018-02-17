@extends('layouts.master')

@section('body', "map-show")

@section('title', $map->name)

@section('stylesheets')
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css"> -->
	{{ Html::style('css/contextMenu/jquery-contextMenu.css') }}
	{{ Html::style('css/font-awesome.min.css') }}
@endsection

@section('content')
    <section id="section-1" class="parallax">
    	<div class="row">
	        <div class="col-md-8">
	        	<h1><a href="{{ Route('site.show', $map->site_id) }}">{{ $site_name}}</a> / {{ $map->name}}</h1>
	        </div>

	        <div class="col-md-12">
	            <hr>
	        </div>
	    </div><!-- end of header .row -->

		<div class="row">
			<div id="toolbar">
			    <div class="hamburger">
			      	<span>{{trans('gtb.Equipments')}}</span>
			    </div>
			    <div id="toolbarlist">
			      	<h2>{{ trans('gtb.Domains') }}</h2>
			      	<ul>
			      	@foreach($domains as $domain)
						<li><div id="{{$domain->id}}" class="drag" title="{{$domain->name}}" style="background-image: url(../images/domains/{{$domain->picture}}); background-size: contain; font-family:'{{$domain->picture}}'"></div> <div class="txtEquip">{{$domain->name}}</div></li>
					@endforeach
					</ul>
			    </div>
		  	</div>
			<div class="col-md-12">
				<div class="col" id="dropzone" style='background-image: url("../documents/{{ $map->site_id}}/maps/{{ $map->picture}}")'></div>
				<a href="#" id="HTML2Canvas">{{trans('gtb.Map_download')}}</a>
				<div id="previewImage">
			</div>
		</div>

	</section>
	@include('pages.equipments.modal')
@endsection

@section('scripts')
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>  -->
	{!! Html::script('js/views/maps-show.js') !!}
	{!! Html::script('js/jquery-contextMenu.js') !!}
	{!! Html::script('js/html2canvas.js') !!}
	{!! Html::script('js/jquery.ui.touch-punch.min.js') !!}
	@include('partials.scripts.table')

	<script>
	    var token = "{{ csrf_token() }}";
	    var MapID = {{ $map->id }};
		var routeDomain = "{{ url('domain') }}";
		var routeMap = "{{ url('map') }}";
		var routeEquipment = "{{ url('equipment') }}";
		var validate_btn = "{{ trans('general.Validate') }}";

		var EquipmentEditText = "{{ trans('gtb.Equipment_edit') }}";
        var EquipmentAddText = "{{ trans('gtb.Equipment_add_new') }}";
        var EquipmentDeleteText = "{{ trans('gtb.Equipment_delete') }}";
        var EquipmentDeletedText = "{{ trans('.Equipment_deleted') }}";
	</script>
@endsection