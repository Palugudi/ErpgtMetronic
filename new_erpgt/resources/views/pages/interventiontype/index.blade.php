@extends('layouts.master')

@section('body', "interventiontype-index")

@section('title', trans('interventiontype.Interventiontypes_list'))

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-8">
                <h1>{{trans('interventiontype.Interventiontypes_list')}}</h1>
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewInterventiontype();' data-toggle="modal">
                    {{trans('interventiontype.Interventiontype_add_new')}} 
                </button>
            </div>

            <div class="col-md-12">
                <hr>
            </div>
        </div><!-- end of header .row -->

        <div class="row">
            <div class="col-md-12">
                <div id="interventiontypeList"></div>
            </div>
        </div>

    </section>
    @include('pages.interventiontype.modal')
@endsection

@section('scripts')
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routeInterventiontype = "{{ url('interventiontype') }}";
        var routeInterventiontypeAjax = "{{ route('interventiontype.listajax') }}";

        var InterventiontypeAddText = "{{ trans('interventiontype.Interventiontype_add?')}}";
        var InterventiontypeEditText = "{{ trans('interventiontype.Interventiontype_edit') }}";
        var InterventiontypeDeleteText = "{{ trans('interventiontype.Interventiontype_delete') }}";
        var InterventiontypeDeletedText = "{{ trans('interventiontype.Interventiontype_deleted') }}";
    </script>
    {!! Html::script('js/views/interventiontype-index.js') !!}
@endsection