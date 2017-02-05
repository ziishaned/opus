@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div data-spy="affix" data-offset-top="10">
                        <div>
                            <ul class="nav nav-pills nav-stacked">
                                <li class="nav-header"><i class="fa fa-link fa-fw"></i> Quick Links</li>
                                <li>
                                    <a href="#"><span class="glyphicon glyphicon-book"></span> <span class="ml15">All wikis</span></a>
                                </li>
                            </ul>
                            <ul class="nav nav-pills nav-stacked">
                                <li class="nav-header"><i class="fa fa-tags fa-fw"></i> Categories</li>
                                @foreach($categories as $category)
                                    <li>
                                        <a href="#"><span class="category-icon" style="background-color: {{ ViewHelper::getRandomColor() }}"></span> <span class="ml15">{{ $category->name }}</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="index-head affix-top" data-spy="affix" data-offset-top="10" style="background-color: rgb(255, 255, 255); z-index: 10;">
                                <h4 class="marginless"><i class="fa fa-feed fa-fw"></i> All updates</h4>
                            </div>
                            {{-- <h4 class="marginless"><span class="glyphicon glyphicon-book"></span> <span class="ml10">All Wikis</span></h4> --}}
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-right">
                            <form class="form-inline" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control input-sm" placeholder="Filter by name..." style="width: 258px;">
                                </div>
                                <button type="submit" class="btn btn-default btn-sm">Search</button>
                                <a href="#" class="btn btn-link">Clear</a>
                            </form>
                        </div>
                    </div>
                    {{-- <hr> --}}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <ul class="list-unstyled list-bordered">
                                @foreach($wikis as $wiki)
                                    <li>
                                        <div class="media">
                                            <a class="pull-left" href="#">
                                                <img src="{!! new Avatar($wiki->name, 'square', 38) !!}" class="media-object img-rounded" alt="">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">{{ $wiki->name }}</h4>
                                                <p>{{ $wiki->outline }}</p>
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
    </section>
@endsection
