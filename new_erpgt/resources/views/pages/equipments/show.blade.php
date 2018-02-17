@extends('layouts.master')

@section('body', "equipment-index")

@section('title', $equipment->equipment_name)

@section('stylesheets')
    {{ Html::style('css/slim.min.css') }}
    {{ Html::style('css/lightbox.min.css') }}
    {{ Html::style('css/bootstrap-datetimepicker.min.css') }}
    {{ Html::style('css/fullcalendar.min.css') }}
    {{ Html::style('css/contextMenu/jquery-contextMenu.css') }}
    {{ Html::style('css/font-awesome.min.css') }}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-12">
                <h1><a href="{{ Route('site.show', $equipment->site_id) }}">{{ $sites[$equipment->site_id] }}</a> / <a href="{{ Route('map.show', $equipment->map_id) }}">{{ $maps[$equipment->map_id] }}</a> / {{ $equipment->equipment_name }}</h1>
                <hr>
            </div>
        </div><!-- end of header .row -->
        <div class="row">
            <div class="col-md-12">
                <hr>
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a data-toggle="tab" href="#description"><strong>Description</strong></a></li>
                    <li><a data-toggle="tab" href="#pictures"><strong>{{ trans('picture.Pictures')}}</strong></a></li>
                    <li><a data-toggle="tab" href="#documents"><strong>{{ trans('document.Documents')}}</strong></a></li>
                    <li><a data-toggle="tab" href="#planning"><strong>{{ trans('planning.Plannings')}}</strong></a></li>
                    <li><a data-toggle="tab" href="#orders"><strong>{{ trans('order.Orders')}}</strong></a></li>
                    <li><a data-toggle="tab" href="#reports"><strong>{{ trans('report.Reports')}}</strong></a></li>

                    <br>
                </ul>

                <div class="tab-content">
                    <div id="description" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6 col-md-offset-3">
                                    <a href="" OnClick='EditEquipment({{ $equipment->id }});' data-toggle="modal" class="btn btn-primary btn-block">{{ trans('general.Edit') }}</a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                 <div class="row">
                                    <div class="col-md-8">
                                        <div class="col-md-6">
                                            <dl class="dl-horizontal">
                                                <label>{{trans('gtb.Brand')}} :</label> {{ $brands[$equipment->brand_id] }}
                                            </dl>
                                            <dl class="dl-horizontal">
                                                <label>{{trans('gtb.Model')}} :</label> {{ $equipment->model }}
                                            </dl>
                                            <br>
                                        </div>
                                        <div class="col-md-6">
                                            <dl class="dl-horizontal">
                                                <label>{{trans('gtb.Manufacture_date')}} :</label> {{ $equipment->manufacture_date }}
                                            </dl>
                                            <dl class="dl-horizontal">
                                                <label>{{trans('gtb.Serial_number')}} :</label> {{ $equipment->serial_number }}
                                            </dl>
                                            <dl class="dl-horizontal">
                                                <label>{{trans('gtb.Maintenance')}} :</label>
                                                <a href="{{'../documents/gammes_maintenance/'.$equipment_type->maintenance}}" target="_blank"> {{ $equipment_type->maintenance}}</a>
                                            </dl>
                                            <br>
                                        </div>
                                        <div class="col-md-12">
                                            <dl class="dl-horizontal">
                                                <label>{{trans('gtb.Informations')}} :</label> {{ $equipment->informations }}
                                            </dl>
                                        </div>
                                        
                                    </div>


                                    <div class="col-md-4">
                                        <div class="well">
                                            <dl class="dl-horizontal">
                                                <dt>{{trans('gtb.Status')}} :</dt>
                                                <dd>{{ $statuses[$equipment->status_id] }}</dd>
                                            </dl>
                                            
                                            <dl class="dl-horizontal">
                                                <dt>{{trans('gtb.Localisation')}} :</dt>
                                                <dd>{{ $localisations[$equipment->localisation_id] }}</dd>
                                            </dl>
                                            
                                            <dl class="dl-horizontal">
                                                <dt>{{trans('gtb.Quantity')}} :</dt>
                                                <dd>{{ $equipment->quantity }}</dd>
                                            </dl>
                                        </div>
                                        <div class="QRCode" style="text-align: center;"> 
                                            {!! QrCode::size(200)->generate(url()->current()) !!} 
                                        </div>
                                    </div>
                                </div><!-- end of header .row -->
                            </div>
                        </div>
                    </div>
                    <div id="pictures" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="button" class="btn btn-block btn-primary" href="" OnClick='NewPicture();' data-toggle="modal">{{ trans('equipment_picture.Equipment_picture_add_new') }}</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div id="pictureList"></div>
                            </div>
                        </div>
                    </div>
                    <div id="documents" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="button" class="btn btn-block btn-primary" href="" OnClick='NewEquipment_document();' data-toggle="modal">{{ trans('equipment_document.Equipment_document_add_new') }}</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div id="equipment_documentList"></div>
                            </div>
                        </div>
                    </div>
                    <div id="planning" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="button" class="btn btn-block btn-primary" href="" OnClick='NewPlanning();' data-toggle="modal"> {{trans('planning.Planning_add_new')}}</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div id="planningList"></div>
                            </div>
                        </div>
                    </div>
                    <div id="orders" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="button" class="btn btn-block btn-primary" href="" OnClick='NewOrder({{$user->id}});' data-toggle="modal"> {{trans('order.Order_add_new')}}</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div id="orderList"></div>
                            </div>
                        </div>
                    </div>
                    <div id="reports" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="button" class="btn btn-block btn-primary" href="" OnClick='NewReport({{$user->id}});' data-toggle="modal"> {{trans('report.Report_add_new')}}</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div id="reportList"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	@include('pages.equipments.modal')
    @include('pages.equipment_document.modal')
    @include('pages.equipment_picture.modal')
    @include('pages.planning.modal')
    @include('pages.order.modal')
    @include('pages.report.modal')
