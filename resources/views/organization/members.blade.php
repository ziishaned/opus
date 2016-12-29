@extends('layouts.app')

@section('content')
    <div class="subnav" style="background-color: #f8f8f8; border-bottom: 1px solid #E0E0E0;">
        <div class="container">
            <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                <li class="active">
                    <a href="#">All Members</a>            
                </li>
                <li>
                    <a href="#">Top Contributors</a>        
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div style="margin-bottom: 10px; margin-top: 10px; height: 50px;" class="hidden-xs">
            <div class="site-breadcrumb">
                <ul class="list-unstyled list-inline" style="margin-bottom: 0px;">
                    <li>
                        <a href="#">Facebook</a>
                    </li>
                    <li class="active">
                        <a href="#">Members</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                <div class="total-members" style="font-size: 17px; font-weight: 400; position: relative; top: 5px;">
                    Users with access to <strong>{{ $organization->name  }}</strong> <span class="count" style="border-radius: 3px; padding: 0px 8px; color: #fff; background: #555;">{{ $organization->members->count()  }}</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 text-right">
                <form class="members-filter-form" method="get">
                    <div class="form-group" style="margin-bottom: 0px;">
                        <input type="text" class="form-control" placeholder="Filter by name" style="border-radius: 2px; padding-right: 30px;">
                        <span class="fa fa-search fa-fw" style="position: absolute; top: 10px; right: 23px; color: #e7e9ed;"></span>
                    </div>
                </form>
            </div>
        </div>
        <div class="row" style="margin-top: 25px;">
            @if($organizationMembers->count() > 0)
                @foreach($organizationMembers as $member)
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="member-con" style="margin-bottom: 18px; border: 1px solid #E0E0E0; padding: 18px 29px; border-radius: 4px; box-shadow: 0px 0px 3px rgba(204, 204, 204, 0.35)">
                            <div class="member-image pull-left">
                                @if(empty($member->profile_image))
                                    <img src="/images/default.png" width="54" height="54" alt="Image" style="border-radius: 50%; border: 1px solid #fafafa;">
                                @else
                                    <img src="/images/profile-pics/{{ $member->profile_image }}" width="54" height="54" alt="Image" style="border-radius: 50%; border: 1px solid #fafafa;">
                                @endif
                            </div>
                            <div class="member-info pull-left" style="margin-left: 18px; margin-top: 2px;">
                                <h4 style="margin-top: 5px; margin-bottom: 5px; font-size: 14px;">
                                    {{ $member->first_name .' '. $member->last_name }} 
                                    @if($member->user_role == 'admin')
                                        <span class="label label-primary" style="padding: 2px 8px; -webkit-text-stroke: 0px; position: relative; top: -2px; left: 8px;">Owner</span>
                                    @else
                                        <span class="label label-primary" style="padding: 2px 8px; -webkit-text-stroke: 0px; position: relative; top: -2px; left: 8px;">Member</span>
                                    @endif
                                </h4>
                                <a href="mailto:{{ $member->email  }}">{{ $member->email  }}</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h3 style="font-size: 17px; font-weight: 600; color: #777777; text-align: center; padding: 15px 0px 15px 0px; margin: 0; margin-top: 5px;">Nothing found</h3>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                {{ $organizationMembers->links() }}
            </div>
        </div>
    </div>
@endsection
