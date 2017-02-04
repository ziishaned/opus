@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="create-organization">
                        <div class="create-organization-head">
                            <h1 class="text-center create-organization-heading marginless">Login</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-4 col-lg-offset-4">
                    <form action="{{ route('organizations.postlogin') }}" method="POST" role="form">
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
                                Remember me on this computer
                            </label>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
