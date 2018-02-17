@extends('layouts.master')

@section('body', "qrcodes-index")

@section('title', trans('qrcode.Qrcode_list'))

@section('stylesheets')

@endsection

@section('content')
    <section id="section-1" class="parallax">
        
        <div class="col-md-12">
            <h1><a href="{{ Route('site.show', $site->id) }}">{{ $site->name}}</a> / {{trans('qrcode.Qrcode_list')}}</h1>
        </div>

        <div class="col-md-12">
            <button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='PrintQrcode();'>
                {{ trans('qrcode.Print') }}     
            </button>
        </div>

        <div class="col-md-6">
            <h3>{{ trans('qrcode.Equipments') }}</h3>
            @foreach($qrcodes_equipments as $qrcode) 
            <div class="row">
                <div class="col-md-3">
                    {{ Html::image($qrcode['qrcode'], 'qrcode', array( 'width' => 70, 'height' => 70 ))}}
                </div>
                <div class="col-md-9 qrcodelabel">                
                    <p>{{ $qrcode['name'] }}, {{ $qrcode['localisation'] }}</p>
                </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-6">
            <h3>{{ trans('qrcode.Keys') }}</h3>
            @foreach($qrcodes_keys as $qrcode) 
                <div class="row">
                    <div class="col-md-3">
                        {{ Html::image($qrcode['qrcode'], 'qrcode', array( 'width' => 70, 'height' => 70 ))}}
                    </div>
                    <div class="col-md-9 qrcodelabel">                
                        <p>{{ $qrcode['name'] }}, {{ $qrcode['building'] }}, {{ $qrcode['floor'] }}</p> 
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@section('scripts')
    <script>
    var routeQrcodeAjax = "{{ route('qrcode.print', $site->id) }}";
    </script>
    {!! Html::script('js/views/qrcode-index.js') !!}
@endsection