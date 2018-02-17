@extends('layouts.master')

@section('body', "planning-index")

@section('title', trans('planning.Plannings_list'))

@section('stylesheets')
    {{ Html::style('css/fullcalendar.min.css') }}
    {{ Html::style('css/contextMenu/jquery-contextMenu.css') }}
    {{ Html::style('css/bootstrap-datetimepicker.min.css') }}
    {{ Html::style('css/font-awesome.min.css') }}
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-8">
                <h1><a href="{{ Route('site.show', $site->id) }}">{{ $site->name}}</a> / {{trans('planning.Planning')}}</h1>
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewPlanning({{$site->id}});' data-toggle="modal">
                    {{trans('planning.Planning_add_new')}} 
                </button> 
            </div>

            <div class="col-md-12">
                <hr>
            </div>
        </div><!-- end of header .row -->

        <div class="row">
            <div class="col-md-12">
                <div id="planningList"></div>
            </div>
        </div>

    </section>
@endsection
@include('pages.planning.modal')
@section('scripts')
    @include('partials.scripts.table')
    {!! Html::script('js/jquery-contextMenu.js') !!}
    {!! Html::script('js/fullcalendar/moment.js') !!}
    {!! Html::script('js/fullcalendar/fullcalendar.js') !!}
    {!! Html::script('js/fullcalendar/locale-all.js') !!}
    {!! Html::script('js/moment-with-locales.min.js') !!}
    {!! Html::script('js/bootstrap-datetimepicker.min.js') !!}
    <script>
        var token = "{{ csrf_token() }}";
        var routePlanning = "{{ url('planning') }}";
        var routeEquipment = "{{ url('equipment') }}";
        var routePlanningAjax = "{{ route('planning.listajax', $site->id) }}";
        var PlanningEditText = "{{ trans('planning.Planning_edit') }}";
        var PlanningDeleteText = "{{ trans('planning.Planning_delete') }}";
        var PlanningDeletedText = "{{ trans('planning.Planning_deleted') }}";

        var EventEditText = "{{ trans('gtb.Event_edit') }}";
        var EventAddText = "{{ trans('gtb.Event_add_new') }}";
        var EventDeleteText = "{{ trans('gtb.Event_delete') }}";
        var EventDeletedText = "{{ trans('gtb.Event_deleted') }}";
    </script>
    {!! Html::script('js/views/planning-index.js') !!}
@endsection