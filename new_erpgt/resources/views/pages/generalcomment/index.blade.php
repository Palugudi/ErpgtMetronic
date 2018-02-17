@extends('layouts.master')

@section('body', "generalcomment-index")

@section('title', trans('generalcomment.Generalcomments_list'))

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-8">
                <h1>{{trans('generalcomment.Generalcomments_list')}}</h1>
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewGeneralcomment();' data-toggle="modal">
                    {{trans('generalcomment.Generalcomment_add_new')}} 
                </button>
            </div>

            <div class="col-md-12">
                <hr>
            </div>
        </div><!-- end of header .row -->

        <div class="row">
            <div class="col-md-12">
                <div id="generalcommentList"></div>
            </div>
        </div>

    </section>
    @include('pages.generalcomment.modal')
@endsection

@section('scripts')
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routeGeneralcomment = "{{ url('generalcomment') }}";
        var routeGeneralcommentAjax = "{{ route('generalcomment.listajax') }}";
        var GeneralcommentEditText = "{{ trans('generalcomment.Generalcomment_edit') }}";
        var GeneralcommentDeleteText = "{{ trans('generalcomment.Generalcomment_delete') }}";
        var GeneralcommentDeletedText = "{{ trans('generalcomment.Generalcomment_deleted') }}";
    </script>
    {!! Html::script('js/views/generalcomment-index.js') !!}
@endsection