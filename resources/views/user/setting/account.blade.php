@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @include('layouts.partials.setting-nav')
        </div>
    </div>

    <div class="row" style="margin-top: 12px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 14px; font-weight: 700;">
                    Change password
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <form action="{{ route('users.password.update', Auth::user()->slug) }}" method="POST" role="form">
                                {!! method_field('patch') !!}
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="control-label">Old password</label>
                                    <input type="password" id="password" name="password" class="form-control dim-input">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                                    <label for="new-password" class="control-label">New password</label>
                                    <input type="password" name="new_password" class="form-control dim-input" id="new-password">
                                    @if ($errors->has('new_password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('new_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="password-confirmation" class="control-label">Password confirmation</label>
                                    <input type="password" name="password_confirmation" class="form-control dim-input" id="password-confirmation">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-default" style="background-image: linear-gradient(#fcfcfc, #eee); font-size: 13px; font-weight: 600;" value="Update password"> <a href="#">I forgot my password</a>
                                </div>    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-danger">
                <div class="panel-heading" style="font-size: 14px; font-weight: 700;">
                    Delete account
                </div>
                <div class="panel-body">
                    <p>Once you delete your account, there is no going back. Please be certain.</p>
                    <a href="#" class="btn btn-default" onclick="if(confirm('Are you sure you want to delete your account?')) {event.preventDefault(); document.getElementById('delete-user-account').submit();}" id="delete-account" style="background-image: linear-gradient(#fcfcfc, #eee); font-size: 13px; font-weight: 600;"><i class="fa fa-trash-o"></i> Delete your account</a>
                    <form id="delete-user-account" action="{{ route('users.destroy', Auth::user()->slug) }}" method="POST" style="display: none;">
                        {!! method_field('delete') !!}
                        {!! csrf_field() !!}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
