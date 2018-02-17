@extends('layouts.master')

@section('body', "interventionstatus-index")

@section('title', trans('interventionstatus.Interventionstatuses_list'))

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-8">
                <h1>{{trans('interventionstatus.Interventionstatuses_list')}}</h1>
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewInterventionstatus();' data-toggle="modal">
                    {{trans('interventionstatus.Interventionstatus_add_new')}} 
                </button>
            </div>

            <div class="col-md-12">
                <hr>
            </div>
        </div><!-- end of header .row -->

        <div class="row">
            <div class="col-md-12">
                <div id="interventionstatusList"></div>
            </div>
        </div>

    </section>
    @include('pages.interventionstatus.modal')
@endsection

@section('scripts')
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routeInterventionstatus = "{{ url('interventionstatus') }}";
        var routeInterventionstatusAjax = "{{ route('interventionstatus.listajax') }}";

        var InterventionstatusAddText = "{{ trans('interventionstatus.Interventionstatus_add?')}}";
        var InterventionstatusEditText = "{{ trans('interventionstatus.Interventionstatus_edit') }}";
        var InterventionstatusDeleteText = "{{ trans('interventionstatus.Interventionstatus_delete') }}";
        var InterventionstatusDeletedText = "{{ trans('interventionstatus.Interventionstatus_deleted') }}";
    </script>
    {!! Html::script('js/views/interventionstatus-index.js') !!}
@endsection