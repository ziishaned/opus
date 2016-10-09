@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="nav nav-pills" id="organization-nav">
                <li class="active"><a href="{{ url('/users/' . $user->id)  }}">Profile</a></li>
                <li><a href="{{ url('/users/' . $user->id . '/organizations')  }}">Organizations</a></li>
                <li><a href="#">Follower <span class="badge">3</span></a></li>
                <li><a href="#">Following <span class="badge">6</span></a></li>
            </ul>
        </div>
    </div>
    <div class="row" style="margin-top: 20px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <h3 style="margin: 0;">Profile</h3>
                </div>
            </div>
            <hr style="margin-top: 12px;">
            <div class="row" style="margin-top: 20px;">
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <div class="user-profile-pic">
                        <img src="/images/default.png" class="img-responsive img-rounded" alt="Image">
                    </div>
                    <p style="margin-top: 5px; margin-bottom: 0; font-size: 24px; text-transform: capitalize;">{{ $user->name  }}</p>
                    <p><i class="fa fa-envelope"></i> {{ $user->email  }}</p>
                    <p><i class="fa fa-clock-o"></i> Joined on {{  $user->created_at->toFormattedDateString() }}</p>
                    <a href="#" class="btn btn-default btn-block" style="margin-top: 10px;"><i class="fa fa-user-plus"></i> Follow</a>
                </div>
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3 style="margin: 0;">Activity</h3>
                            <hr>
                            <div class="activity">
                                <div class="row">
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <p style="margin-top: 5px; margin-bottom: 0;"><i class="fa fa-file-image-o"></i> Admin attached Screenshot-08-10-201.png to <b>Wiki Name</b> at <b>Ourganization Name</b></p>
                                        <p style="margin-top: 5px; margin-bottom: 0;"><i class="fa fa-commenting-o"></i> Admin commented on page Lorem ipsum dolor sit to <b>Wiki Name</b> at <b>Ourganization Name</b></p>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">
                                        <p>18 hours ago</p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="activity">
                                <div class="row">
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <p style="margin-top: 5px; margin-bottom: 0;"><i class="fa fa-file-image-o"></i> Admin attached Screenshot-08-10-201.png to <b>Wiki Name</b> at <b>Ourganization Name</b></p>
                                        <p style="margin-top: 5px; margin-bottom: 0;"><i class="fa fa-file-text-o"></i> Admin create page Lorem ipsum dolor sit to <b>Wiki Name</b> at <b>Ourganization Name</b></p>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">
                                        <p>2 days ago</p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="activity">
                                <div class="row">
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <p style="margin-top: 5px; margin-bottom: 0;"><i class="fa fa-file-image-o"></i> Admin attached Screenshot-08-10-201.png to <b>Wiki Name</b> at <b>Ourganization Name</b></p>
                                        <p style="margin-top: 5px; margin-bottom: 0;"><i class="fa fa-file-text-o"></i> Admin create page Lorem ipsum dolor sit to <b>Wiki Name</b> at <b>Ourganization Name</b></p>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">
                                        <p>10 days ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
