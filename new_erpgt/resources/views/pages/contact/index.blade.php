@extends('layouts.master')

@section('body', "contact-index")

@section('title', trans('contact.Contacts_list'))

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-8">
                <h1>{{trans('contact.Contacts_list')}}</h1>
            </div>

            {{-- <div class="col-md-4">
                <button type="button" class="btn btn-lg btn-block btn-info" href="" OnClick='NewContact();' data-toggle="modal">
                    {{trans('contact.Contact_add_new')}} 
                </button>
            </div> --}}

            <div class="col-md-12">
                <hr>
            </div>
        </div><!-- end of header .row -->

        <div class="row">
            <div class="col-md-12">
                <div id="contactList"></div>
            </div>
        </div>

    </section>
    @include('pages.contact.modal')
@endsection

@section('scripts')
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routeContact = "{{ url('contact') }}";
        var routeContactAjax = "{{ route('contact.listajax') }}";
        var ContactEditText = "{{ trans('contact.Contact_edit') }}";
        var ContactDeleteText = "{{ trans('contact.Contact_delete') }}";
        var ContactDeletedText = "{{ trans('contact.Contact_deleted') }}";
    </script>
    {!! Html::script('js/views/contact-index.js') !!}
@endsection