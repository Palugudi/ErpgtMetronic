@extends('layouts.master')

@section('body', "users-show")

@section('title', $user->first_name)

@section('stylesheets')
    {{ Html::style('css/bootstrap-datetimepicker.min.css') }}
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-12">
            <!-- FIL D'ARIAN -->
                <h1><a href="{{ Route('users.index') }}">{{trans('general.Users')}}</a> / {{ $user->first_name.' '.$user->last_name }}</h1>
                <hr>
            </div>
        </div><!-- end of header .row -->
        <div class="row">
            <div class="col-md-12">
                <br>
                <div class="row">
                    <div class="col-md-8">
                        <div class="col-md-6">
                            <dl class="dl-horizontal">
                                <label>{{trans('general.First_name')}} :</label> {{ $user->first_name }}
                            </dl>
                            <dl class="dl-horizontal">
                                <label>{{trans('general.Last_name')}} :</label> {{ $user->last_name }}
                            </dl>
                            <dl class="dl-horizontal">
                                <label>{{trans('general.Email')}} :</label> {{ $user->email }}
                            </dl>
                            <dl class="dl-horizontal">
                                <label>{{trans('general.Phone')}} :</label> {{ $user->phone }}
                            </dl>
                            <dl class="dl-horizontal">
                                <label>{{trans('general.Map_creator')}} :</label> 
                                {{ ($user->map_creator ? trans('general.Map_creator_true') : trans('general.Map_creator_false')) }}
                            </dl>
                        </div>
                        <div class="col-md-6">
                            @if(!$user->intern_contact)   
                                <dl class="dl-horizontal">
                                    <label>{{trans('general.CompanyName')}} :</label> {{ $user->company_name }}
                                </dl>
                                <dl class="dl-horizontal">
                                    <label>{{trans('general.CompanyAddress')}} :</label> {{ $user->company_address.' '.$user->company_postal_code.' '.$user->company_city}}
                                </dl>
                                <dl class="dl-horizontal">
                                    <label>{{trans('general.InterventionDomain')}} :</label> {{ $intervention_domains[$user->intervention_domain] }}
                                </dl>
                            @endif
                        </div>
                        {{-- <div class="col-md-12">
                            <dl class="dl-horizontal">
                                <label>{{trans('general.')}} :</label> 
                            </dl>
                        </div> --}}
                    </div>


                    <div class="col-md-4">
                        <div class="well">
                            <dl class="dl-horizontal">
                                <dt>{{trans('general.Role')}} :</dt>
                                <dd>{{ (isset($role->name) ? $role->name : "") }}</dd>
                            </dl>                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="" OnClick='EditUser({{$user->id}});' data-toggle="modal" class="btn btn-primary btn-block">{{ trans('general.EditUser') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <br>
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a data-toggle="tab" href="#interventions"><strong>{{trans('intervention.Interventions')}}</strong></a></li>
                    @if(!$user->intern_contact)
                        <li><a data-toggle="tab" href="#sites"><strong>{{trans('general.SiteLinked')}}</strong></a></li>
                    @endif
                    <br>
                </ul>
                <div class="tab-content">
                    <div id="interventions" class="tab-pane fade in active">
                        <div id="intervention_fill">
                        </div>
                    </div>
                    <div id="sites" class="tab-pane fade">
                        <div class="col-md-12">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="button" class="btn btn-block btn-primary" href="" OnClick="NewUserSite({{ $user->id }})" data-toggle="modal">{{ trans('general.UserSiteAdd') }}</button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="sites_fill">
                            </div>
                        </div>
                    </div>
                </div>
                
                </div><!-- end of header .row -->
            </div>
        </div>
    </section>
    @include('pages.users.modal')
    @include('pages.users.modalsite')
@endsection

@section('scripts')
    {!! Html::script('js/moment-with-locales.min.js') !!}
    {!! Html::script('js/bootstrap-datetimepicker.min.js') !!}
    @include('partials.scripts.table')
    <script>
        var token = "{{ csrf_token() }}";
        var routeUser = "{{ url('users') }}";
        var routeDeleteSiteLink = "{{ url('users') }}"+"/"+"{{$user->id}}"+"/delete";
        var routeAddSiteLink = "{{ url('users') }}"+"/"+"{{$user->id}}"+"/createsitelink";
        var routeUserAjax = "{{ route('users.listajax') }}";
        var routeSiteAjax = "{{ route('site.listajaxuser', $user->id) }}";
        var routeAjaxIntervention = "{{ url('intervention/listajaxuser') }}"+"/"+"{{$user->id}}";
        var UserAddText = "{{ trans('general.User_add')}}";
        var UserEditText = "{{ trans('general.User_edit') }}";
        var UserDeleteText = "{{ trans('general.User_delete') }}";
        var UserDeletedText = "{{ trans('general.User_deleted') }}";

        var UserSiteDeleteText = "{{ trans('general.UserSiteDelete')}}";
        var UserSiteDeletedText = "{{ trans('general.UserSiteDeleted')}}";
        var UserSiteAddText = "{{ trans('general.UserSiteAdd')}}";

    </script>
    {!! Html::script('js/views/users-show.js') !!}
@endsection