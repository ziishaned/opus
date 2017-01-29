@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'organizations/{organization_slug}/settings/profile') class="active" @endif role="presentation">
                        <a href="{{ route('settings.profile', [$organization->slug, ]) }}">Profile</a>            
                    </li>
                    <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'organizations/{organization_slug}/settings/account') class="active" @endif role="presentation">
                        <a href="{{ route('settings.account', [$organization->slug, ]) }}">Account</a>
                    </li>
                </ul>
                <div class="tab-content tab-bordered">
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <h2 class="mt0">Change password</h2>
                            <p class="text-muted">After a successful password update, you will be redirected to the login page where you can log in with your new password.</p>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
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
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" value="Update password"> <a href="#">I forgot my password</a>
                                </div>    
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <h2 class="mt0">Leave organization</h2>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p>Once you clicked the delete your account button your account will be deleted from this organization. Please be certain.</p>
                            <a href="#" style="color: #fff;" class="btn btn-danger" onclick="if(confirm('Are you sure you want to delete your account?')) {event.preventDefault(); document.getElementById('delete-user-account').submit();}" id="delete-account"><i class="fa fa-trash-o"></i> Delete your account</a>
                            <form id="delete-user-account" action="{{ route('users.destroy', [$organization->slug, Auth::user()->slug]) }}" method="POST" style="display: none;">
                                {!! method_field('delete') !!}
                                {!! csrf_field() !!}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
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
                </div>
            </div> --}}
        </div>
    </section>
@endsection
