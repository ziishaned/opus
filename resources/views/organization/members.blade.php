@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div role="tabpanel">
                <ul class="nav nav-tabs nav-tabs-center" role="tablist">
                    <li class="active">
                        <a href="{{ route('organizations.members', [$organization->slug, ]) }}">Members <span class="label label-default">{{ $organization->members->count()  }}</span></a> 
                    </li>
                    <li>
                        <a href="{{ route('invite.users', [$organization->slug, ]) }}">Invite user</a>
                    </li>
                </ul>
                <div class="tab-content tab-bordered">
                    <div class="row mb20">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <h4>Members List</h4>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-right">
                            <form class="form-inline" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Filter by name..." style="width: 258px;">
                                </div>
                                <button type="submit" class="btn btn-default">Search</button>
                                <a href="#" class="btn btn-link">Clear</a>
                            </form>
                        </div>
                    </div>
                    @if($organizationMembers->count() > 0)
                        <div class="row">
                            @foreach($organizationMembers as $member)
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 organization-member-item">
                                    <div class="media">
                                        <a class="pull-left" href="#">
                                            @if(empty($member->profile_image))
                                                <img src="{!! new Avatar($member->first_name .' '. $member->last_name, 'square', 54) !!}" class="media-object img-rounded" alt="">
                                            @else
                                                <img src="/images/profile-pics/{{ $member->profile_image }}" width="64" height="64" alt="Image" class="media-object img-rounded">
                                            @endif
                                        </a>
                                        <div class="media-body member-info">
                                            <a href="#" class="media-heading" style="font-size: 18px; font-weight: 500;">
                                                {{ $member->first_name .' '. $member->last_name }}
                                            </a>
                                            <p class="marginless">
                                                <a href="mailto:{{ $member->email  }}">{{ $member->email  }}</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center" style="position: absolute; top: 50%; left: 50%; margin-left: -120px; margin-top: 50px;">No members yet. You can <a href="{{ route('invite.users', [$organization->slug, ]) }}">invite one here</a>.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
