@extends('layouts.master')

@section('content')
	<div class="home-con">
		@include('partials.home-nav')
		<div class="login-page">
			<div class="login-form-con" style="margin-bottom: 24px;">
		        <h1 class="header text-center" style="font-size: 28px;">Create a Team</h1>
		        <form action="{{ route('team.store') }}" method="POST" role="form">
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
		                <label for="email" class="control-label">Email</label>
		                <input name="email" id="email" value="{{ old('email') }}" type="email" class="form-control" placeholder="john@doe.com" required>
                        @if($errors->has('email'))
                            <p class="help-block has-error">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                                <label for="first-name" class="control-label">First name</label>
                                <input name="first_name" value="{{ old('first_name') }}" id="first-name" type="text" class="form-control" placeholder="John" required>
                                @if($errors->has('first_name'))
                                    <p class="help-block has-error">{{ $errors->first('first_name') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                                <label for="last-name" class="control-label">Last name</label>
                                <input name="last_name" value="{{ old('last_name') }}" id="last-name" type="text" class="form-control" placeholder="Doe" required>
                                @if($errors->has('last_name'))
                                    <p class="help-block has-error">{{ $errors->first('last_name') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
		            <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="password" class="control-label">Password</label>
                                <input name="password" id="password" type="password" class="form-control" required>
                                @if($errors->has('password'))
                                    <p class="help-block has-error">{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                <label for="password-confirm" class="control-label">Confirm Password</label>
                                <input name="password_confirmation" id="password-confirm" type="password" class="form-control" required>
                                @if($errors->has('password_confirmation'))
                                    <p class="help-block has-error">{{ $errors->first('password_confirmation') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('team_name') ? 'has-error' : '' }}">
                        <label for="team-name" class="control-label">Team Name</label>
                        <input type="text" name="team_name" class="form-control" id="team-name" autocomplete="off" required>
                        @if($errors->has('team_name'))
                            <p class="help-block has-error">{{ $errors->first('team_name') }}</p>
                        @else
                            <p class="help-block">Enter your team name here. e.g. Google</p>
                        @endif
                    </div>
		            <div style="margin-top: 25px; margin-bottom: 10px;">
			            <input type="submit" class="btn btn-success btn-block btn-lg" value="Submit">
		            </div>
		        </form>
			</div>
            <p class="text-center"><span class="text-muted" style="margin-left: 15px;">Already have a team?</span> <a href="{{ route('team.login') }}"> Login now</a></p>
		</div>
	</div>
@endsection