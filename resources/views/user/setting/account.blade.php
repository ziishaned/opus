@extends('layouts.app')

@section('content')
    <div class="row">
        @include('layouts.partials.setting-nav')
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            <h2>Change password</h2>
            <p style="margin-bottom: 7px;">Once you successfully change your password you will be logout and after that you can login to your account with your new password.</p>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <form action="{{ route('users.password.update', Auth::user()->slug) }}" method="POST" role="form">
                        {!! method_field('patch') !!}
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="input-group flat-input-con">
                                <span class="input-group-addon input-label" style="width: 166px;">Old password</span>
                                <input type="password" id="password" name="password" class="form-control input" autocomplete="off">
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                            <div class="input-group flat-input-con">
                                <span class="input-group-addon input-label" style="width: 166px;">New password</span>
                                <input type="password" name="new_password" class="form-control input" id="new-password" autocomplete="off">
                                @if ($errors->has('new_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <div class="input-group flat-input-con">
                                <span class="input-group-addon input-label" style="width: 166px;">Password confirmation</span>
                                <input type="password" name="password_confirmation" class="form-control input" id="password-confirmation" autocomplete="off">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-default" value="Update password"> <a href="#">I forgot my password</a>
                        </div>    
                    </form>
                </div>
            </div>
            <hr>
            <div style="margin-bottom: 17px;">
                <h2>Delete account</h2>
                <p style="margin-bottom: 7px;">Once you delete your account, there is no going back. Please be certain.</p>
                <a href="#" class="btn btn-default" onclick="if(confirm('Are you sure you want to delete your account?')) {event.preventDefault(); document.getElementById('delete-user-account').submit();}" id="delete-account"><i class="fa fa-trash-o"></i> Delete your account</a>
                <form id="delete-user-account" action="{{ route('users.destroy', Auth::user()->slug) }}" method="POST" style="display: none;">
                    {!! method_field('delete') !!}
                    {!! csrf_field() !!}
                </form>
            </div>
            <hr>
        </div>
    </div>
@endsection
