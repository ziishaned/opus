@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 70px;">
            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                <div style="margin-bottom: 10px;">
                    <h2 style="margin-bottom: 0px;">Enter your credentials</h2>
                    <p>Enter the required credentials to join organization.</p>
                </div>
                <form action="{{ route('organizations.postjoin', $step) }}" method="POST" role="form" data-toggle="validator">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="control-label">First name</label>
                                <input id="first_name" value="{{ old('first_name') }}" type="text" class="form-control input" name="first_name" required>
                                <div class="help-block with-errors">
                                    @if ($errors->has('first_name'))
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    @endif
                                </div>
                            </div>        
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name" class="control-label">Last name</label>
                                <input id="last_name" value="{{ old('last_name') }}" type="text" class="form-control input" name="last_name" required>
                                <div class="help-block with-errors">
                                    @if ($errors->has('last_name'))
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label">Email</label>
                        <input id="email" value="{{ old('email') }}" type="email" class="form-control input" name="email" data-error="That email address is invalid." required>
                        <div class="help-block with-errors">
                            @if ($errors->has('email'))
                                <strong>{{ $errors->first('email') }}</strong>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control input" name="password" required>
                        <div class="help-block with-errors">
                            @if ($errors->has('password'))
                                <strong>{{ $errors->first('password') }}</strong>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control input" name="password_confirmation" required>
                        <div class="help-block with-errors">
                            @if ($errors->has('password_confirmation'))
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            @endif
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary pull-right" value="Submit">
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
