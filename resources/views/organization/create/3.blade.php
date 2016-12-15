@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8 col-lg-offset-2">
            <h2>Validate your email address</h2>
            <p style="margin-bottom: 10px;">Enter validation code below that is sent to your email address <i>ziishaned@gmail.com</i>.</p>
            <form action="{{ route('organizations.store', $step) }}" method="POST" role="form" data-toggle="validator">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="first-name">First name</label>
                            <input id="first-name" type="text" class="form-control input" name="first_name" maxlength="15" value="{{ old('first_name') }}" data-error="First name is required field." required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="last-name">Last name</label>
                            <input id="last-name" type="text" class="form-control input" name="last_name" maxlength="15" value="{{ old('last_name') }}" data-error="Last name is required field." required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="inputPassword">Password</label>
                    <input id="inputPassword" type="password" class="form-control input" name="password" data-error="Password field is required" minlength="6" required>
                    <span class="help-block with-errors">
                        @if ($errors->has('password'))
                            <strong>{{ $errors->first('password') }}</strong>
                        @endif
                    </span>
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control input" name="password_confirmation" data-error="Confirm password field is required" minlength="6"  data-match="#inputPassword" data-match-error="Whoops, password and confirm password don't match" required>
                    <span class="help-block with-errors">
                        @if ($errors->has('password_confirmation'))
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        @endif
                    </span>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control input" value="{{ Session::get('email') }}" readonly>
                </div>
                <input type="submit" class="btn btn-primary pull-right" id="create-organization-btn" value="Submit">
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
@endsection
