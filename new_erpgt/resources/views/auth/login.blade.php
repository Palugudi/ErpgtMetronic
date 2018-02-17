@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <img class="erpgt50" src="images/erpgt50.png" style="margin-left: 484px;">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-4">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus style="margin-left: 420px;  width: 260px; margin-top: 20px;">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-4">
                                <input id="password" type="password" class="form-control" name="password" required style="margin-left: 420px;  width: 260px;">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group" style="margin-left: 420px;">
                            <div class="col-md-4">
                                <button  type="submit" id ="submit" class="btn btn-block btn-primary" style="width: 260px;" >
                                    {{ trans('auth.login') }}
                                </button>
                            </div>
                        </div>
                        <div class="form-group" style="margin-left: 420px;" >
                           <a class="btn btn-link" href="{{ url('/password/reset') }}" style="font-size: 12px;">
                               {{ trans('auth.forgot_password') }}
                           </a>
                                <div class="souvenir" style="font-size: 12px; margin-left: -31px; margin-top: -5px;">
                                    <div class="checkbox" style="margin: -25px 00px 0px 190px;">
                                        <label >
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> {{ trans('auth.remember') }}
                                        </label>
                                    </div>
                                </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>
@endsection
