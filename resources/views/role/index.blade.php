@extends('layouts.master')

@section('content')
    <div class="team-setting">
        <div class="team-setting-header">
          Team Settings
        </div>
        <div role="tabpanel">
            @include('team.partials.tab-menu')
            <div class="tab-content">
                <div class="s-groups-con">
                    <div class="s-group-header">
                        <div class="header">
                            <div class="pull-left">
                                <h2 style="margin-bottom: 10px;">Roles</h2>
                                <p class="text-muted">You can edit the roles and set there permissions.</p>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('roles.create', [ $team->slug ]) }}" class="btn btn-link create-group-btn"><i class="fa fa-plus fa-fw"></i> Create Role</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="s-groups-body">
                        @foreach($roles as $role)
                            <div class="panel panel-default s-group-item">
                                <div class="panel-body">
                                    <div class="group-item-header">
                                        <div class="pull-left">
                                            <p class="group-name"><span class="name-inner">{{ $role->name }}</span> <span class="label label-default">{{ $role->members->count() }}</span></p> 
                                        </div>
                                        <div class="pull-right">
                                            <ul class="list-unstyled list-inline">
                                                <li>
                                                    <a href="{{ route('roles.edit', [$team->slug, $role->slug]) }}"><i class="fa fa-pencil fa-fw" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                                                </li>
                                                @if($role->slug !== 'admins') 
                                                    <li>
                                                        <a href="{{ route('roles.delete', [$team->slug, $role->slug]) }}" data-method="delete" data-confirm="Are you sure?"><i class="fa fa-trash-o fa-fw" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="group-members-con">
                                        <div class="row">
                                            @foreach($role->members as $member)
                                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 group-member-item">
                                                    <div class="media">
                                                        <a class="pull-left group-member-img" href="#">
                                                            @if($member->profile_image)
                                                                <img class="media-object" src="/img/avatars/{{ $member->profile_image }}" width="50" height="50" alt="Image" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ $member->first_name . ' ' . $member->last_name }}">
                                                            @else
                                                                <img class="media-object" src="/img/no-image.png" width="50" height="50" alt="Image" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ $member->first_name . ' ' . $member->last_name }}">
                                                            @endif
                                                        </a>
                                                        <div class="media-body">
                                                            <h4 class="media-heading group-member-name">{{ $member->first_name . ' ' . $member->last_name }}</h4>
                                                            <p class="grou-member-email">{{ $member->email }}</p>
                                                        </div>
                                                    </div>      
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection