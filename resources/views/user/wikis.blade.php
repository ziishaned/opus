@extends('layouts.app')

@section('content')
    @include('layouts.partials.user-nav')
    <div class="row" style="margin-top: 20px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <h3 style="margin: 0;">Wikis</h3>
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
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <form action="" method="POST" class="form-inline" role="form">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="" id="" placeholder="Filter by name">
                                </div>
                                <button type="submit" class="btn btn-default">Search</button>
                            </form>
                            <hr style="margin-bottom: 0px;">
                            <div class="wikis-con" style="margin-top: 20px;">
                                @if($user->wikis->count() > 0)
                                    <div class="list-group">
                                        @foreach($user->wikis as $wiki)
                                            <a href="#" class="list-group-item">
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                        <p style="margin: 0; font-weight: 500;">{{ $wiki->name }}</p>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                                                        <ul class="list-unstyled list-inline" style="margin: 0;">
                                                            <li><i class="fa fa-user"></i> Created by <strong>{{ \App\Helpers\ViewHelper::getUsername($wiki->user_id) }}</strong></li>
                                                            <li><i class="fa fa-clock-o"></i> {{  $wiki->created_at->toFormattedDateString() }}</li>
                                                        </ul>    
                                                    </div>
                                                </div>
                                            </a>
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
    </div>
@endsection
