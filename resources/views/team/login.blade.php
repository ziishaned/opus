@extends('layouts.master')

@section('content')
	<div class="home-con">
		@include('partials.home-nav')
		<div class="home-page login-page">
			<div class="login-form-con" style="margin-bottom: 24px;">
		        <h1 class="header text-center" style="font-size: 28px;">Login</h1>
                @if($errors->has('wrong_credential'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ $errors->first('wrong_credential') }}
                    </div>
                @endif
                <form action="{{ route('team.postlogin') }}" method="POST" role="form">
		            <div class="form-group {{ $errors->has('team_name') ? 'has-error' : '' }}">
                        <label for="team-name" class="control-label">Team Name</label>
                        <input type="text" name="team_name" class="form-control" id="team-name" autocomplete="on" required>
                        @if($errors->has('team_name'))
                            <p class="help-block has-error">{{ $errors->first('team_name') }}</p>
                        @else
                            <p class="help-block">Enter your team name here. e.g. Google</p>
                        @endif
                    </div>
		            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
		                <label for="email" class="control-label">Email</label>
		                <input name="email" id="email" value="{{ old('email') }}" type="email" class="form-control" placeholder="john@doe.com" required>
                        @if($errors->has('email'))
                            <p class="help-block has-error">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
		            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
		            	<a href="{{ route('password.request') }}" class="text-muted pull-right" style="font-size: 14px;">Forgot your password?</a>
                        <label for="password" class="control-label">Password</label>
                        <input name="password" id="password" type="password" class="form-control" required>
                        @if($errors->has('password'))
                            <p class="help-block has-error">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
		            <div class="checkbox" style="margin-top: 20px; margin-bottom: 20px;">
		                <label>
		                    <input type="checkbox" name="remember">
		                    Remember me
		                </label>
		            </div>
		            <div style="margin-top: 15px; margin-bottom: 10px;">
			            <input type="submit" class="btn btn-primary btn-block btn-lg" value="Login">
		            </div>
		        </form>
			</div>
			<p class="text-center" style="font-size: 14px;"><span class="text-muted" style="margin-left: 15px;">Don't have a team?</span> <a href="{{ route('team.create') }}">Create now</a>.</p>
		</div>
	</div>
@endsection()