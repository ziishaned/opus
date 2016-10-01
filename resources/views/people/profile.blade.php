@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="profile-intro" style="margin-bottom: 20px;">
                    <div class="row">
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <img src="/images/default.png" class="img-responsive" alt="Image">
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding-left: 0;">
                            <h4 style="margin: 0px; margin-bottom: 5px;">John Doe</h4>
                            <p>john.doe@gmail.com</p>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <button class="btn btn-primary pull-right">Follow</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>Activity</h5>
                            </div>
                            <div class="panel-body">
                                <ul class="list-unstyled">
                                    <li>
                                        <p style="margin-top: 5px; margin-bottom: 0;"><i class="fa fa-file-text-o"></i> <a href="#">What is our motive.</a></p>
                                        <p style="padding-left: 17px; margin-bottom: 0;">Updated 3 hours ago</p>
                                    </li>
                                    <li>
                                        <p style="margin-top: 5px; margin-bottom: 0;"><i class="fa fa-file-text-o"></i> <a href="#">What is our motive.</a></p>
                                        <p style="padding-left: 17px; margin-bottom: 0;">Updated 3 hours ago</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>Personal Info</h5>
                            </div>
                            <div class="panel-body">
                                <section class="personal">
                                    <h3>Personal</h3>
                                    <div class="row">
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <p class="text-right">Full Name</p>
                                            <p class="text-right">Email</p>
                                            <p class="text-right">Website</p>
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <p>John Doe</p>
                                            <p>john_doe@gmail.com</p>
                                        </div>
                                    </div>
                                </section>
                                <section class="company">
                                    <h3>Company</h3>
                                    <div class="row">
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <p class="text-right">Position</p>
                                            <p class="text-right">Department</p>
                                            <p class="text-right">Location</p>
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <p>Backend Developer</p>
                                            <p></p>
                                            <p></p>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <ul class="list-unstyled">
                                    <li>
                                        <h5>Following</h5>
                                    </li>
                                    <hr>
                                    <li style="margin-bottom: 15px;">
                                        <div class="row">
                                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                <img src="/images/default.png" class="img-responsive" alt="Image" style="padding-top: 6px;">
                                            </div>
                                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding-left: 0;">
                                                <h5 style="margin: 0;">John Doe</h5>
                                                <p style="margin: 0;"><a href="#">john_doe@gmail.com</a></p>
                                                <btton class="btn btn-primary btn-block btn-sm">Follow</btton>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                <img src="/images/default.png" class="img-responsive" alt="Image" style="padding-top: 6px;">
                                            </div>
                                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding-left: 0;">
                                                <h5 style="margin: 0;">John Doe</h5>
                                                <p style="margin: 0;"><a href="#">john_doe@gmail.com</a></p>
                                                <btton class="btn btn-primary btn-block btn-sm">Follow</btton>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li>
                                        <h5>Followers</h5>
                                    </li>
                                    <hr>
                                    <li style="margin-bottom: 15px;">
                                        <div class="row">
                                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                <img src="/images/default.png" class="img-responsive" alt="Image" style="padding-top: 6px;">
                                            </div>
                                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding-left: 0;">
                                                <h5 style="margin: 0;">John Doe</h5>
                                                <p style="margin: 0;"><a href="#">john_doe@gmail.com</a></p>
                                                <btton class="btn btn-primary btn-block btn-sm">Follow</btton>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                <img src="/images/default.png" class="img-responsive" alt="Image" style="padding-top: 6px;">
                                            </div>
                                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding-left: 0;">
                                                <h5 style="margin: 0;">John Doe</h5>
                                                <p style="margin: 0;"><a href="#">john_doe@gmail.com</a></p>
                                                <btton class="btn btn-primary btn-block btn-sm">Follow</btton>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
