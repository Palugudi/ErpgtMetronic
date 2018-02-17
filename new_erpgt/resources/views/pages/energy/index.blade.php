@extends('layouts.master')

@section('body', "energy-index")

@section('title', trans('energy.Energys_list'))

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-8">
                <h1>{{trans('energy.Energys_list')}}</h1>
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewEnergy();' data-toggle="modal">
                    {{trans('energy.Energy_add_new')}} 
                </button>
            </div>

            <div class="col-md-12">
                <hr>
            </div>
        </div><!-- end of header .row -->

        <div class="row">
            <div class="col-md-12">
                <div id="energyList"></div>
            </div>
        </div>

    </section>
    @include('pages.energy.modal')
@endsection

@section('scripts')
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routeEnergy = "{{ url('energy') }}";
        var routeEnergyAjax = "{{ route('energy.listajax') }}";
        var EnergyEditText = "{{ trans('energy.Energy_edit') }}";
        var EnergyDeleteText = "{{ trans('energy.Energy_delete') }}";
        var EnergyDeletedText = "{{ trans('energy.Energy_deleted') }}";
    </script>
    {!! Html::script('js/views/energy-index.js') !!}
@endsection