@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-top: 50px;">
        <div class="col-md-6 col-md-offset-3">
            <h1 style="margin-bottom: 15px;">Register</h1>
            <form role="form" method="POST" action="{{ url('/register') }}" data-toggle="validator">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="input-group flat-input-con">
                        <span class="input-group-addon input-label" style="width: 138px;">Username</span>
                        <input id="name" type="text" class="form-control input" name="name" pattern="^[_A-z0-9]{1,}$" maxlength="15" value="{{ old('name') }}" data-error="Username can only contain alphabet and number" required>
                    </div>
                    <div class="help-block with-errors">
                        @if ($errors->has('name'))
                            <strong>{{ $errors->first('name') }}</strong>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="input-group flat-input-con">
                        <span class="input-group-addon input-label" style="width: 138px;">Email</span>
                        <input id="email" type="email" class="form-control input" name="email" value="{{ old('email') }}" data-error="That email address is invalid" required>
                    </div>
                    <span class="help-block with-errors">
                        @if ($errors->has('email'))
                            <strong>{{ $errors->first('email') }}</strong>
                        @endif
                    </span>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="input-group flat-input-con">
                        <span class="input-group-addon input-label" style="width: 138px;">Password</span>
                        <input id="inputPassword" type="password" class="form-control input" name="password" data-error="Password field is required" required>

                    </div>
                    <span class="help-block with-errors">
                        @if ($errors->has('password'))
                            <strong>{{ $errors->first('password') }}</strong>
                        @endif
                    </span>
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <div class="input-group flat-input-con">
                        <span class="input-group-addon input-label" style="width: 138px;">Confirm Password</span>
                        <input id="password-confirm" type="password" class="form-control input" name="password_confirmation" data-error="Confirm password field is required" data-match="#inputPassword" data-match-error="Whoops, password and confirm password don't match" required>
                    </div>
                    <span class="help-block with-errors">
                        @if ($errors->has('password_confirmation'))
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        @endif
                    </span>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
