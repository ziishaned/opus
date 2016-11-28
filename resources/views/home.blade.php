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
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                        <h3 class="panel-title" style="font-size: 15px;">Personal Wikis</h3>
                    </div>
                </div>
            </div>
            <div class="list-group">
                @if($wikis->count() > 0)
                    @foreach($wikis as $wiki)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                    <a href="{{ route('wikis.show', $wiki->slug) }}">{{ $wiki->name }}</a>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                                    <span style="color: #888;">{{ ViewHelper::getWikiStar($wiki->id) }} <i class="fa fa-star"></i></span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else 
                    <li class="list-group-item" style="text-align: center;">Nothing found</li>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
