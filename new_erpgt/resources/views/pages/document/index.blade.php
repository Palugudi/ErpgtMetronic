@extends('layouts.master')

@section('body', "document-index")

@section('title', trans('document.Documents_list'))

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-8">
                <h1>{{trans('document.Documents_list')}}</h1>
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewDocument();' data-toggle="modal">
                    {{trans('document.Document_add_new')}} 
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
    @include('pages.document.modal')
@endsection

@section('scripts')
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routeDocument = "{{ url('document') }}";
        var routeDocumentAjax = "{{ route('document.listajax') }}";
        var DocumentEditText = "{{ trans('document.Document_edit') }}";
        var DocumentDeleteText = "{{ trans('document.Document_delete') }}";
        var DocumentDeletedText = "{{ trans('document.Document_deleted') }}";
    </script>
    {!! Html::script('js/views/document-index.js') !!}
@endsection