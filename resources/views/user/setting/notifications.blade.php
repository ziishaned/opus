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
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                <h2>How you receive notifications</h2>
                <hr>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h4 style="margin-bottom: 0;">Watching</h4>
                        <p>Receive notification when someone update any wiki that you are watching.</p>
                        <ul class="list-inline list-unstyled" style="margin: 0;">
                            <li style="padding-left: 0;">
                                <div class="checkbox" style="margin: 0; margin-top: 5px;">
                                    <label>
                                        <input type="checkbox" value="">
                                        Email
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox" style="margin: 0; margin-top: 5px;">
                                    <label>
                                        <input type="checkbox" value="">
                                        Web
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h4 style="margin-bottom: 0;">Mention</h4>
                        <p>Receive notification if someone mention you in a comment.</p>
                        <ul class="list-inline list-unstyled" style="margin: 0;">
                            <li style="padding-left: 0;">
                                <div class="checkbox" style="margin: 0; margin-top: 5px;">
                                    <label>
                                        <input type="checkbox" value="">
                                        Email
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox" style="margin: 0; margin-top: 5px;">
                                    <label>
                                        <input type="checkbox" value="">
                                        Web
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection
