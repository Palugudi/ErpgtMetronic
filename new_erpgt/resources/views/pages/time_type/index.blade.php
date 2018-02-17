@extends('layouts.master')

@section('body', "time_type-index")

@section('title', trans('time_type.Time_types_list'))

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-8">
                <h1>{{trans('time_type.Time_types_list')}}</h1>
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewTime_type();' data-toggle="modal">
                    {{trans('time_type.Time_type_add_new')}} 
                </button>
            </div>

            <div class="col-md-12">
                <hr>
            </div>
        </div><!-- end of header .row -->

        <div class="row">
            <div class="col-md-12">
                <div id="time_typeList"></div>
            </div>
        </div>

    </section>
    @include('pages.time_type.modal')
@endsection

@section('scripts')
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routeTime_type = "{{ url('time_type') }}";
        var routeTime_typeAjax = "{{ route('time_type.listajax') }}";

        var Time_typeAddText = "{{ trans('time_type.Time_type_add?')}}";
        var Time_typeEditText = "{{ trans('time_type.Time_type_edit') }}";
        var Time_typeDeleteText = "{{ trans('time_type.Time_type_delete') }}";
        var Time_typeDeletedText = "{{ trans('time_type.Time_type_deleted') }}";
    </script>
    {!! Html::script('js/views/time_type-index.js') !!}
@endsection