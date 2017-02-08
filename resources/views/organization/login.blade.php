@extends('layouts.app')

@section('content')
    <div class="team-login">
        <h1 class="text-center marginless heading">Login to Team</h1>
        <form action="{{ route('organizations.postlogin') }}" method="POST" role="form">
            <div class="form-group{{ $errors->has('organization') ? ' has-error' : '' }}">
                <label for="organization" class="control-label">Team Name</label>
                <input id="organization" type="organization" class="form-control input" name="organization" required>
                @if ($errors->has('organization'))
                    <div class="help-block with-errors">
                        <strong>{{ $errors->first('organization') }}</strong>
                    </div>
                @endif
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">Email</label>
                <input id="email" value="{{ old('email') }}" type="email" class="form-control input" name="email" required>
                @if ($errors->has('email'))
                    <div class="help-block with-errors">
                        <strong>{{ $errors->first('email') }}</strong>
                    </div>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label">Password</label>
                <input id="password" type="password" class="form-control input" name="password" required>
                @if ($errors->has('password'))
                    <div class="help-block with-errors">
                        <strong>{{ $errors->first('password') }}</strong>
                    </div>
                @endif
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember">
                    Remember me
                </label>
            </div>
            <input type="submit" class="create-button" value="Submit"> <span class="text-muted">Already have a team?</span><a href="{{ route('organizations.login') }}"> Login now</a>.
        </form>
    </div>
@endsection