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
                            <h3>All Wikis</h3>
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
                            @if($organizationWikis->count() > 0)
                                @foreach($organizationWikis as $wiki)
                                    <div class="row">
                                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <h4 style="margin: 0 0 5px;"><a href="#">{{ $wiki->name }}</a></h4>
                                            <p style="font-size: 13px; color: #767676 margin-bottom: 0px;">{{ $wiki->outline }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                                        {{ $organizationWikis->links() }}
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <h3 class="nothing-found">Nothing found...</h3>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
