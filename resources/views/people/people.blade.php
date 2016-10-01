@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                            <li>
                                <h4 style="margin-bottom: 0px; margin-top: 7px;">People Directory</h4>
                            </li>
                            <li class="pull-right">
                                <form class="navbar-form navbar-left" role="search" style="margin: 0;">
                                    <div class="form-group input-find">
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-default" value="Search">
                                    </div>
                                </form>
                            </li>
                            <div class="clearfix"></div>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 15px;">
                                <div class="person-con">
                                    <div class="row">
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <img src="/images/default.png" class="img-responsive" alt="Image">
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="padding-left: 0;">
                                            <h5 style="margin-top: 0px; font-size: 15px; margin-bottom: 3px;"><a href="#">John Doe</a></h5>
                                            <p><a href="#">john_doe@gmail.com</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 15px;">
                                <div class="person-con">
                                    <div class="row">
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <img src="/images/default.png" class="img-responsive" alt="Image">
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="padding-left: 0;">
                                            <h5 style="margin-top: 0px; font-size: 15px; margin-bottom: 3px;"><a href="#">John Doe</a></h5>
                                            <p><a href="#">john_doe@gmail.com</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 15px;">
                                <div class="person-con">
                                    <div class="row">
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <img src="/images/default.png" class="img-responsive" alt="Image">
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="padding-left: 0;">
                                            <h5 style="margin-top: 0px; font-size: 15px; margin-bottom: 3px;"><a href="#">John Doe</a></h5>
                                            <p><a href="#">john_doe@gmail.com</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 15px;">
                                <div class="person-con">
                                    <div class="row">
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <img src="/images/default.png" class="img-responsive" alt="Image">
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="padding-left: 0;">
                                            <h5 style="margin-top: 0px; font-size: 15px; margin-bottom: 3px;"><a href="#">John Doe</a></h5>
                                            <p><a href="#">john_doe@gmail.com</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 15px;">
                                <div class="person-con">
                                    <div class="row">
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <img src="/images/default.png" class="img-responsive" alt="Image">
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="padding-left: 0;">
                                            <h5 style="margin-top: 0px; font-size: 15px; margin-bottom: 3px;"><a href="#">John Doe</a></h5>
                                            <p><a href="#">john_doe@gmail.com</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 15px;">
                                <div class="person-con">
                                    <div class="row">
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <img src="/images/default.png" class="img-responsive" alt="Image">
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="padding-left: 0;">
                                            <h5 style="margin-top: 0px; font-size: 15px; margin-bottom: 3px;"><a href="#">John Doe</a></h5>
                                            <p><a href="#">john_doe@gmail.com</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="text-align: center;">
                                <ul class="pagination">
                                    <li><a href="#">&laquo;</a></li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
