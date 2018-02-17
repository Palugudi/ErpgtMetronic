@extends('layouts.master')

@section('body', "order_status-index")

@section('title', trans('order_status.Order_statuses_list'))

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-8">
                <h1>{{trans('order_status.Order_statuses_list')}}</h1>
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewOrder_status();' data-toggle="modal">
                    {{trans('order_status.Order_status_add_new')}} 
                </button>
            </div>

            <div class="col-md-12">
                <hr>
            </div>
        </div><!-- end of header .row -->

        <div class="row">
            <div class="col-md-12">
                <div id="order_statusList"></div>
            </div>
        </div>

    </section>
    @include('pages.order_status.modal')
@endsection

@section('scripts')
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routeOrder_status = "{{ url('order_status') }}";
        var routeOrder_statusAjax = "{{ route('order_status.listajax') }}";
        var Order_statusEditText = "{{ trans('order_status.Order_status_edit') }}";
        var Order_statusAddText = "{{ trans('order_status.Order_status_add?')}}";
        var Order_statusDeleteText = "{{ trans('order_status.Order_status_delete') }}";
        var Order_statusDeletedText = "{{ trans('order_status.Order_status_deleted') }}";
    </script>
    {!! Html::script('js/views/order_status-index.js') !!}
@endsection