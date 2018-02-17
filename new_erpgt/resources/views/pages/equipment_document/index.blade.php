@extends('layouts.master')

@section('body', "equipment_document-index")

@section('title', trans('equipment_document.Equipment_documents_list'))

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-8">
                <h1>{{trans('equipment_document.Equipment_documents_list')}}</h1>
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewEquipment_document();' data-toggle="modal">
                    {{trans('equipment_document.Equipment_document_add_new')}} 
                </button>
            </div>

            <div class="col-md-12">
                <hr>
            </div>
        </div><!-- end of header .row -->

        <div class="row">
            <div class="col-md-12">
                <div id="equipment_documentList"></div>
            </div>
        </div>

    </section>
    @include('pages.equipment_document.modal')
@endsection

@section('scripts')
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routeEquipment_document = "{{ url('equipment_document') }}";
        var routeEquipment_documentAjax = "{{ route('equipment_document.listajax') }}";
        var Equipment_documentEditText = "{{ trans('equipment_document.Equipment_document_edit') }}";
        var Equipment_documentDeleteText = "{{ trans('equipment_document.Equipment_document_delete') }}";
        var Equipment_documentDeletedText = "{{ trans('equipment_document.Equipment_document_deleted') }}";
    </script>
    {!! Html::script('js/views/equipment_document-index.js') !!}
@endsection