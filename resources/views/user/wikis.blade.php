@extends('layouts.app')

@section('content')
    <div class="row">
        @include('layouts.partials.user-nav')
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            @include('layouts.partials.profile')
            <hr>
            @if($userWikis->count() > 0)
                <div class="row" style="display: flex; align-items: center;">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <h3 style="margin: 0;">All Wikis</h3>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        <form class="project-filter-form" id="project-filter-form" action="/lundskommun" accept-charset="UTF-8" method="get">
                            <div class="row">
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 pull-right">
                                    <input type="search" name="filter_wikis" id="filter_wikis" placeholder="Filter by name" class="wikis-list-filter form-control" style="padding-right: 30px; border-radius: 2px;">
                                    <span class="fa fa-search fa-fw" style="position: absolute; top: 8px; right: 23px; color: #e7e9ed;"></span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        @foreach($userWikis as $wiki)
                            <div class="row">
                                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                    <h3 style="margin: 0 0 5px; font-size: 15px; font-weight: 600; color: #4078c0;"><a href="{{ route('wikis.show', $wiki->slug)  }}">{{ $wiki->name }}</a></h3>
                                    <p style="font-size: 13px; color: #767676 margin-bottom: 0px;">{{ $wiki->outline }}</p>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        {{ $userWikis->links() }}
                    </div>
                </div>
            @else
                <h3 class="nothing-found">Nothing found...</h3>
            @endif
        </div>
    </div>
@endsection
