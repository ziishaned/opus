@extends('layouts.app')

@section('content')
    <div class="row text-center">
        <div class="center-block">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="user-profile-pic">
                    <img src="/images/no_organization_avatar.png" class="img-rounded" width="90" height="90" alt="Image" style="border-radius: 50%; border: 1px solid rgba(0,0,0,0.1);">
                </div>
                <p style="margin-top: 5px; margin-bottom: 0; font-size: 24px; font-weight: 600;">{{'@' . $organization->name }}</p>
                <p style="margin-top: 5px;"><i class="fa fa-clock-o"></i> Joined on {{ $organization->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString()  }}</p>
            </div>
        </div>
    </div>
    @include('layouts.partials.organization-nav')
    <div class="row" style="margin-top: 13px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <h3 style="margin: 0; margin-top: 6px; font-size: 17px;">Existing users</h3>
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
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                <img src="/images/default.png" width="40" height="40" class="img-responsive" alt="Image" style="margin-right: 15px; border-radius: 50%; border: 1px solid rgba(0,0,0,0.1); float: left;">
                                                <p style="margin: 0;"><a href="{{ route('users.show', $member->slug) }}">{{ '@' . $member->name  }}</a></p>
                                                <p class="text-muted" style="margin: 0;">Joined about <stron>{{ (new Carbon\Carbon)->toFormattedDateString($member->joined_date) }}</stron></p>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
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
@endsection
