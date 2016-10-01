@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body" style="padding-left: 0px; padding-right: 0px;">
                    <h4 style="margin: 0 0 5px 0; padding-left: 15px; color: #707070; text-transform: uppercase; font-size: 12px;">Discover</h4>
                    <ul class="list-unstyled">
                        <div class="list-group" id="wiki-list">
                            <li data-toggle="tooltip" data-delay='{"show":"500", "hide":"100"}' data-placement="right" data-original-title="All updates"><a href="#" class="list-group-item" style="border: none; border-radius: 0px;"><i class="fa fa-list-ul"></i> All Updates</a></li>
                            <li data-toggle="tooltip" data-delay='{"show":"500", "hide":"100"}' data-placement="right" data-original-title="Popular"><a href="#" class="list-group-item" style="border: none; border-radius: 0px;"><i class="fa fa-line-chart"></i> Popular</a></li>
                        </div>
                    </ul>
                    <h4 style="margin: 0 0 5px 0; padding-left: 15px; color: #707070; text-transform: uppercase; font-size: 12px;">My Work</h4>
                    <ul class="list-unstyled">
                        <div class="list-group" id="wiki-list">
                            <li data-toggle="tooltip" data-delay='{"show":"500", "hide":"100"}' data-placement="right" data-original-title="Recent worked on"><a href="#" class="list-group-item" style="border: none; border-radius: 0px;"><i class="fa fa-pencil"></i> Recently worked on</a></li>
                            <li data-toggle="tooltip" data-delay='{"show":"500", "hide":"100"}' data-placement="right" data-original-title="Recently visited"><a href="#" class="list-group-item" style="border: none; border-radius: 0px;"><i class="fa fa-clock-o"></i> Recently visited</a></li>
                            <li data-toggle="tooltip" data-delay='{"show":"500", "hide":"100"}' data-placement="right" data-original-title="Saved for latter"><a href="#" class="list-group-item" style="border: none; border-radius: 0px;"><i class="fa fa-star-o"></i> Saved for later</a></li>
                        </div>
                    </ul>
                    <h4 style="margin: 0 0 5px 0; padding-left: 15px; color: #707070; text-transform: uppercase; font-size: 12px;">My Wikis <a href="#" class="pull-right" style="padding-right: 12px; text-transform: capitalize; text-decoration: none;">All</a></h4>
                    <ul class="list-unstyled">
                        <div class="list-group" id="wiki-list">
                            <li data-toggle="tooltip" data-delay='{"show":"500", "hide":"100"}' data-placement="right" data-original-title="Dapibus ac facilisis in"><a href="#" class="list-group-item" style="border: none; border-radius: 0px;">Dapibus ac facilisis in <i class="fa fa-times fa-pull-right" id="remove-wiki"></i></a></li>
                            <li data-toggle="tooltip" data-delay='{"show":"500", "hide":"100"}' data-placement="right" data-original-title="Cras sit amet nibh libero "><a href="#" class="list-group-item" style="border: none; border-radius: 0px;">Cras sit amet nibh libero <i class="fa fa-times fa-pull-right" id="remove-wiki"></i></a></li>
                            <li data-toggle="tooltip" data-delay='{"show":"500", "hide":"100"}' data-placement="right" data-original-title="Porta ac consectetur ac"><a href="#" class="list-group-item" style="border: none; border-radius: 0px;">Porta ac consectetur ac <i class="fa fa-times fa-pull-right" id="remove-wiki"></i></a></li>
                            <li data-toggle="tooltip" data-delay='{"show":"500", "hide":"100"}' data-placement="right" data-original-title="Vestibulum at eros "><a href="#" class="list-group-item" style="border: none; border-radius: 0px;">Vestibulum at eros <i class="fa fa-times fa-pull-right" id="remove-wiki"></i></a></li>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading" style="color: #707070; text-transform: uppercase; font-size: 15px; font-weight: 600;">All Updates</div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <img src="/images/default.png" style="width: 100px;" class="img-responsive" alt="Image">
                                </div>
                                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                    <h4 style="margin: 0px;"><a href="#">John Doe</a></h4>
                                    <div class="activity">
                                        <p style="margin-top: 5px; margin-bottom: 0;"><i class="fa fa-file-text-o"></i> <a href="#">What is our motive.</a></p>
                                        <p style="padding-left: 17px; margin-bottom: 0;">Updated 3 hours ago</p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <img src="/images/default.png" style="width: 100px;" class="img-responsive" alt="Image">
                                </div>
                                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
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
                            <hr>
                            <div class="row">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <img src="/images/default.png" style="width: 100px;" class="img-responsive" alt="Image">
                                </div>
                                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
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
                            <hr>
                            <div class="row">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <img src="/images/default.png" style="width: 100px;" class="img-responsive" alt="Image">
                                </div>
                                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
