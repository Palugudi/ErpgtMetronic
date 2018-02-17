@extends('layouts.master')

@section('body', "enterprise-index")

@section('title', trans('enterprise.Enterprises_list'))

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-8">
                <h1><a href="{{ Route('site.show', $site->id) }}">{{ $site->name}}</a> / {{trans('enterprise.Enterprises_list')}}</h1>
            </div>

            {{-- <div class="col-md-4">
                <button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewEnterprise();' data-toggle="modal">
                    {{trans('enterprise.Enterprise_add_new')}} 
                </button>
            </div> --}}

            <div class="col-md-12">
                <hr>
            </div>
        </div><!-- end of header .row -->

        <div class="row">
            <div class="col-md-12">
                <div id="enterpriseList"></div>
            </div>
        </div>

    </section>
    @include('pages.enterprise.modal')
@endsection

@section('scripts')
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routeEnterprise = "{{ url('enterprise') }}";
        var routeEnterpriseAjax = "{{ route('enterprise.listajax', $site->id) }}";
        var EnterpriseEditText = "{{ trans('enterprise.Enterprise_edit') }}";
        var EnterpriseDeleteText = "{{ trans('enterprise.Enterprise_delete') }}";
        var EnterpriseDeletedText = "{{ trans('enterprise.Enterprise_deleted') }}";
    </script>
    {!! Html::script('js/views/enterprise-index.js') !!}
@endsection