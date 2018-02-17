@extends('layouts.master')

@section('body', "equipment_picture-index")

@section('title', trans('equipment_picture.Equipment_pictures_list'))

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-8">
                <h1>{{trans('equipment_picture.Equipment_pictures_list')}}</h1>
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewEquipment_picture();' data-toggle="modal">
                    {{trans('equipment_picture.Equipment_picture_add_new')}} 
                </button>
            </div>

            <div class="col-md-12">
                <hr>
            </div>
        </div><!-- end of header .row -->

        <div class="row">
            <div class="col-md-12">
                <div id="equipment_pictureList"></div>
            </div>
        </div>

    </section>
    @include('pages.equipment_picture.modal')
@endsection

@section('scripts')
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routeEquipment_picture = "{{ url('equipment_picture') }}";
        var routeEquipment_pictureAjax = "{{ route('equipment_picture.listajax') }}";
        var Equipment_pictureEditText = "{{ trans('equipment_picture.Equipment_picture_edit') }}";
        var Equipment_pictureDeleteText = "{{ trans('equipment_picture.Equipment_picture_delete') }}";
        var Equipment_pictureDeletedText = "{{ trans('equipment_picture.Equipment_picture_deleted') }}";
    </script>
    {!! Html::script('js/views/equipment_picture-index.js') !!}
@endsection