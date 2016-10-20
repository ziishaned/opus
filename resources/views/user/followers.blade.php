@extends('layouts.app')

@section('content')
    @include('layouts.partials.user-nav')
    <div class="row" style="margin-top: 20px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <h3 style="margin: 0;">Followers</h3>
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
                @if($user->followers->count() > 0)
                    @foreach($user->followers as $follower)
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" id="member-list-item">
                            <div class="row">
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <a href="http://wiki.dev/users/{{ $follower->id  }}"><img src="/images/default.png" style="width: 70px;" alt="Image"></a>
                                </div>
                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding-left: 0px;">
                                    <h4 style="margin: 0px 0px 5px;"><a href="http://wiki.dev/users/{{ $follower->id  }}">{{ $follower->name  }}</a></h4>
                                    <p class="text-muted"><a href="http://wiki.dev/users/{{ $follower->id  }}">{{ $follower->email  }}</a></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10" id="member-list-item">
                        <div class="jumbotron" style="border: 1px solid #e5e5e5; border-radius: 3px; box-shadow: inset 0 0 10px rgba(0,0,0,0.05); background-color: #fafafa;">
                            <h3 class="text-center" style="margin: 5px;"><i class="fa fa-info-circle"></i> {{ $user->name }} doesn't have any followers yet.</h3>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
