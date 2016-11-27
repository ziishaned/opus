@extends('layouts.app')

@section('content')
    <div class="row text-center">
        <div class="center-block user-profile">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="user-profile-pic">
                    <img src="/images/default.png" class="img-rounded" width="90" height="90" alt="Image" style="border-radius: 50%; border: 1px solid rgba(0,0,0,0.1);">
                </div>
                <p style="margin-top: 8px; margin-bottom: 0px; font-size: 17px; text-transform: capitalize; font-weight: 600;" title="{{ $user->name }}">{{ $user->name  }}</p>
                <p style="margin-bottom: 2px;"><span class="dot-divider" title="{{ $user->name }}">{{ '@' . $user->name }}</span> <span style="cursor: default;" data-toggle="tooltip" data-placement="bottom" title="{{ $user->created_at->toFormattedDateString() . ' at ' . $user->created_at->format('h:i A')}}"><i class="fa fa-clock-o"></i> Member since {{  $user->created_at->toFormattedDateString() }}</span></p>
                <p style="margin-bottom: 0;" title="email"><i class="fa fa-envelope"></i> {{ $user->email  }}</p>
                @if($user->id != Auth::user()->id)
                    @if(ViewHelper::isFollowing($user->id)) 
                        <button id="unfollow-button" data-follow-id="{{ $user->id }}" class="btn btn-info btn-block following-button">Following</button>
                    @else 
                        <button id="follow-button" class="btn btn-default btn-block" data-follow-id="{{ $user->id }}" style="margin-top: 10px; background-color: #f5f8fa; background-image: linear-gradient(#fff,#f5f8fa); font-weight: 600;">Follow</button>
                    @endif
                @endif
                @if($user->organizations->count() > 0)
                    <ul class="list-unstyled list-inline" style="width: 260px; margin: auto; line-height: 3.5em;">
                        @foreach($user->organizations as $organization)
                            <li class="list-group-item" style="padding: 0px; border: none;" data-toggle="tooltip" data-placement="bottom" title="{{ $organization->name }}">
                                <a href="{{ route('organizations.show', $organization->slug)  }}">
                                    <img src="/images/no_organization_avatar.png" width="40" height="40" alt="Image" style="border: 1px solid rgba(0,0,0,0.1); border-radius: 3px;">
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
    @include('layouts.partials.user-nav')
    <div class="row" style="margin-top: 15px;">
        <div class="col-xs-offset-2 col-xs-8 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    @if($activities->count() > 0)
                        @foreach($activities as $activity)
                            <div class="create simple" style="padding: 0 0 1em 45px; border-top: 1px solid #f1f1f1;">
                                <div style="padding: 1em 0 0; overflow: hidden; font-size: 14px; border-bottom: 0;">
                                    <div class="simple">
                                        @if($activity->log_type == 'delete')
                                            <i class="fa fa-trash-o" style="color: #bbb;"></i>
                                        @elseif($activity->log_type == 'watch') 
                                            <i class="fa fa-eye" style="color: #bbb;"></i>
                                        @elseif($activity->log_type == 'commented')
                                            <i class="fa fa-commenting-o" style="color: #bbb;"></i>
                                        @elseif($activity->log_type == 'following') 
                                            <i class="fa fa-meh-o" style="color: #bbb;"></i>
                                        @elseif($activity->log_type == 'star') 
                                            <i class="fa fa-star-o" style="color: #bbb;"></i>
                                        @else
                                            <i class="fa fa-file-text-o" style="color: #bbb;"></i>
                                        @endif
                                        <div style="padding: 0; display: inline-block; font-size: 13px; font-weight: normal; color: #666;">
                                            <a style="color: #4078c0; text-decoration: none;" href="{{ route('users.show', [ViewHelper::getUserSlug($activity->user_id), ]) }}" title="{{ ViewHelper::getUsername($activity->user_id) }}">{{ ViewHelper::getUsername($activity->user_id) }}</a> 
                                            @if($activity->log_type == 'create') 
                                                created
                                            @elseif($activity->log_type == 'update') 
                                                updated a
                                            @elseif($activity->log_type == 'commented')
                                                commented on 
                                            @elseif($activity->log_type == 'delete')
                                                deleted
                                            @elseif($activity->log_type == 'star')
                                                starred
                                            @elseif($activity->log_type == 'watch')
                                                started watching
                                            @elseif($activity->log_type == 'following')
                                                following
                                            @endif
                                            {{ $activity->log_params['subject_type'] }} 
                                            @if($activity->log_params['subject_type'] == 'comment') 
                                                @if($activity->log_type == 'delete')
                                                    from 
                                                @else
                                                    on
                                                @endif
                                                page <a style="color: #4078c0; text-decoration: none;" href="@if($activity->log_params['subject_type'] == 'wiki') {{ route('wikis.show', [ViewHelper::getWikiSlug($activity->log_params['id']), ]) }} @else {{ route('wikis.pages.show', [ViewHelper::getWikiSlug($activity->log_params['wiki_id']), ViewHelper::getPageSlug($activity->log_params['id'])]) }} @endif" title="{{ $activity->log_params['name'] }}">{{ $activity->log_params['name'] }}</a>
                                            @else 
                                                <a style="color: #4078c0; text-decoration: none;" href="@if($activity->log_params['subject_type'] == 'wiki') {{ route('wikis.show', [ViewHelper::getWikiSlug($activity->log_params['id']), ]) }} @else {{ route('wikis.pages.show', [ViewHelper::getWikiSlug($activity->log_params['wiki_id']), ViewHelper::getPageSlug($activity->log_params['id'])]) }} @endif" title="{{ $activity->log_params['name'] }}">{{ $activity->log_params['name'] }}</a>
                                            @endif
                                            @if($activity->log_params['subject_type'] == 'page' || $activity->log_params['subject_type'] == 'comment') 
                                                at wiki 
                                                <a style="color: #4078c0; text-decoration: none;" href="{{ route('wikis.show', [ViewHelper::getWikiSlug($activity->log_params['wiki_id']), ]) }}" title="{{ ViewHelper::getWikiName($activity->log_params['wiki_id']) }}">{{ ViewHelper::getWikiName($activity->log_params['wiki_id']) }}</a>
                                            @endif
                                        </div>
                                        <div class="time" style="display: inline-block; font-size: 12px; color: #bbb; cursor: default;">
                                            <i class="fa fa-clock-o"></i> <span data-toggle="tooltip" data-placement="bottom" title="{{ $activity->created_at->toFormattedDateString() . ' at ' . $activity->created_at->format('h:i A')}}"><time class="timeago" datetime="{{ $activity->created_at }}">{{ $activity->created_at->diffForHumans() }}</time></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="row text-center" style="margin-top: 15px;">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                {{ $activities->links() }}
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h3 style="font-size: 17px; font-weight: 600; color: #777777; text-align: center; padding: 5px 0px 15px 0px; margin: 0; margin-top: 0px;"><i class="fa fa-search"></i> Nothing found...</h3>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
