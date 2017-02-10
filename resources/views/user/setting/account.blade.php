@extends('layouts.app')

@section('content')
    <div class="user-general-setting">
        <div class="heading text-center">
            <h1>User Settings</h1>
        </div>
        <div role="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation">
                    <a href="{{ route('settings.profile', [$organization->slug, ]) }}">Profile</a>
                </li>
                <li class="active" role="presentation">
                    <a href="{{ route('settings.account', [$organization->slug, ]) }}">Account</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="team-info">
                    <h2>Change password</h2>
                    <p class="text-muted action-info">
                        After a successful password update, you will be redirected to the login page where you can log in with your new password.
                    </p>
                    <form action="{{ route('users.password.update', [$organization->slug, Auth::user()->slug]) }}" method="POST" role="form">
                        {!! method_field('patch') !!}
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">  
                            <label for="password">Current password</label>
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
                        <button type="submit" class="save-team-info pull-right">Save</button>    
                    </form>
                </div>
                <div class="delete-team">
                    <h2>Leave organization</h2>
                    <p class="text-muted action-info">
                        Once you clicked the delete your account button your account will be deleted from this organization. Please be certain.
                    </p>
                    <a href="#" style="color: #fff;" class="btn btn-danger" onclick="if(confirm('Are you sure you want to delete your account?')) {event.preventDefault(); document.getElementById('delete-user-account').submit();}" id="delete-account"><i class="fa fa-trash-o fa-fw"></i> Delete your account</a>
                    <form id="delete-user-account" action="{{ route('users.destroy', [$organization->slug, Auth::user()->slug]) }}" method="POST" style="display: none;">
                        {!! method_field('delete') !!}
                        {!! csrf_field() !!}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection