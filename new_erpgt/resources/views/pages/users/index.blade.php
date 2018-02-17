@extends('layouts.master')

@section('body', "users-index")

@section('title', trans('general.Users_list'))

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')

	<!-- Begin: Subheader -->
	<div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                {{trans('general.Users_list')}}
                </h3>
            </div>
        </div>
	</div>
	<!-- END: Subheader -->

    <div class="m-content">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <button type="button" class="btn m-btn--square  btn-primary btn-block" OnClick='NewUser();' data-toggle="modal">
                    {{trans('auth.User_add_new')}}  
                </button>
            </div>
        </div><br />

        <section id="section-1" class="parallax">
            <div class="row">
                <div class="col-md-12">
                    <div id="UsersList"></div>
                </div>
            </div>
        </section>

        <div id="UserList"></div>
    </div>
   

    @include('pages.users.modal')
@endsection

@section('scripts')
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routeUser = "{{ url('users') }}";
        var routeUserAjax = "{{ route('users.listajax') }}";
        var UserAddText = "{{ trans('auth.User_add?') }}";
        var UserEditText = "{{ trans('general.User_edit') }}";
        var UserDeleteText = "{{ trans('general.User_delete') }}";
        var UserDeletedText = "{{ trans('general.User_deleted') }}";
        var DataTableUser = "{{trans('general.User')}}";
        var DataTableEmail = "{{trans('general.Email')}}";
        var DataTableJob = "{{trans('contact.Job')}}";
        var DataTableMapCreator = "{{trans('general.Map_creator')}}";
    </script>
    {!! Html::script('js/views/users-index.js') !!}
@endsection