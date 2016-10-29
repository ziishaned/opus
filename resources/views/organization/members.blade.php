@extends('layouts.app')

@section('content')
    @include('layouts.partials.organization-nav')
    <div class="row" style="margin-top: 20px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <h3 style="margin: 0; font-size: 19px;">Existing users</h3>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <form class="project-filter-form" id="project-filter-form" action="/lundskommun" accept-charset="UTF-8" method="get">
                        <div class="row">
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 pull-right">
                                <input type="search" name="filter_wikis" id="filter_wikis" placeholder="Find existing members by name" class="wikis-list-filter form-control">
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
                            Users with access to <strong>{{ $organization->name  }}</strong> <span class="badge">{{ $organization->members->count()  }}</span>
                        </div>
                        <ul class="list-unstyled">
                            @foreach($organization->members as $member)
                                <li style="padding: 10px 16px; border-color: #f0f0f0; font-size: 15px; color: #5c5c5c;">
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            <img src="/images/default.png" width="40" height="40" class="img-responsive" alt="Image" style="margin-right: 15px; border-radius: 50%; border: 1px solid rgba(0,0,0,0.1); float: left;">
                                            <p style="margin: 0;"><a href="{{ route('users.show', $member->slug) }}">{{ '@' . $member->name  }}</a></p>
                                            <p class="text-muted" style="margin: 0;">Joined about <stron>TODO</stron></p>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                                            <p style="margin-right: 20px;">Owner <stron>TODO</stron></p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
