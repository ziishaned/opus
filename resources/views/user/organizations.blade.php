@extends('layouts.app')

@section('content')
    @include('layouts.partials.profile')
    @include('layouts.partials.user-nav')
    <div class="row" style="margin-top: 20px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @if($userOrganizations->count() > 0)
                <div class="row" style="display: flex; align-items: center;">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <h3 style="margin: 0; font-size: 17px;">All Organizations</h3>
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
                        <div class="activity">
                            <ul class="list-group">
                                @foreach($userOrganizations as $organization)
                                    <li class="list-group-item" style="line-height: 39px; border-color: #eee;; margin-bottom: 0px; border-top: none; border-radius: 0; border-left: 0; border-right: 0;">
                                        <div class="row">
                                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                                <img src="/images/no_organization_avatar.png" width="40" height="40" class="img-responsive" alt="Image" style="    float: left; border-radius: 50%; border: 1px solid rgba(0,0,0,0.1); margin-right: 15px;">
                                                <a href="{{ route('organizations.show', $organization->slug)  }}" class="text-left" style="color: #4c4e54; font-weight: 600; font-size: 17px;">{{ $organization->name  }}</a>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
                                                <div class="stats">
                                                    <span>
                                                        <i class="fa fa-book"></i> {{ $organization->wikis->count()  }}
                                                    </span>
                                                    <span>
                                                        <i class="fa fa-users"></i> {{ $organization->members->count() }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @else 
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h3 style="font-size: 15px; font-weight: 400; color: #777777; text-align: center; padding: 15px 0px 15px 0px; margin: 0;">Nothing found...</h3>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    {{ $userOrganizations->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
