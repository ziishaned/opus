@extends('layouts.app')

@section('content')
    @include('layouts.partials.user-nav')
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
                    @if($user->id != Auth::user()->id)
                        @if(ViewHelper::isFollowing($user->id)) 
                            <button id="unfollow-button" data-follow-id="{{ $user->id }}" class="btn btn-info btn-block following-button">Following</button>
                        @else 
                            <button id="follow-button" class="btn btn-default btn-block" data-follow-id="{{ $user->id }}" style="margin-top: 10px; background-color: #f5f8fa; background-image: linear-gradient(#fff,#f5f8fa); font-weight: 600;">Follow</button>
                        @endif
                    @endif
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
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
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Latest Wikis</h3>
                        </div>
                        @if($user->wikis->count() > 0)
                            <div class="list-group">
                                @foreach($user->wikis as $wiki)
                                    <a href="{{ $wiki->id }}" class="list-group-item">{{ $wiki->name }}</a>
                                @endforeach
                            </div>
                        @else 
                            <ul class="list-group">
                                <li class="list-group-item" style="box-shadow: inset 0 0 10px rgba(0,0,0,0.05); background-color: #ffffff; text-align: center;">Nothing found</li>
                            </ul>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
