@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="create-organization">
                        <div class="create-organization-head">
                            <h2 class="text-center create-organization-heading marginless">Join organziation</h2>
                            <p class="text-center">Organization a centralized place for your company to document who you are, what you do, and how to achieve results.</p>
                        </div>
                        <div class="create-organization-body">
                            <ul class="nav nav-pills nav-justified thumbnail">
                                <li class="disabled">
                                    <a href="#" class="step-completed">
                                        <h4 class="list-group-item-heading"><i class="fa fa-check fa-fw fa-lg"></i> Step 1</h4>
                                        <p class="list-group-item-text">Organization information</p>
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="#">
                                        <h4 class="list-group-item-heading">Step 2</h4>
                                        <p class="list-group-item-text">Personal information</p>
                                    </a>
                                </li>
                            </ul>        
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <h2 class="top0">Personal information</h2>
                    <p>This information will appear on your profile and also set passsword to secure your account.</p>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
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
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
