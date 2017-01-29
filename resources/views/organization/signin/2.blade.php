@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="create-organization">
                        <div class="create-organization-head">
                            <h2 class="text-center create-organization-heading marginless">Signin to organization</h2>
                            <p class="text-center">Organization a centralized place for your company to document who you are, what you do, and how to achieve results.</p>
                        </div>
                        <div class="create-organization-body">
                            <ul class="nav nav-pills nav-justified thumbnail">
                                <li class="disabled">
                                    <a href="#" class="step-completed">
                                        <h4 class="list-group-item-heading"><i class="fa fa-check fa-lg fa-fw"></i> Step 1</h4>
                                        <p class="list-group-item-text">Organization information</p>
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="#">
                                        <h4 class="list-group-item-heading">Step 2</h4>
                                        <p class="list-group-item-text">Account credentials</p>
                                    </a>
                                </li>
                            </ul>        
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <h2 class="top0">Sign in to organziation</h2>
                    <p>Enter the required credentials to login to your organization.</p>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
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
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
