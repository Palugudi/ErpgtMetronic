@extends('layouts.master')

@section('body', "order-index")

@section('title', trans('order.Orders_list'))

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')

    <!-- Begin: Subheader -->
	<div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    @if(isset($site))
                       <a href="{{ Route('site.show', $site->id) }}">{{ $site->name}}</a> / {{trans('order.Orders_list')}}
                    @else
                       {{trans('order.Orders_list')}}
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
                    {{trans('order.Order_add_new')}}  
                    </button>
                </div>
            @endif
        </div><br />

        <section id="section-1" class="parallax">
            <div class="row">
                <div class="col-md-12">
                    <div id="orderList"></div>
                </div>
            </div>
        </section>
    </div>
    @include('pages.order.modal')
@endsection

@section('scripts')
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routeOrder = "{{ url('order') }}";
        var routeOrderAjax = "{{ (isset($site->id) ? route('order.listajax', $site->id) : route('orders.listajax')) }}";
        
        var OrderAddText = "{{ trans('order.Order_add?')}}";
        var OrderEditText = "{{ trans('order.Order_edit') }}";
        var OrderDeleteText = "{{ trans('order.Order_delete') }}";
        var OrderDeletedText = "{{ trans('order.Order_deleted') }}";
    </script>
    {!! Html::script('js/views/order-index.js') !!}
@endsection