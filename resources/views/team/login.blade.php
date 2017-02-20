@extends('layouts.master')

@section('content')
	<div class="home-con">
		@include('partials.home-nav')
		<div class="home-page login-page">
			<div class="login-form-con">
		        <h1 class="header">Login to Team</h1>
		        <form action="{{ route('team.postlogin') }}" method="POST" role="form">
		            <div class="form-group {{ $errors->has('team_name') ? 'has-error' : '' }}">
                        <label for="team-name" class="control-label">Team Name</label>
                        <input type="text" name="team_name" class="form-control" id="team-name" autocomplete="off" required>
                        @if($errors->has('team_name'))
                            <p class="help-block has-error">{{ $errors->first('team_name') }}</p>
                        @else
                            <p class="help-block">Enter your team name here. e.g. Google</p>
                        @endif
                    </div>
		            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
		                <label for="email" class="control-label">Email</label>
		                <input name="email" id="email" value="{{ old('email') }}" type="email" class="form-control" placeholder="john@example.com" required>
                        @if($errors->has('email'))
                            <p class="help-block has-error">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
		            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password" class="control-label">Password</label>
                        <input name="password" id="password" type="password" class="form-control" required>
                        @if($errors->has('password'))
                            <p class="help-block has-error">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
		            <div class="checkbox">
		                <label>
		                    <input type="checkbox" name="remember">
		                    Remember me
		                </label>
		            </div>
		            <div style="margin-top: 15px;">
			            <input type="submit" class="btn btn-success" value="Submit"> <span class="text-muted" style="margin-left: 15px;">Don't have a team?</span><a href="{{ route('team.create') }}"> Create now</a>.
		            </div>
		        </form>
			</div>
		</div>
	</div>
@endsection()