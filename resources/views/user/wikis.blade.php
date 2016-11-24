@extends('layouts.app')

@section('content')
    <div class="row text-center">
        <div class="center-block">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="user-profile-pic">
                    <img src="/images/default.png" class="img-rounded" width="90" height="90" alt="Image" style="border-radius: 50%; border: 1px solid rgba(0,0,0,0.1);">
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
        </div>
    </div>
    @include('layouts.partials.user-nav')
    <div class="row" style="margin-top: 12px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row" style="display: flex; align-items: center;">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <h3 style="margin: 0; font-size: 17px;">All Wikis</h3>
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
                    @if($userWikis->count() > 0)
                        @foreach($userWikis as $wiki)
                            <div class="row">
                                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                    <h3 style="margin: 0 0 5px; font-size: 15px; font-weight: 600; color: #4078c0;"><a href="{{ route('wikis.show', $wiki->slug)  }}">{{ $wiki->name }}</a></h3>
                                    <p style="font-size: 15px; color: #767676">{{ $wiki->outline }}</p>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                                    <div class="stats" style="padding-top: 8px;">
                            <span style="color: #767676">
                                <i class="fa fa-heart"></i> {{ ViewHelper::getWikiStar($wiki->id) }}
                            </span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @else
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h3 style="font-size: 17px; font-weight: 600; color: #777777; text-align: center; padding: 15px 0px 15px 0px; margin: 0; margin-top: 5px;"><i class="fa fa-search"></i> Nothing found...</h3>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    {{ $userWikis->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
