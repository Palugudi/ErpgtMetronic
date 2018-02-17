@extends('layouts.master')

@section('body', "key-index")

@section('title', trans('key.Keys_list'))

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-8">
                <h1><a href="{{ Route('site.show', $site->id) }}">{{ $site->name}}</a> / {{trans('key.Keys_list')}}</h1>
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewKey({{$site->id}});' data-toggle="modal">
                    {{trans('key.Key_add_new')}} 
                </button>
            </div>

            <div class="col-md-12">
                <hr>
            </div>
        </div><!-- end of header .row -->

        <div class="row">
            <div class="col-md-12">
                <div id="keyList"></div>
            </div>
        </div>

    </section>
    @include('pages.key.modal')
@endsection

@section('scripts')
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routeKey = "{{ url('key') }}";
        var routeKeyAjax = "{{ route('key.listajax', $site->id) }}";

        var KeyAddText = "{{ trans('key.Key_add?')}}";
        var KeyEditText = "{{ trans('key.Key_edit') }}";
        var KeyDeleteText = "{{ trans('key.Key_delete') }}";
        var KeyDeletedText = "{{ trans('key.Key_deleted') }}";
        var KeyQRCodeText = "{{ trans('key.QRCode') }}";
    </script>
    {!! Html::script('js/views/key-index.js') !!}
@endsection