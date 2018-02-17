@extends('layouts.master')

@section('body', "report-index")

@section('title', trans('report.Reports_list'))

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    {{ Html::style('css/bootstrap-datetimepicker.min.css') }}
@endsection

@section('content')
    <!-- Begin: Subheader -->
	<div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    @if(isset($site))
                        <a href="{{ Route('site.show', $site->id) }}">{{ $site->name}}</a> / {{trans('report.Reports_list')}}
                    @else
                        {{trans('report.Reports_list')}}
                    @endif
                </h3>
            </div>
        </div>
	</div>
	<!-- END: Subheader -->

    <div class="m-content">
        <div class="row">
            <div class="col"></div>
            @if(isset($site))
                <div class="col">
                    <button type="button" class="btn m-btn--square  btn-primary btn-block" OnClick='NewUser();' data-toggle="modal">
                        {{trans('auth.User_add_new')}}  
                    </button>
                </div>
            @endif
        </div><br />

        <section id="section-1" class="parallax">
            <div class="row">
                <div class="col-md-12">
                    <div id="reportList"></div>
                </div>
            </div>
        </section>
    </div>
    @include('pages.report.modal')
@endsection

@section('scripts')
    {!! Html::script('js/moment-with-locales.min.js') !!}
    {!! Html::script('js/bootstrap-datetimepicker.min.js') !!}
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routeReport = "{{ url('report') }}";
        var routeReportAjax = "{{ (isset($site->id) ? route('report.listajax', $site->id) : route('reports.listajax')) }}";
        
        var ReportAddText = "{{ trans('report.Report_add?')}}";
        var ReportEditText = "{{ trans('report.Report_edit') }}";
        var ReportDeleteText = "{{ trans('report.Report_delete') }}";
        var ReportDeletedText = "{{ trans('report.Report_deleted') }}";
    </script>
    {!! Html::script('js/views/report-index.js') !!}
@endsection