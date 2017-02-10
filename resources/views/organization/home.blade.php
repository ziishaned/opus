@extends('layouts.app')

@section('content')
    <div class="page-side-navbar-con" class="hidden-sm hidden-xs">
        <nav class="navbar navbar-default page-side-navbar navbar-fixed-side">
            <div class="container">
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="menu-header">
                            <i class="fa fa-link fa-fw"></i> Quick links
                        </li>
                        <li>
                            <a href="#" class="active"><i class="fa fa-feed fa-fw"></i> <span class="ml15">All updates</span></a>
                        </li>
                        <li>
                            <a href="#"><span class="glyphicon glyphicon-user"></span> <span style="margin-left: 16px;">My activity</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-eye fa-fw"></i> <span class="ml10">Read list</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><span class="glyphicon glyphicon-book"></span> <span class="ml15">Create wiki</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-tag fa-fw"></i> <span class="ml10">Create category</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-handshake-o fa-fw"></i> <span class="ml10">Invite users</span></a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li class="menu-header">
                            <i class="fa fa-star-o fa-fw"></i> Favourite wikis
                        </li>
                        <li class="empty-list-text">
                            <p class="text-muted text-center">Fovourite list is empty...</p>
                        </li>
                </div>
            </div>
        </nav>
    </div>
    <div class="row no-container aside-content">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="news-feed">
                <div class="heading">
                    <h3><i class="fa fa-feed fa-fw icon"></i> All updates</h3>
                </div>
                <div class="index-body">
                    @include('layouts.partials.activity')
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div data-spy="affix" data-offset-top="10">
                {{-- <div class="recent-wikis">
                    <div class="heading">
                        <h3><i class="fa fa-clock-o fa-fw icon"></i> Recent wikis</h3>
                    </div>
                    <div class="recent-wikis-list">
                        @if($wikis->count() > 0) 
                            @foreach($wikis as $wiki)
                                <ul class="list-unstyled marginless">
                                    <li>
                                        <a href="#">
                                            <div class="media" style="display: flex; align-items: center;">
                                                <div class="pull-left">
                                                    <img src="{!! new Avatar($wiki->name, 'circle', 33) !!}" class="media-object img-rounded" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <p class="index-wikis-item mb0">{{ $wiki->name }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            @endforeach
                        @else
                            <p class="text-muted text-left">No recent wikis...</p>
                        @endif
                    </div>
                </div>
                <div class="readlist">
                    <div class="heading">
                        <h3><i class="fa fa-eye fa-fw icon"></i> Read list</h3>
                    </div>
                    <div class="read-list">
                        <p class="text-muted text-left">Your read list is epmty...</p>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
