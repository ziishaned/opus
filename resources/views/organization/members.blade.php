@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div role="tabpanel">
                <ul class="nav nav-tabs nav-tabs-center" role="tablist">
                    <li class="active">
                        <a href="{{ route('organizations.members', [$organization->slug, ]) }}">Members list</a> 
                    </li>
                    <li>
                        <a href="{{ route('invite.users', [$organization->slug, ]) }}">Invite user</a>
                    </li>
                </ul>
                <div class="tab-content tab-bordered">
                    <div class="row mb20">
                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                            <p>
                                Users with access to <strong>{{ $organization->name  }}</strong> <span class="label label-default">{{ $organization->members->count()  }}</span>
                            </p>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 text-right">
                            <form class="members-filter-form" method="get">
                                <div class="form-group mb0">
                                    <input type="text" class="form-control input input-sm" placeholder="Filter by name">
                                    <span class="fa fa-search fa-fw text-muted" style="position: absolute; top: 8px; right: 23px;"></span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            @if($organizationMembers->count() > 0)
                                <ul class="list-unstyled list-inline mb0">
                                    @foreach($organizationMembers as $member)
                                        <li>
                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    @if(empty($member->profile_image))
                                                        <img src="/images/default.png" width="64" height="64" alt="Image" class="media-object img-rounded">
                                                    @else
                                                        <img src="/images/profile-pics/{{ $member->profile_image }}" width="64" height="64" alt="Image" class="media-object img-rounded">
                                                    @endif
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading mb10">
                                                        {{ $member->first_name .' '. $member->last_name }} 
                                                        @if($member->user_role == 'admin')
                                                            <span class="label label-primary" style="padding: 2px 8px; -webkit-text-stroke: 0px; position: relative; top: -2px; left: 8px;">Owner</span>
                                                        @else
                                                            <span class="label label-primary" style="padding: 2px 8px; -webkit-text-stroke: 0px; position: relative; top: -2px; left: 8px;">Member</span>
                                                        @endif
                                                    </h4>
                                                    <p class="marginless">
                                                        <a href="mailto:{{ $member->email  }}"><i class="fa fa-envelope-o fa-fw"></i> {{ $member->email  }}</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                                        {{ $organizationMembers->links() }}
                                    </div>
                                </div>
                            @else
                                <p class="text-center" style="position: absolute; top: 50%; left: 50%; margin-left: -120px; margin-top: 50px;">No members yet. You can <a href="{{ route('invite.users', [$organization->slug, ]) }}">invite one here</a>.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
