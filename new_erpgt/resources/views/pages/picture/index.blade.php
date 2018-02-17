@extends('layouts.master')

@section('body', "picture-index")

@section('title', trans('picture.Pictures_list'))

@section('stylesheets')
    {{ Html::style('css/slim.min.css') }}
    {{ Html::style('css/lightbox.min.css') }}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-8">
                <h1><a href="{{ Route('site.show', $site->id) }}">{{ $site->name}}</a> / {{trans('picture.Pictures_list')}}</h1>
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewPicture();' data-toggle="modal">
                    {{trans('picture.Picture_add_new')}} 
                </button>
            </div>

            <div class="col-md-12">
                <hr>
            </div>
        </div><!-- end of header .row -->

        <div class="row">
            <div class="col-md-12">
                <div id="pictureList"></div>
            </div>
        </div>

    </section>
    @include('pages.picture.modal')
@endsection

@section('scripts')
    {!! Html::script('js/lightbox.min.js') !!}
    {!! Html::script('js/slim.kickstart.min.js') !!}
    <script>
        var token = "{{ csrf_token() }}";
        var routePicture = "{{ url('picture') }}";
        var routePictureAjax = "{{ route('picture.listajax', $site->id) }}";
        var PictureEditText = "{{ trans('picture.Picture_edit') }}";
        var PictureDeleteText = "{{ trans('picture.Picture_delete') }}";
        var PictureDeletedText = "{{ trans('picture.Picture_deleted') }}";
    </script>
    {!! Html::script('js/views/picture-index.js') !!}
@endsection