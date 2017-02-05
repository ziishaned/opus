@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div data-spy="affix" data-offset-top="10">
                        <div class="tabs-vertical" style="margin-bottom: 30px;">
                            <div class="index-head">
                                <h4 class=""><i class="fa fa-link fa-fw"></i> Quick links</h4>
                            </div>
                            <div class="index-body">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#"><i class="fa fa-feed fa-fw"></i> <span class="ml15">All updates</span></a>
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
                            </div>
                        </div>
                        <div class="tabs-vertical">
                            <div class="index-head">
                                <h4 class=""><i class="fa fa-star-o fa-fw"></i> Favourite wikis</h4>
                            </div>
                            <div class="index-body">
                                <p class="text-muted text-center">Fovourite list is empty...</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <div style="min-height: 38px;">
                        <div class="index-head" data-spy="affix" data-offset-top="10" style="background-color: #ffffff; z-index: 10; width: 457.5px;">
                            <h4 class=""><i class="fa fa-feed fa-fw"></i> All updates</h4>
                        </div>
                    </div>
                    <div class="index-body">
                        @include('layouts.partials.activity')
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div data-spy="affix" data-offset-top="10">
                        <div class="tabs-vertical" style="margin-bottom: 30px;">
                            <div class="index-head">
                                <h4 class=""><i class="fa fa-clock-o fa-fw"></i> Recent wikis</h4>
                            </div>
                            <div class="index-body">
                                @if($wikis->count() > 0) 
                                    @foreach($wikis as $wiki)
                                        <ul class="list-unstyled marginless">
                                            <li>
                                                <a href="#">
                                                    <div class="media" style="display: flex; align-items: center;">
                                                        <div class="pull-left">
                                                            <img src="{!! new Avatar($wiki->name, 'square', 38) !!}" class="media-object img-rounded" alt="">
                                                        </div>
                                                        <div class="media-body">
                                                            <p class="index-wikis-item ml10 mb0">{{ $wiki->name }}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    @endforeach
                                @else
                                    <p class="text-muted text-center">This organization does not have any recent wikis...</p>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="tabs-vertical">
                            <div class="index-head">
                                <h4 class=""><i class="fa fa-eye fa-fw"></i> Read list</h4>
                            </div>
                            <div class="index-body">
                                <p class="text-muted text-center">Your read list is epmty...</p>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
