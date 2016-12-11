@extends('layouts.app')

@section('content')
    <div class="row">
        @include('layouts.partials.organization-nav')
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="user-profile-pic">
                        <img src="/images/no_organization_avatar.png" class="pull-left" width="95" height="95" alt="Image" style="border-radius: 4px;">
                    </div>
                    <div class="pull-left" style="margin-left: 15px;">
                        <h3 style="text-transform: capitalize;" title="{{ $organization->name }}">{{ $organization->name }}</h3>
                        <p style="margin-top: 5px;"><i class="fa fa-clock-o"></i> Joined on {{ $organization->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString()  }}</p>
                    </div>        
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row" style="display: flex; align-items: center;">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <h3>Existing users</h3>
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                            <form class="project-filter-form" id="project-filter-form" action="/lundskommun" accept-charset="UTF-8" method="get">
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 pull-right">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Filter by name" style="border-radius: 2px; padding-right: 30px;">
                                            <span class="fa fa-search fa-fw" style="position: absolute; top: 10px; right: 23px; color: #e7e9ed;"></span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="font-size: 15px; padding: 6px 16px; line-height: 36px; color: #5c5c5c; background-color: #fafafa; border-color: #e5e5e5;">
                                    <div class="row">
                                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                            Users with access to <strong>{{ $organization->name  }}</strong> <span class="count" style="border-radius: 3px; padding: 0px 8px; color: #fff; background: #555;">{{ $organization->members->count()  }}</span>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">
                                            <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="border: none; background: none;">Role <i class="fa fa-caret-down"></i></a>
                                            <ul class="dropdown-menu" style="left: 25px; top: 40px;">
                                                <li><a href="#"><i class="fa fa-check"></i> Everyone</a></li>
                                                <li><a href="#">Owners</a></li>
                                                <li><a href="#">Members</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @if($organizationMembers->count() > 0)
                                    <ul class="list-unstyled">
                                        @foreach($organizationMembers as $member)
                                            <li style="padding: 10px 16px; border-color: #f0f0f0; font-size: 15px; color: #5c5c5c;">
                                                <div class="row">
                                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                        <div class="pull-left">
                                                            @if(empty($member->profile_image))
                                                                <img src="/images/default.png" width="70" height="70" alt="Image" style="border-radius: 3px;">
                                                            @else
                                                                <img src="/images/profile-pics/{{ $member->profile_image }}" width="70" height="70" alt="Image" style="border-radius: 3px;">
                                                            @endif
                                                        </div>
                                                        <div class="pull-left" style="margin-left: 15px;">
                                                            @if(!empty($member->full_name))
                                                                <h3 style="text-transform: capitalize;" title="{{ $member->full_name }}">{{ $member->full_name }}</h3>
                                                            @endif
                                                            <p>
                                                                <span class="@if(!empty($member->location)) dot-divider @endif">
                                                                    <i class="fa fa-envelope"></i> <a href="mailto:{{ $member->email  }}">{{ $member->email  }}</a>
                                                                </span> 
                                                                @if(!empty($member->location))
                                                                    <span><i class="fa fa-map-marker"></i> {{ $member->location }}</span>
                                                                @endif
                                                            </p>
                                                            @if(!empty($member->bio))
                                                                <p>{{ $member->bio }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                                                        <p style="margin-right: 20px;">
                                                            @if($member->user_role == 'admin')
                                                                Owner
                                                            @else
                                                                Member
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <h3 style="font-size: 17px; font-weight: 600; color: #777777; text-align: center; padding: 15px 0px 15px 0px; margin: 0; margin-top: 5px;">Nothing found</h3>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                            {{ $organizationMembers->links() }}
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
