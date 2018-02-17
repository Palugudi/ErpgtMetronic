@extends('layouts.master')

@section('body', "reports-show")

@section('title', $report->date)

@section('stylesheets')
    {{ Html::style('css/slim.min.css') }}
    {{ Html::style('css/bootstrap-datetimepicker.min.css') }}
    {{ Html::style('css/lightbox.min.css') }}   
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-12">
            <!-- FIL D'ARIAN -->
                <h1><a href="{{ Route('site.show', $report->site_id) }}">{{$sites[$report->site_id]}}</a> / <a href="{{ Route('report.index', $report->site_id) }}">{{trans('report.Reports')}}</a> / {{ format_date_simple($report->date) }}</h1>
                <hr>
            </div>
        </div><!-- end of header .row -->
        <div class="row">
            <div class="col-md-12">
                <br>
                <div class="row">
                    <div class="col-md-8">
                        <div class="col-md-6">
                            <dl class="dl-horizontal">
                                <label>{{trans('report.Report')}} :</label> {{ $equipments[$report->equipment_id] }}
                            </dl>
                            <dl class="dl-horizontal">
                                <label>{{trans('report.Intervention')}} :</label> {{ $interventions[$report->intervention_id] }}
                            </dl>
                            <dl class="dl-horizontal">
                                <label>{{trans('report.Flaw')}} :</label> {!! nl2br($report->flaw) !!}
                            </dl>
                            <dl class="dl-horizontal">
                                <label>{{trans('report.Cause')}} :</label> 
                                {!! nl2br($report->cause) !!}
                            </dl>
                            <dl class="dl-horizontal">
                                <label>{{trans('report.Solution')}} :</label> 
                                {!! nl2br($report->solution) !!}
                            </dl>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="well">
                            <dl class="dl-horizontal">
                                <dt>{{trans('report.User')}} :</dt>
                                <dd>{{ $users[$report->user_id] }}</dd>
                            </dl>                            
                        </div>
                    </div>
                </div>

                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a data-toggle="tab" href="#pictures"><strong>{{ trans('picture.Pictures')}}</strong></a></li>
                    <li><a data-toggle="tab" href="#documents"><strong>{{ trans('document.Documents')}}</strong></a></li>
                </ul>
                <br>
                <div class="tab-content">
                    <div id="pictures" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="button" class="btn btn-block btn-primary" href="" OnClick='NewPicture();' data-toggle="modal">{{ trans('report_picture.Report_picture_add_new') }}</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div id="pictureList"></div>
                            </div>
                        </div>
                    </div>

                    <div id="documents" class="tab-pane fade">
                        <div class="col-md-12">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="button" class="btn btn-block btn-primary" href="" OnClick='NewReport_document();' data-toggle="modal">{{ trans('report_document.Report_document_add_new') }}</button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <div id="report_documentList"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('pages.report_picture.modal')
    @include('pages.report_document.modal')
@endsection

@section('scripts')
    {!! Html::script('js/moment-with-locales.min.js') !!}
    {!! Html::script('js/bootstrap-datetimepicker.min.js') !!}
    {!! Html::script('js/slim.kickstart.min.js') !!}
    {!! Html::script('js/lightbox.min.js') !!}
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";

        var routePicture = "{{ url('report_picture') }}";
        var routePictureAjax = "{{ route('report_picture.listajax', $report->id) }}";

        var PictureEditText = "{{ trans('report_picture.Report_picture_edit') }}";
        var PictureDeleteText = "{{ trans('report_picture.Report_picture_delete') }}";
        var PictureDeletedText = "{{ trans('report_picture.Report_picture_deleted') }}";

        var routeReport_document = "{{ url('report_document') }}";
        var routeReport_documentAjax = "{{ route('report_document.listajax', $report->id) }}";

        var Report_documentEditText = "{{ trans('report_document.Report_document_edit') }}";
        var Report_documentDeleteText = "{{ trans('report_document.Report_document_delete') }}";
        var Report_documentDeletedText = "{{ trans('report_document.Report_document_deleted') }}";
    </script>
    {!! Html::script('js/views/report-show.js') !!}
@endsection