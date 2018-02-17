@extends('layouts.master')

@section('body', "users-index")

@section('title', $key->key_number)

@section('stylesheets')
    {{ Html::style('css/bootstrap-datetimepicker.min.css') }}
@endsection

@section('content')
    <section id="section-1" class="parallax">
        <div class="row">
            <div class="col-md-12">
            <!-- FIL D'ARIAN -->
                <h1><a href="{{ Route('site.show', $key->site_id) }}">{{ $site->name }}</a> / <a href="{{ Route('key.index', $site->id) }}">{{trans('key.Keys')}}</a> / {{$key->key_number}}</h1>
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
                                <label>{{trans('key.building')}} :</label> {{ $key->building }}
                            </dl>
                            <dl class="dl-horizontal">
                                <label>{{trans('key.floor')}} :</label> {{ $key->floor }}
                            </dl>
                            <dl class="dl-horizontal">
                                <label>{{trans('key.designation')}} :</label> {{ $key->designation }}
                            </dl>
                            <dl class="dl-horizontal">
                                <label>{{trans('key.cylinder_number')}} :</label> {{ $key->cylinder_number }}
                            </dl>
                            <dl class="dl-horizontal">
                                <label>{{trans('key.key_number')}} :</label> {{ $key->key_number }}
                            </dl>
                            <dl class="dl-horizontal">
                                <label>{{trans('key.comments')}} :</label> {{ $key->comments }}
                            </dl>
                        </div>
                        <div class="col-md-6">
                            {{-- @if(!$user->intern_contact)   
                                <dl class="dl-horizontal">
                                    <label>{{trans('general.CompanyName')}} :</label>
                                    {{ $user->company_name }}
                                </dl>
                                <dl class="dl-horizontal">
                                    <label>{{trans('general.CompanyAddress')}} :</label> 
                                    {{ $user->company_address.' '.$user->company_postal_code.' '.$user->company_city}}
                                </dl>
                                <dl class="dl-horizontal">
                                    <label>{{trans('general.InterventionDomain')}} :</label> 
                                    {{ $intervention_domains[$user->intervention_domain] }}
                                </dl>
                            @endif --}}
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="well">
                            {!! QrCode::size(200)->generate(url()->current()) !!} 
                            {{-- <dl class="dl-horizontal">
                                <dt>{{trans('general.Role')}} :</dt>
                                <dd>{{ (isset($role->name) ? $role->name : "") }}</dd>
                            </dl>                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="" OnClick='EditUser({{$user->id}});' data-toggle="modal" class="btn btn-primary btn-block">{{ trans('general.EditUser') }}</a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @include('partials.scripts.table')
    <script>

    </script>
    {{-- {!! Html::script('js/views/key-show.js') !!} --}}
@endsection