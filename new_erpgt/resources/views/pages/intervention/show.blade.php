@extends('layouts.master')

@section('body', "intervention-index")

@section('title', $intervention->reference_WO)

@section('stylesheets')
    {{ Html::style('css/bootstrap-datetimepicker.min.css') }}
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-12">
                <h1><a href="{{ Route('site.show', $intervention->site_id) }}">{{ $site_name }}</a> / Intervention {{ $intervention->reference_WO }}</h1>
                <hr>
            </div>
        </div><!-- end of header .row -->
        <div class="row">
            <!-- <div class="col-md-12">
                <div class="col-md-6 col-md-offset-3">
                    <a href="" OnClick='EditIntervention({{ $intervention->id }});' data-toggle="modal" class="btn btn-primary btn-block">{{ trans('general.Edit') }}</a>
                </div>
                <hr>
            </div> -->
            <div class="col-md-12">
                <br>
                <div class="row">
                    <div class="col-md-8">
                        <div class="col-md-6">
                            <dl class="dl-horizontal">
                                <label>{{trans('interventiontype.Interventiontype')}} :</label> {{ $type_name }}
                            </dl>
                            <dl class="dl-horizontal">
                                <label>{{trans('gtb.Domain')}} :</label> {{ $domain_name }}
                            </dl>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <dl class="dl-horizontal">
                                <label>{{trans('intervention.Priority')}} :</label> {{ $priority_name }}
                            </dl>
                            <br>
                        </div>
                        <div class="col-md-12">
                            <dl class="dl-horizontal">
                                <label>{{trans('intervention.Request')}} :</label> {{ $intervention->request }}
                            </dl>
                        </div>
                        
                    </div>


                    <div class="col-md-4">
                        <div class="well">
                            <dl class="dl-horizontal">
                                <dt>{{trans('intervention.Date')}} :</dt>
                                <dd>{{ format_date($intervention->created_at) }}</dd>
                            </dl>
                            
                            <dl class="dl-horizontal">
                                <dt>{{trans('intervention.Technician')}} :</dt>
                                <dd>{{ $assigned_name }}</dd>
                            </dl>
                            
                            <dl class="dl-horizontal">
                                <dt>{{trans('intervention.Planneur')}} :</dt>
                                <dd>{{ $planneur_name }}</dd>
                            </dl>
                            
                            <dl class="dl-horizontal">
                                <dt>{{trans('intervention.Interventionstatus')}} :</dt>
                                <dd>{{ $status_name }}</dd>
                            </dl>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="" OnClick='EditIntervention({{ $intervention->id }});' data-toggle="modal" class="btn btn-primary btn-block">{{ trans('general.Edit') }}</a>
                                </div>
                                <div class="col-sm-6">
                                    <a class="btn btn-danger btn-block" href="#" OnClick="DeleteIntervention({{ $intervention->id }});" data-toggle="modal">{{trans('general.Delete')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <br>
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a data-toggle="tab" href="#generalcomments"><strong>{{trans('intervention.generalcomments')}}</strong></a></li>
                    <li><a data-toggle="tab" href="#internalcomments"><strong>{{trans('intervention.internalcomments')}}</strong></a></li>
                    <li><a data-toggle="tab" href="#planning"><strong>{{trans('intervention.time')}}</strong></a></li>
                    <li><a data-toggle="tab" href="#reports"><strong>{{trans('report.Reports')}}</strong></a></li>
                    <li><a data-toggle="tab" href="#orders"><strong>{{trans('order.Orders')}}</strong></a></li>
                    <br>
                </ul>
                <!-- 
                <div class="tab-content">
                    <div id="pictures" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="button" class="btn btn-block btn-primary" href="" OnClick='NewPicture();' data-toggle="modal">{{ 'Ajouter un commentaire' }}</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div id="pictureList"></div>

                                @for ($i = 0; $i < 3; $i++)
                                    <div class="history">
                                        <div class="col-xs-8 col-sm-8">
                                            <div class="history-info">
                                                <div class="history-name">
                                                        <h3>{{ $assigned_name }}</h3>
                                                        <p class="history-time">{{ format_date($intervention->created_at) }}</p>
                                                </div> 
                                            </div>
                                        </div>

                                        <div class="col-xs-4 col-sm-2 col-md-2 col-sm-offset-2 col-md-offset-1">
                                            <a href="#" class="btn btn-warning btn-xs btn-block" OnClick='EditHistory();' data-toggle="modal">Modifier</a>
                                            <a href="#" class="btn btn-danger btn-xs btn-block" OnClick="DeleteHistory()" data-toggle="modal">Supprimer</a>
                                        </div>

                                        <div class="comment-content">
                                            <br>
                                            Ceci est un commentaire suite à une intervention
                                            Ceci est un commentaire suite à une intervention
                                            Ceci est un commentaire suite à une intervention
                                        </div>

                                        <hr>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div id="documents" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="button" class="btn btn-block btn-primary" href="" OnClick='NewEquipment_document();' data-toggle="modal">{{ 'Ajouter un commentaire' }}</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div id="equipment_documentList"></div>

                                @for ($i = 0; $i < 3; $i++)
                                    <div class="history">
                                        <div class="col-xs-8 col-sm-8">
                                            <div class="history-info">
                                                <div class="history-name">
                                                        <h3>{{ $assigned_name }}</h3>
                                                        <p class="history-time">{{ format_date($intervention->created_at) }}</p>
                                                </div> 
                                            </div>
                                        </div>

                                        <div class="col-xs-4 col-sm-2 col-md-2 col-sm-offset-2 col-md-offset-1">
                                            <a href="#" class="btn btn-warning btn-xs btn-block" OnClick='EditHistory();' data-toggle="modal">Modifier</a>
                                            <a href="#" class="btn btn-danger btn-xs btn-block" OnClick="DeleteHistory()" data-toggle="modal">Supprimer</a>
                                        </div>

                                        <div class="comment-content">
                                            <br>
                                            Ceci est un commentaire suite à une intervention
                                            Ceci est un commentaire suite à une intervention
                                            Ceci est un commentaire suite à une intervention
                                        </div>

                                        <hr>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div id="planning" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="button" class="btn btn-block btn-primary" href="" OnClick='NewPlanning();' data-toggle="modal"> {{ 'Ajouter un temps passé' }}</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div id="planningList"></div>
                            </div>
                        </div>
                    </div>
                </div>
                -->
                <div class="tab-content">
                    <div id="generalcomments" class="tab-pane fade in active">
                        <div class="col-md-12">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="button" class="btn btn-block btn-primary" href="" OnClick="CreateGeneralComment({{ $intervention->id }})" data-toggle="modal">{{ trans('generalcomment.Generalcomment_add_new') }}</button>
                            </div>
                        </div>
                        <div id="generalcomments_fill"></div>
                    </div>
                    <div id="internalcomments" class="tab-pane fade">
                        <div class="col-md-12">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="button" class="btn btn-block btn-primary" href="" OnClick="CreateInternalComment({{ $intervention->id }})" data-toggle="modal">{{ trans('internalcomment.Internalcomment_add_new') }}</button>
                            </div>
                        </div>
                        <div id="internalcomments_fill"></div>
                    </div>
                    <div id="planning" class="tab-pane fade">
                        
                        <div class="col-md-12">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="button" class="btn btn-block btn-primary" href="" OnClick='NewTime({{ $intervention->id }});' data-toggle="modal"> {{ trans('time.add') }}</button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="planning_fill"></div>
                        </div>
                    </div>
                    <div id="reports" class="tab-pane fade">
                        
                        <div class="col-md-12">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="button" class="btn btn-block btn-primary" href="" OnClick='NewReport({{ $user->id }});' data-toggle="modal"> {{ trans('report.Report_add_new') }}</button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="reportList"></div>
                        </div>
                    </div>
                    <div id="orders" class="tab-pane fade">                        
                        <div class="col-md-12">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="button" class="btn btn-block btn-primary" href="" OnClick='NewOrder({{$site->id}}, {{$user->id}});' data-toggle="modal"> {{ trans('order.Order_add_new') }}</button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="orderList"></div>
                        </div>
                    </div>
                </div>
                </div><!-- end of header .row -->
            </div>
        </div>
    </section>
    @include('pages.generalcomment.modal')
    @include('pages.internalcomment.modal')
    @include('pages.intervention.modal')
    @include('pages.time.modal')
    @include('pages.report.modal')
    @include('pages.order.modal')
@endsection

@section('scripts')
    {!! Html::script('js/moment-with-locales.min.js') !!}
    {!! Html::script('js/bootstrap-datetimepicker.min.js') !!}
    @include('partials.scripts.table')
    <script>
       
        var token = "{{ csrf_token() }}";

        // Intervention :
        var routeIntervention = "{{ url('intervention') }}";
        var routeInterventionAjax = "{{ route('intervention.listajax') }}";
        var InterventionEditText = "{{ trans('intervention.Intervention_edit') }}";
        var InterventionAddText = "{{ trans('intervention.Intervention_add_new') }}";
        var InterventionDeleteText = "{{ trans('intervention.Intervention_delete') }}";
        var InterventionDeletedText = "{{ trans('intervention.Intervention_deleted') }}";

        // Routes :
        var routeGeneralcommentsAjax = "{{ route('intervention.generalcomment', $intervention->id) }}";
        var routeGeneralcomment = "{{ url('generalcomment') }}";

        var routeInternalcommentsAjax = "{{ route('intervention.internalcomment', $intervention->id) }}";
        var routeInternalcomment = "{{ url('internalcomment') }}";

        var routeTime = "{{ url('time') }}";
        var routeTimeAjax = "{{ route('intervention.time', $intervention->id) }}";

        // Text :
        var Comment_ValidateEditText = "{{ trans('general.Validate') }}";
        var GeneralcommentEditText = "{{ trans('generalcomment.Generalcomment_edit') }}";
        var GeneralcommentAddText = "{{ trans('generalcomment.Generalcomment_add_new') }}";
        var GeneralcommentDeleteText = "{{ trans('generalcomment.Generalcomment_delete') }}";
        var GeneralcommentDeletedText = "{{ trans('generalcomment.Generalcomment_deleted') }}";

        var InternalcommentEditText = "{{ trans('internalcomment.Internalcomment_edit') }}";
        var InternalcommentAddText = "{{ trans('internalcomment.Internalcomment_add_new') }}";
        var InternalcommentDeleteText = "{{ trans('internalcomment.Internalcomment_delete') }}";
        var InternalcommentDeletedText = "{{ trans('internalcomment.Internalcomment_deleted') }}";

        var TimeEditText = "{{ trans('time.Time_edit') }}";
        var TimeAddText = "{{ trans('time.add') }}";
        var TimeDeleteText = "{{ trans('time.Time_delete') }}";
        var TimeDeletedText = "{{ trans('time.Time_deleted') }}";

        var routeReport = "{{ url('report') }}";
        var routeReportAjax = "{{ route('report.listajaxintervention', $intervention->id) }}";
        var routeReportCreate = "{{ route('report.save', $intervention->id)}}";
        var ReportAddText = "{{ trans('report.Report_add?')}}";
        var ReportEditText = "{{ trans('report.Report_edit') }}";
        var ReportDeleteText = "{{ trans('report.Report_delete') }}";
        var ReportDeletedText = "{{ trans('report.Report_deleted') }}";

        var routeOrder = "{{ url('order') }}";
        var routeOrderAjax = "{{ route('order.listajaxintervention', $intervention->id) }}";
        var routeOrderCreate = "{{ route('order.saveintervention', $intervention->id) }}"
        var OrderAddText = "{{ trans('order.Order_add?')}}";
        var OrderEditText = "{{ trans('order.Order_edit') }}";
        var OrderDeleteText = "{{ trans('order.Order_delete') }}";
        var OrderDeletedText = "{{ trans('order.Order_deleted') }}";
    </script>
    {!! Html::script('js/views/intervention-show.js') !!}
@endsection