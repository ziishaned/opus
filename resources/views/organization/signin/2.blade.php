@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 70px;">
            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                <div style="margin-bottom: 10px;">
                    <h2 style="margin-bottom: 0px;">Sign in to organziation</h2>
                    <p>Enter the required credentials to login to your organization.</p>
                </div>
                <form action="{{ route('organizations.postsignin', $step) }}" method="POST" role="form" data-toggle="validator">
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
                        <label for="password" class="control-label">Password</label>
                        <input id="password" type="password" class="form-control input" name="password" data-error="The password field is required." required>
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
                    <input type="submit" class="btn btn-primary pull-right" value="Submit">
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
