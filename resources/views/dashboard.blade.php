@extends('layouts.app')

@section('content')
<h1 class="text-center" style="margin-top: 50px; margin-bottom: 20px;">{{ $organization->name }}</h1>
<div class="row wikis-categories-con">
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Backend</h3>
                <ul class="list-unstyled wiki-category">
                    <li>
                        <a href="#">A - Laravel</a>
                    </li>
                    <li>                        
                        <a href="#">B - Laravel Dev</a>
                    </li>
                    <li>
                        <a href="#">C - Laravel Pro</a>
                    </li>
                </ul>
            </div>
        </div>    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Backend</h3>
                <ul class="list-unstyled wiki-category">
                    <li>
                        <a href="#">A - Laravel</a>
                    </li>
                    <li>                        
                        <a href="#">B - Laravel Dev</a>
                    </li>
                    <li>
                        <a href="#">C - Laravel Pro</a>
                    </li>
                </ul>
            </div>
        </div>    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Backend</h3>
                <ul class="list-unstyled wiki-category">
                    <li>
                        <a href="#">A - Laravel</a>
                    </li>
                    <li>                        
                        <a href="#">B - Laravel Dev</a>
                    </li>
                    <li>
                        <a href="#">C - Laravel Pro</a>
                    </li>
                </ul>
            </div>
        </div>    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Backend</h3>
                <ul class="list-unstyled wiki-category">
                    <li>
                        <a href="#">A - Laravel</a>
                    </li>
                    <li>                        
                        <a href="#">B - Laravel Dev</a>
                    </li>
                    <li>
                        <a href="#">C - Laravel Pro</a>
                    </li>
                </ul>
            </div>
        </div>    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Backend</h3>
                <ul class="list-unstyled wiki-category">
                    <li>
                        <a href="#">A - Laravel</a>
                    </li>
                    <li>                        
                        <a href="#">B - Laravel Dev</a>
                    </li>
                    <li>
                        <a href="#">C - Laravel Pro</a>
                    </li>
                </ul>
            </div>
        </div>    
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Backend</h3>
                <ul class="list-unstyled wiki-category">
                    <li>
                        <a href="#">A - Laravel</a>
                    </li>
                    <li>                        
                        <a href="#">B - Laravel Dev</a>
                    </li>
                    <li>
                        <a href="#">C - Laravel Pro</a>
                    </li>
                </ul>
            </div>
        </div>    
    </div>
</div>
{{-- <div class="row">
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <div class="panel panel-default" id="wiki-list-con">
            <div class="panel-heading" style="background-color: #ffffff; padding-top: 0;">
                <div class="row" style="border-bottom: 1px solid #d8d8d8; padding-top: 8px; color: #333; background-color: #f5f5f5; border-color: #ddd;">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h3 class="panel-title" style="margin-bottom: 10px;">Wiki spaces</h3>
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
            @if(count($wikis) > 0)
                <ul class="list-group list wiki-list">
                    @foreach($wikis as $wiki)
                        <li class="list-group-item">
                            <a href="{{ route('wikis.show', [$organization->slug, $wiki->slug]) }}" class="name">{{ $wiki->name }}</a>
                        </li>
                    @endforeach
                </ul>
            @else 
                <ul class="list-group">
                    <li class="list-group-item" style="text-align: center; border: none;">Nothing found</li>
                </ul>
            @endif
        </div>
    </div>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <div class="row section-left">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('layouts.partials.activity')
            </div>
        </div>
    </div>
</div> --}}
@endsection
