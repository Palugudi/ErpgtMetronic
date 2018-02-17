@extends('layouts.master')

@section('body', "intervention-index")

@section('title', trans('intervention.Interventions_list'))

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
   <!-- Begin: Subheader -->
	<div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    {{trans('intervention.Interventions_list')}}
                </h3>
            </div>
        </div>
	</div>
	<!-- END: Subheader -->

    <div class="m-content">
        <div class="row">
            <div class="col"></div>
                <div class="col">
                    <button type="button" class="btn m-btn--square  btn-primary btn-block" OnClick='NewIntervention();' data-toggle="modal">
                       {{trans('intervention.Intervention_add_new')}}  
                    </button>
                </div>
        </div><br />

        <section id="section-1" class="parallax">
            <div class="row">
                <div class="col-md-12">
                    <div id="interventionList"></div>
                </div>
            </div>
        </section>
    </div>
    @include('pages.intervention.modal')
@endsection

@section('scripts')
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routeIntervention = "{{ url('intervention') }}";
        var routeInterventionAjax = "{{ route('intervention.listajax') }}";
        var InterventionEditText = "{{ trans('intervention.Intervention_edit') }}";
        var InterventionDeleteText = "{{ trans('intervention.Intervention_delete') }}";
        var InterventionDeletedText = "{{ trans('intervention.Intervention_deleted') }}";
    </script>
    {!! Html::script('js/views/intervention-index.js') !!}
@endsection