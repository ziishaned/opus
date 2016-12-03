@extends('layouts.app')

@section('content')
    @include('layouts.partials.profile')
    @include('layouts.partials.user-nav')
    <div class="row" style="margin-top: 13px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                    
            @if($userFollowing->count() > 0)
                <div class="row" style="display: flex; align-items: center;">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <h3 style="margin: 0;">All Following</h3>
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
                        <ul class="list-unstyled following-list">
                            @foreach($userFollowing as $following)
                                <li style="padding-bottom: 13px; border-color: #f0f0f0; font-size: 15px; color: #5c5c5c;">
                                    <div class="row">
                                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                            <div class="row">
                                                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                                    <a href="{{ route('users.show', [$following->id, ]) }}">
                                                        @if(empty($following->profile_image))
                                                            <img src="/images/default.png" class="img-rounded" width="70" height="70" alt="Image" style="border: 1px solid rgba(0,0,0,0.1);">
                                                        @else
                                                            <img src="/images/profile-pics/{{ $following->profile_image }}" class="img-rounded" width="70" height="70" alt="Image" style="border: 1px solid rgba(0,0,0,0.1);">
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                                                    <p style="margin: 0;"><a href="http://wiki.dev/users/admin">{{ $following->full_name }}</a></p>
                                                    <p class="text-muted" style="margin: 0;">{{ $following->bio }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">
                                            <p style="margin-top: 18px;">
                                                <a href="#" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('unfollow-form').submit();">Unfollow</a>
                                                <form id="unfollow-form" action="{{ route('users.unfollow') }}" method="POST" class="hide">
                                                    {!! method_field('post') !!}
                                                    {{ csrf_field() }}
                                                    <input type="text" name="user_id" class="hide" value="{{ $following->id }}">
                                                </form>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        {{ $userFollowing->links() }}        
                    </div>
                </div>
            @else
                <h3 style="font-size: 15px; font-weight: 400; color: #777777; text-align: center; padding: 15px 0px 15px 0px; margin: 0;">Nothing found...</h3>
            @endif
        </div>
    </div>
@endsection
