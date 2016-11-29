@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <h3 style="margin: 0px 0px 8px;font-size: 17px;">Activity</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('layouts.partials.activity')
            </div>
        </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <div class="panel panel-default" id="test-list">
            <div class="panel-heading">
                <div class="row" style="border-bottom: 1px solid #d8d8d8;">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h3 class="panel-title" style="font-size: 15px; margin-bottom: 10px;">Personal Wikis</h3>    
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group" style="margin-bottom: 0px; margin-top: 10px;">
                            <input class="form-control input-sm fuzzy-search" id="searchinput" type="search" placeholder="Find a wiki..." />
                            <span class="fa fa-search" style="position: absolute; top: 17px; right: 23px; color: #e7e9ed;"></span>
                        </div>
                    </div>
                </div>
            </div>
            @if($wikis->count() > 0)
                <ul class="list-group list">
                    @foreach($wikis as $wiki)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                    <a href="{{ route('wikis.show', $wiki->slug) }}" class="name">{{ $wiki->name }}</a>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                                    <span style="color: #888;"><i class="fa fa-star"></i> {{ ViewHelper::getWikiStar($wiki->id) }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else 
                <li class="list-group-item" style="text-align: center;">Nothing found</li>
            @endif
        </div>
    </div>
</div>
@endsection
