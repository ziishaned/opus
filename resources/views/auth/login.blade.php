@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-top: 50px;">
        <div class="col-md-6 col-md-offset-3">
            <h1 style="margin-bottom: 15px;">Login</h1>
            <form role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="input-group flat-input-con">
                        <span class="input-group-addon input-label">Email</span>
                        <input id="email" type="email" class="form-control input" name="email" value="{{ old('email') }}" required data-error="That email address is invalid" autocomplete="off">
                    </div>
                    <div class="help-block with-errors">
                        @if ($errors->has('email'))
                            <strong>{{ $errors->first('email') }}</strong>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="input-group flat-input-con">
                        <span class="input-group-addon input-label">Password</span>
                        <input id="password" type="password" class="form-control input" name="password" data-error="Password field is required" required autocomplete="off">
                    </div>
                    <div class="help-block with-errors">
                        @if ($errors->has('password'))
                            <strong>{{ $errors->first('password') }}</strong>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>

                    <a class="btn btn-link" href="{{ url('/password/reset') }}">
                        Forgot Your Password?
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
