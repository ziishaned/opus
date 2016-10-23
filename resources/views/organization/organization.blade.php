@extends('layouts.app')

@section('content')
    @include('layouts.partials.organization-nav')
    <div class="row" style="margin-top: 20px;">
        @if(ViewHelper::userHasOrganization($organization->slug))
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                <div class="user-profile-pic">
                    <img src="/images/default.png" class="img-responsive img-rounded" alt="Image">
                </div>
                <p style="margin-top: 5px; margin-bottom: 0; font-size: 24px; text-transform: capitalize;">{{ $organization->name }}</p>
                <p style="margin-top: 5px;"><i class="fa fa-clock-o"></i> Joined on Oct 9, 2016</p>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <h3 style="margin: 0;">Activity</h3>
                    </div>
                </div>
                <hr style="margin-top: 12px;">
                <div class="row" style="margin-top: 20px;">
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                        <img src="/images/default.png" style="width: 100px;" class="img-responsive" alt="Image">
                    </div>
                    <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11" style="padding-left: 0px;">
                        <h4 style="margin: 0px;"><a href="#">John Doe</a></h4>
                        <div class="activity">
                            <p style="margin-top: 5px; margin-bottom: 0;"><i class="fa fa-file-text-o"></i> <a href="#">What is our motive.</a></p>
                            <p style="padding-left: 17px; margin-bottom: 0;">Updated 3 hours ago</p>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                        <img src="/images/default.png" style="width: 100px;" class="img-responsive" alt="Image">
                    </div>
                    <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11" style="padding-left: 0px;">
                        <h4 style="margin: 0px;"><a href="#">John Doe</a></h4>
                        <div class="activity">
                            <p style="margin-top: 5px; margin-bottom: 0;"><i class="fa fa-file-image-o"></i> <a href="#">Screenshot-08-10-201.png</a></p>
                            <p style="padding-left: 17px; margin-bottom: 0;">Attached today at 3:45 PM</p>
                        </div>
                        <div class="activity">
                            <p style="margin-top: 5px; margin-bottom: 0;"><i class="fa fa-file-image-o"></i> <a href="#">Screenshot-08-10-201.png</a></p>
                            <p style="padding-left: 17px;">Attached today at 3:45 PM</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Latest Wikis</h3>
                    </div>
                    @if($organization->wikis->count() > 0)
                        <div class="list-group">
                            @foreach($organization->wikis as $wiki)
                                <a href="{{ $wiki->id }}" class="list-group-item">{{ $wiki->name }}</a>
                            @endforeach
                        </div>
                    @else 
                        <ul class="list-group">
                            <li class="list-group-item" style="box-shadow: inset 0 0 10px rgba(0,0,0,0.05); background-color: #ffffff; text-align: center;">Nothing found</li>
                        </ul>
                    @endif
                    </div>
                </div>
            </div>
        @else
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                <div class="user-profile-pic">
                    <img src="/images/default.png" class="img-responsive img-rounded" alt="Image">
                </div>
                <p style="margin-top: 5px; margin-bottom: 0; font-size: 24px; text-transform: capitalize;">{{ $organization->name }}</p>
                <p style="margin-top: 5px;"><i class="fa fa-clock-o"></i> Joined on Oct 9, 2016</p>
            </div>
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                <div class="jumbotron" style="border: 1px solid #e5e5e5; border-radius: 3px; box-shadow: inset 0 0 10px rgba(0,0,0,0.05); background-color: #fafafa;">
                    <h3 class="text-center" style="margin: 5px;"><i class="fa fa-lock fa-lg"></i> You are not member of this organization.</h3>
                </div>
            </div>
        @endif
    </div>
@endsection
