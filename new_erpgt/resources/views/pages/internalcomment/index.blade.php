@extends('layouts.master')

@section('body', "internalcomment-index")

@section('title', trans('internalcomment.Internalcomments_list'))

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-8">
                <h1>{{trans('internalcomment.Internalcomments_list')}}</h1>
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewInternalcomment();' data-toggle="modal">
                    {{trans('internalcomment.Internalcomment_add_new')}} 
                </button>
            </div>

            <div class="col-md-12">
                <hr>
            </div>
        </div><!-- end of header .row -->

        <div class="row">
            <div class="col-md-12">
                <div id="internalcommentList"></div>
            </div>
        </div>

    </section>
    @include('pages.internalcomment.modal')
@endsection

@section('scripts')
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routeInternalcomment = "{{ url('internalcomment') }}";
        var routeInternalcommentAjax = "{{ route('internalcomment.listajax') }}";
        var InternalcommentEditText = "{{ trans('internalcomment.Internalcomment_edit') }}";
        var InternalcommentDeleteText = "{{ trans('internalcomment.Internalcomment_delete') }}";
        var InternalcommentDeletedText = "{{ trans('internalcomment.Internalcomment_deleted') }}";
    </script>
    {!! Html::script('js/views/internalcomment-index.js') !!}
@endsection