@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="nav nav-pills" id="organization-nav">
                <li class="active"><a href="#">Activity</a></li>
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">Discover <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa fa-pencil"></i> Recently worked on</a></li>
                        <li><a href="#"><i class="fa fa-floppy-o"></i> Saved for latter</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('getOrganizationMembers', $organization->id) }}">Members <span class="badge">{{ $organization->members->count() }}</span></a></li>
                <li><a href="#">Create Wiki</a></li>
            </ul>
        </div>
    </div>
    <div class="row" style="margin-top: 20px;">
        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
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
                    <h3 class="panel-title">Organization Wikis</h3>
                </div>
                <div class="list-group">
                    <a href="#" class="list-group-item">Lorem ipsum dolor sit amet</a>
                    <a href="#" class="list-group-item">Atque consequatur dolore ullam</a>
                    <a href="#" class="list-group-item">Consectetur adipisicing elit</a>
                    <a href="#" class="list-group-item">Ab aliquid architecto</a>
                </div>
            </div>
        </div>
    </div>
@endsection
