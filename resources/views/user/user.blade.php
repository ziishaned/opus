@extends('layouts.app')

@section('content')
    @include('layouts.partials.user-nav')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
                            <h3 style="margin: 0; font-size: 19px;">Activity</h3>
                            <hr>
                            <ul class="list-unstyled">
                                @foreach($activities as $activity)
                                    <li>
                                        <div class="activity">
                                            <div class="row">
                                                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                    @if($activity->log_name == 'created_comment')
                                                        <i class="fa fa-comment-o"></i>
                                                    @endif
                                                    @if($activity->log_name == 'created_wiki_page' || $activity->log_name == 'created_wiki')
                                                        <i class="fa fa-file-text-o"></i>
                                                    @endif
                                                    @if($activity->log_name == 'created_organization')
                                                        <i class="fa fa-university"></i>
                                                    @endif
                                                    {!! $activity->description !!}
                                                </div>
                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                                                    <p><i class="fa fa-clock-o"></i> <time class="timeago" datetime="{{ $activity->created_at }}">{{ $activity->created_at }}</time></p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            {{ $activities->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
