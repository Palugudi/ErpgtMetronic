@extends('layouts.master')

@section('body', "consumption-index")

@section('title', trans('consumption.Consumptions_list'))

@section('stylesheets')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
   <!-- Begin: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    {{trans('consumption.Consumption_add_new')}} 
                </h3>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->

    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-8">
                <h1><a href="{{ Route('site.show', $site->id) }}">{{ $site->name}}</a> / {{trans('consumption.Consumptions_list')}}</h1>
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-lg btn-block btn-info" href="#" OnClick='NewConsumption();' data-toggle="modal">
                    {{trans('consumption.Consumption_add_new')}} 
                </button>
            </div>

            <div class="col-md-12">
                <hr>
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a data-toggle="tab" href="#eau"><i class="fa fa-tint"></i> <strong>Eau</strong></a></li>
                    <li><a data-toggle="tab" href="#elecHP"><i class="fa fa-bolt"></i> <strong>Electricité HP</strong></a></li>
                    <li><a data-toggle="tab" href="#elecHC"><i class="fa fa-bolt"></i> <strong>Electricité HC</strong></a></li>
                    <li><a data-toggle="tab" href="#gaz"><i class="fa fa-fire"></i> <strong>Gaz</strong></a></li>
                </ul>

                <div class="tab-content">
                    <div id="eau" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="waterGraph"></div>
                                <div id="waterList"></div>
                            </div>
                        </div>
                    </div>
                    <div id="elecHP" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="elecHPGraph"></div>
                                <div id="elecHPList"></div>
                            </div>
                        </div>
                    </div>
                    <div id="elecHC" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="elecHCGraph"></div>
                                <div id="elecHCList"></div>
                            </div>
                        </div>
                    </div>
                    <div id="gaz" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="gasGraph"></div>
                                <div id="gasList"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end of header .row -->
    </section>
    @include('pages.consumption.modal')
@endsection

@section('scripts')
    {!! Html::script('js/moment-with-locales.min.js') !!}
    {!! Html::script('js/bootstrap-datetimepicker.min.js') !!}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routeConsumption = "{{ url('consumption') }}";
        var routeConsumptionWaterAjax = "{{ route('consumption.waterlistajax', $site->id) }}";
        var routeConsumptionGasAjax = "{{ route('consumption.gaslistajax', $site->id) }}";
        var routeConsumptionElecHpAjax = "{{ route('consumption.elechplistajax', $site->id) }}";
        var routeConsumptionElecHcAjax = "{{ route('consumption.elechclistajax', $site->id) }}";
        var routeGraphWater = "{{ route('consumption.watergraphajax', $site->id) }}";
        var routeGraphGas = "{{ route('consumption.gasgraphajax', $site->id) }}";
        var routeGraphElecHp = "{{ route('consumption.elechpgraphajax', $site->id) }}";
        var routeGraphElecHc = "{{ route('consumption.elechcgraphajax', $site->id) }}";
        var ConsumptionEditText = "{{ trans('consumption.Consumption_edit') }}";
        var ConsumptionDeleteText = "{{ trans('consumption.Consumption_delete') }}";
        var ConsumptionDeletedText = "{{ trans('consumption.Consumption_deleted') }}";
    </script>
    {!! Html::script('js/views/consumption-index.js') !!}
@endsection