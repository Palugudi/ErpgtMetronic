@extends('layouts.master')

@section('body', "priority-index")

@section('title', trans('priority.Priorities_list'))

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-8">
                <h1>{{trans('priority.Priorities_list')}}</h1>
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewPriority();' data-toggle="modal">
                    {{trans('priority.Priority_add_new')}} 
                </button>
            </div>

            <div class="col-md-12">
                <hr>
            </div>
        </div><!-- end of header .row -->

        <div class="row">
            <div class="col-md-12">
                <div id="priorityList"></div>
            </div>
        </div>

    </section>
    @include('pages.priority.modal')
@endsection

@section('scripts')
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routePriority = "{{ url('priority') }}";
        var routePriorityAjax = "{{ route('priority.listajax') }}";

        var PriorityAddText = "{{ trans('priority.Priority_add?')}}";
        var PriorityEditText = "{{ trans('priority.Priority_edit') }}";
        var PriorityDeleteText = "{{ trans('priority.Priority_delete') }}";
        var PriorityDeletedText = "{{ trans('priority.Priority_deleted') }}";
    </script>
    {!! Html::script('js/views/priority-index.js') !!}
@endsection