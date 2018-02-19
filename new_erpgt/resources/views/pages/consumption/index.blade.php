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
                <div class="row container-fluid">
                    <div class="col-md-6">
                        <h2><a href="{{ Route('site.show', $site->id) }}">{{ $site->name}}</a> / {{trans('consumption.Consumptions_list')}}</h2>
                    </div>

                    <div class="col-md-6">
                        <button type="button" class="btn btn-lg btn-block btn-info" href="#" OnClick='NewConsumption();' data-toggle="modal">
                            {{trans('consumption.Consumption_add_new')}} 
                        </button>
                    </div>
                </div>
        </div>
    </div>
    <!-- END: Subheader -->

    <section id="section-1" class="parallax">
            <div class="col-md-12">
                <hr>
                <nav>
                    <div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" data-toggle="tab" href="#nav-eau-tab" role="tab" aria-controls="nav-eau-tab" aria-selected="true"> <strong><i class="fa fa-tint"></i>Eau</strong></a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-elecHP-tab" role="tab" aria-controls="nav-elecHP-tab" aria-selected="false"><strong><i class="fa fa-bolt"></i>Electricité HP</strong></a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-elecHC-tab" role="tab" aria-controls="nav-elecHC-tab" aria-selected="false"><strong><i class="fa fa-bolt"></i>Electricité HC</strong></a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-gaz-tab" role="tab" aria-controls="nav-gaz-tab" aria-selected="false"><strong><i class="fa fa-fire"></i>Gaz</strong></a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-eau-tab" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div id="waterGraph"></div>
                        <div class="m-widget4__chart m--margin-top-10 m--margin-top-20" style="height:300px;">
                            <canvas id="m_watergraph"></canvas>
                        </div>
                        <div id="waterList"></div>
                    </div>
                    <div class="tab-pane fade" id="nav-elecHP-tab" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div id="elecHPGraph"></div>
                        
                        <div class="m-widget4__chart m--margin-top-10 m--margin-top-20" style="height:300px;">
                            <canvas id="m_elechpgraph"></canvas>
                        </div>
                        <div id="elecHPList"></div>
                    </div>
                    <div class="tab-pane fade" id="nav-elecHC-tab" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div id="elecHCGraph"></div>
                        <div class="m-widget4__chart m--margin-top-10 m--margin-top-20" style="height:300px;">
                            <canvas id="m_elechcgraph"></canvas>
                        </div>
                        <div id="elecHCList"></div>
                    </div>
                    <div class="tab-pane fade" id="nav-gaz-tab" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div id="gasGraph"></div>
                        <div class="m-widget4__chart m--margin-top-10 m--margin-top-20" style="height:300px;">
                            <canvas id="m_gasgraph"></canvas>
                        </div>
                        <div id="gasList"></div>
                    </div>
                </div>
            </div>
            <br /> <br />
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