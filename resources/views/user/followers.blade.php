@extends('layouts.app')

@section('content')
    <div class="row">
        @include('layouts.partials.user-nav')
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            @include('layouts.partials.profile')
            <hr>
            @if($userFollowers->count() > 0)
                <div class="row" style="display: flex; align-items: center;">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <h3 style="margin: 0;">All Followers</h3>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        <form class="project-filter-form" id="project-filter-form" action="/lundskommun" accept-charset="UTF-8" method="get">
                            <div class="row">
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 pull-right">
                                    <input type="search" name="filter_wikis" id="filter_wikis" placeholder="Filter by name" class="wikis-list-filter form-control">
                                    <span class="fa fa-search" style="position: absolute; top: 10px; right: 23px; color: #e7e9ed;"></span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="list-unstyled follower-list">
                            @foreach($userFollowers as $follower)
                                <li style="padding-bottom: 13px; border-color: #f0f0f0; font-size: 15px; color: #5c5c5c;">
                                    <div class="row">
                                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                            <div class="row">
                                                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                                    <a href="{{ route('users.show', [$follower->id, ]) }}">
                                                        @if(empty($follower->profile_image))
                                                            <img src="/images/default.png" class="img-rounded" width="70" height="70" alt="Image">
                                                        @else
                                                            <img src="/images/profile-pics/{{ $follower->profile_image }}" class="img-rounded" width="70" height="70" alt="Image">
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11" style="padding-left: 25px;">
                                                    <p style="margin: 0;"><a href="{{ route('users.show', [$follower->name, ]) }}">{{ $follower->full_name }}</a></p>
                                                    <p class="text-muted" style="margin: 0;">{{ $follower->bio }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @if(!ViewHelper::isFollowing($follower->id))
                                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">
                                                <p style="margin-top: 18px;">
                                                    <a href="#" class="btn btn-default" onclick="event.preventDefault(); document.getElementById('follow-form').submit();">Follow</a>
                                                    <form id="follow-form" action="{{ route('users.follow') }}" method="POST" class="hide">
                                                        {!! method_field('post') !!}
                                                        {{ csrf_field() }}
                                                        <input type="text" name="user_id" class="hide" value="{{ $follower->id }}">
                                                    </form>
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        {{ $userFollowers->links() }}        
                    </div>
                </div>
            @else
                <h3 class="nothing-found">Nothing found...</h3>
            @endif
        </div>
    </div>
@endsection