@endsection

@section('scripts')
    {!! Html::script('js/jquery-contextMenu.js') !!}
    {!! Html::script('js/slim.kickstart.min.js') !!}
    {!! Html::script('js/lightbox.min.js') !!}
    {!! Html::script('js/moment-with-locales.min.js') !!}
    {!! Html::script('js/bootstrap-datetimepicker.min.js') !!}
    {!! Html::script('js/fullcalendar/moment.js') !!}
    {!! Html::script('js/fullcalendar/fullcalendar.js') !!}
    {!! Html::script('js/fullcalendar/locale-all.js') !!}
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
		var routeDomain = "{{ url('domain') }}";
		var routeEquipment = "{{ url('equipment') }}";
        var routePicture = "{{ url('equipment_picture') }}";
        var routePictureAjax = "{{ route('equipment_picture.listajax', $equipment->id) }}";
        var routeEquipment_document = "{{ url('equipment_document') }}";
        var routeEquipment_documentAjax = "{{ route('equipment_document.listajax', $equipment->id) }}";
        var routePlanning = "{{ url('planning') }}";
        var routePlanningAjax = "{{ route('planning.listequipmentajax', $equipment->id) }}";
        var Equipment_documentEditText = "{{ trans('equipment_document.Equipment_document_edit') }}";
        var Equipment_documentDeleteText = "{{ trans('equipment_document.Equipment_document_delete') }}";
        var Equipment_documentDeletedText = "{{ trans('equipment_document.Equipment_document_deleted') }}";
        var PictureEditText = "{{ trans('equipment_picture.Equipment_picture_edit') }}";
        var PictureDeleteText = "{{ trans('equipment_picture.Equipment_picture_delete') }}";
        var PictureDeletedText = "{{ trans('equipment_picture.Equipment_picture_deleted') }}";
        var EquipmentEditText = "{{ trans('equipment.Equipment_edit') }}";
        var EquipmentDeleteText = "{{ trans('equipment.Equipment_delete') }}";
        var EquipmentDeletedText = "{{ trans('equipment.Equipment_deleted') }}";

        var EventEditText = "{{ trans('gtb.Event_edit') }}";
        var EventAddText = "{{ trans('gtb.Event_add_new') }}";
        var EventDeleteText = "{{ trans('gtb.Event_delete') }}";
        var EventDeletedText = "{{ trans('gtb.Event_deleted') }}";

        var routeOrderCreate = "{{ route('order.save', $equipment->id)}}";
        var routeOrder = "{{ url('order') }}";
        var routeOrderAjax = "{{ route('order.listajaxequipment', $equipment->id)}}";
        var OrderAddText = "{{ trans('order.Order_add?')}}";
        var OrderEditText = "{{ trans('order.Order_edit') }}";
        var OrderDeleteText = "{{ trans('order.Order_delete') }}";
        var OrderDeletedText = "{{ trans('order.Order_deleted') }}";

        var routeReport = "{{ url('report') }}";
        var routeReportAjax = "{{ route('report.listajaxequipment', $equipment->id) }}";
        var routeReportCreate ="{{ route('report.equipmentsave', $equipment->id)}}";
        var ReportAddText = "{{ trans('report.Report_add?')}}";
        var ReportEditText = "{{ trans('report.Report_edit') }}";
        var ReportDeleteText = "{{ trans('report.Report_delete') }}";
        var ReportDeletedText = "{{ trans('report.Report_deleted') }}";
    </script>
	{!! Html::script('js/views/equipments-show.js') !!}
@endsection