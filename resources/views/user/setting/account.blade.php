@extends('layouts.app')

@section('content')
    <div class="subnav" style="background-color: #f8f8f8; border-bottom: 1px solid #E0E0E0;">
        <div class="container">
            <div class="subnav">
                <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                    <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'organizations/{organization_slug}/settings/profile') class="active" @endif>
                        <a href="{{ route('settings.profile', [$organization->slug, ]) }}">Profile</a>            
                    </li>
                    <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'organizations/{organization_slug}/settings/account') class="active" @endif>
                        <a href="{{ route('settings.account', [$organization->slug, ]) }}">Account</a>        
                    </li>
                    <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'organizations/{organization_slug}/settings/notifications') class="active" @endif>
                        <a href="{{ route('settings.notifications', [$organization->slug, ]) }}">Notifications</a>            
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h2>Change password</h2>
                <p style="margin-bottom: 7px;">Once you successfully change your password you will be logout and after that you can login to your account with your new password.</p>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <form action="{{ route('users.password.update', [$organization->slug, Auth::user()->slug]) }}" method="POST" role="form">
                            {!! method_field('patch') !!}
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">  
                                <label for="password">Old password</label>
                                <input type="password" id="password" name="password" class="form-control input" autocomplete="off">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                                <label for="new-password">New password</label>
                                <input type="password" name="new_password" class="form-control input" id="new-password" autocomplete="off">
                                @if ($errors->has('new_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirmation">Password confirmation</label>
                                <input type="password" name="password_confirmation" class="form-control input" id="password-confirmation" autocomplete="off">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
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
                    <a href="#" style="color: #fff;" class="btn btn-danger" onclick="if(confirm('Are you sure you want to delete your account?')) {event.preventDefault(); document.getElementById('delete-user-account').submit();}" id="delete-account"><i class="fa fa-trash-o"></i> Delete your account</a>
                    <form id="delete-user-account" action="{{ route('users.destroy', [$organization->slug, Auth::user()->slug]) }}" method="POST" style="display: none;">
                        {!! method_field('delete') !!}
                        {!! csrf_field() !!}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
