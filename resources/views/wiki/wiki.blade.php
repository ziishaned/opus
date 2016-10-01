@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4 style="margin: 0 0 5px 0; color: #707070; text-transform: uppercase; font-size: 15px;">IT Intro</h4>
                        <ul class="list-unstyled">
                            <div class="list-group" id="wiki-list">
                                <li data-toggle="tooltip" data-delay='{"show":"500", "hide":"100"}' data-placement="right" data-original-title="All updates"><a href="#" class="list-group-item" style="border: none; border-radius: 0px;"><i class="fa fa-file-text-o"></i> Pages</a></li>
                            </div>
                        </ul>
                        <h4 style="margin: 0 0 5px 0; color: #707070; text-transform: uppercase; font-size: 15px;">Page Tree</h4>
                        <div id="wrapper">
                            <div class="tree">
                                <ul id="tree-con" class="list-unstyled">
                                    <li><a>First Level</a>
                                        <ul>
                                            <li><a>Second Level</a></li>
                                            <li><a>Second Level</a></li>
                                            <li><a>Second Level</a></li>
                                        </ul>
                                    </li>
                                    <li><a>First Level</a>
                                        <ul>
                                            <li><a>Second Level</a>
                                                <ul>
                                                    <li><a>Third Level</a></li>
                                                    <li><a>Third Level</a></li>
                                                    <li><a>Third Level</a>
                                                        <ul>
                                                            <li><a>Fourth Level</a></li>
                                                            <li><a>Fourth Level</a></li>
                                                            <li><a>Fourth Level</a>
                                                                <ul>
                                                                    <li><a>Fifth Level</a></li>
                                                                    <li><a>Fifth Level</a></li>
                                                                    <li><a>Fifth Level</a></li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a>Second Level</a></li>
                                        </ul>
                                    </li>
                                    <li><a>First Level</a>
                                        <ul>
                                            <li><a>Second Level</a></li>
                                            <li><a>Second Level</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading" style="border: none;">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="container-fluid">
                                    <ul class="nav navbar-nav navbar-right" id="wiki-page-options">
                                        <li>
                                            <a href="#" class="btn"><i class="fa fa-pencil"></i> Edit</a>
                                        </li>
                                        <li>
                                            <a href="#" class="btn"><i class="fa fa-star-o"></i> Save for later</a>
                                        </li>
                                        <li>
                                            <a href="#" class="btn"><i class="fa fa-eye"></i> Watch</a>
                                        </li>
                                        <li>
                                            <a href="#" class="btn"><i class="fa fa-share-square-o"></i> Share</a>
                                        </li>
                                        <li>
                                            <a href="#" class="btn dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </a>

                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="#">Hello World</a>
                                                </li>
                                                <li>
                                                    <a href="#">Welcome to Wiki</a>
                                                </li>
                                                <li>
                                                    <a href="#">Just added a new One</a>
                                                </li>
                                                <li>
                                                    <a href="#">New Wiki</a>
                                                </li>
                                                <li class="divider"></li>
                                                <li>
                                                    <a href="#">Create Wiki</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>    
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h2 style="margin: 0;">Page Name</h2>
                                <p class="text-muted">Created by <a href="#">John Doe</a>, last modified by <a href="#">Jane Doe</a> on Dec 28, 2015</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <p><a href="#"><i class="fa fa-thumbs-o-up"></i> Like</a> Be the first to like this</p>
                                <form action="" method="POST" role="form">
                                    <div class="row">
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style="padding-right: 0;">
                                            <img src="/images/default.png" class="img-responsive" alt="Image">
                                        </div>
                                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                                            <div class="form-group">
                                                <textarea name="" id="input" class="form-control" rows="3" required="required" placeholder="Write a comment..."></textarea>
                                            </div>                                
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
