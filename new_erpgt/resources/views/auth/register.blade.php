@extends('layouts.master')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('auth.register') }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">{{ trans('auth.first_name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control ucfirst" name="first_name" value="{{ old('first_name') }}" required autofocus">

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">{{ trans('auth.last_name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control strtoupper" name="last_name" value="{{ old('last_name') }}" required>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            
                                <div class="checkbox">
                                    <label for="intern_contact" class="col-md-4 control-label"><b>{{ trans('auth.contact_type') }}</b></label>

                                    <div class="col-md-6">
                                        
                                        <input type="radio" name="intern_contact" id="intern_contact" checked>
                                        <label for="intern_contact"><b>{{ trans('auth.intern_contact') }}</b></label>
                                        <input type="radio" name="extern_contact" id="extern_contact">
                                        <label for="extern_contact"><b>{{ trans('auth.extern_contact') }}</b></label>
                                    </div>
                                </div>
                            
                        </div>
                        <div id="extern_contact_div" hidden>
                            <div class="form-group">
                                <label for="company_name" class="col-md-4 control-label">{{ trans('auth.company_name') }}</label>

                                <div class="col-md-6">
                                    <input id="company_name" type="text" class="form-control ucfirst" name="company_name" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="company_address" class="col-md-4 control-label">{{ trans('auth.company_address') }}</label>

                                <div class="col-md-6">
                                    <input id="company_address" type="text" class="form-control ucfirst" name="company_address" value="">
                                </div>
                            </div>  

                            <div class="form-group">
                                <label for="company_postal_code" class="col-md-4 control-label">{{ trans('auth.company_postal_code') }}</label>

                                <div class="col-md-6">
                                    <input id="company_postal_code" type="text" class="form-control ucfirst" name="company_postal_code" value="">
                                </div>
                            </div>  

                            <div class="form-group">
                                <label for="company_city" class="col-md-4 control-label">{{ trans('auth.company_city') }}</label>

                                <div class="col-md-6">
                                    <input id="company_city" type="text" class="form-control ucfirst" name="company_city" value="">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('intervention_domain') ? ' has-error' : '' }}">
                                <label for="intervention_domain" class="col-md-4 control-label">{{ trans('auth.intervention_domain') }}</label>

                                <div class="col-md-6">
                                    <select id="intervention_domain" class="form-control ucfirst" name="intervention_domain" value="" required autofocus">
                                        @foreach($domains as $domain) 
                                            <option value="{{$domain->id}}">{{$domain->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('intervention_domain'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('intervention_domain') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- <div class="form-group{{ $errors->has('site') ? ' has-error' : '' }}">
                                <label for="site" class="col-md-4 control-label">{{ trans('auth.site') }}</label>

                                <div class="col-md-6">
                                    <select id="site" class="form-control ucfirst" name="site" value="" required autofocus">
                                        @foreach($sites as $site) 
                                            <option value="{{$site->id}}">{{$site->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('site'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('site') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> --}}


                        </div>

                        <div id="intern_contact_div">
                            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                <label for="role" class="col-md-4 control-label">{{ trans('auth.role') }}</label>

                                <div class="col-md-6">
                                    <select id="role" class="form-control ucfirst" name="role" value="" required autofocus">
                                        @foreach($roles as $role) 
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('role'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group" hidden>
                                <input type="text" id="extern_contact_role" name="extern_contact_role" class="form-control ucfirst" value="{{$extern_role->id}}" hidden="true">
                            </div>
                        </div>               

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{ trans('auth.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">{{ trans('auth.phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="phone" class="form-control" name="phone" value="" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{{ trans('auth.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">{{ trans('auth.password_confirm') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('auth.register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    
    <script>
        $("#intern_contact").change(function () {
            $('#extern_contact').prop("checked", false);
            $('#extern_contact_div').toggle();
            $('#intern_contact_div').toggle();
        });
        $("#extern_contact").change(function () {
            $('#intern_contact').prop("checked", false);
            $('#extern_contact_div').toggle();
            $('#intern_contact_div').toggle();
        });
    </script>
@endsection