@extends('layouts.master')

@section('body', "time-index")

@section('title', trans('time.Times_list'))

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-8">
                <h1>{{trans('time.Times_list')}}</h1>
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewTime();' data-toggle="modal">
                    {{trans('time.Time_add_new')}} 
                </button>
            </div>

            <div class="col-md-12">
                <hr>
            </div>
        </div><!-- end of header .row -->

        <div class="row">
            <div class="col-md-12">
                <div id="timeList"></div>
            </div>
        </div>

    </section>
    @include('pages.time.modal')
@endsection

@section('scripts')
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routeTime = "{{ url('time') }}";
        var routeTimeAjax = "{{ route('time.listajax') }}";
        var TimeEditText = "{{ trans('time.Time_edit') }}";
        var TimeDeleteText = "{{ trans('time.Time_delete') }}";
        var TimeDeletedText = "{{ trans('time.Time_deleted') }}";
    </script>
    {!! Html::script('js/views/time-index.js') !!}
@endsection