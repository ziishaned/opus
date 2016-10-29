@extends('layouts.app')

@section('content')
    @include('layouts.partials.organization-nav')
    <div class="row" style="margin-top: 20px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <h3 style="margin: 0; font-size: 19px;">Organization activity</h3>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="list-unstyled">
                        <li>
                            <div class="activity">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <i class="fa fa-comment-o"></i>
                                        <a href="/users/1">admin</a> commented on <a href="/wikis/12/pages/13">ajsgdgahfdh</a> at <a href="/wikis/12">Testing Slug</a>.
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                                        <p><i class="fa fa-clock-o"></i> <time class="timeago" datetime="2016-10-26 03:54:59">12 hours ago</time></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="activity">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <i class="fa fa-file-text-o"></i>
                                        <a href="/users/1">admin</a> created wiki page <a href="/wikis/12/pages/13">ajsgdgahfdh</a> at <a href="/wikis/12">Testing Slug</a>.
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                                        <p><i class="fa fa-clock-o"></i> <time class="timeago" datetime="2016-10-26 03:54:53">12 hours ago</time></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="activity">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <i class="fa fa-file-text-o"></i>
                                        <a href="/users/1">admin</a> created wiki page <a href="/wikis/12/pages/12">as,dhajksdhka</a> at <a href="/wikis/12">Testing Slug</a>.
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                                        <p><i class="fa fa-clock-o"></i> <time class="timeago" datetime="2016-10-25 10:20:36">a day ago</time></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="activity">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <i class="fa fa-file-text-o"></i>
                                        <a href="/users/1">admin</a> created wiki page <a href="/wikis/12/pages/11">sdjhajsgdhajs</a> at <a href="/wikis/12">Testing Slug</a>.
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                                        <p><i class="fa fa-clock-o"></i> <time class="timeago" datetime="2016-10-25 10:20:09">a day ago</time></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="activity">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <i class="fa fa-file-text-o"></i>
                                        <a href="/users/1">admin</a> created wiki page <a href="/wikis/12/pages/10">klasdhhgasdj</a> at <a href="/wikis/12">Testing Slug</a>.
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                                        <p><i class="fa fa-clock-o"></i> <time class="timeago" datetime="2016-10-25 10:19:48">a day ago</time></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="activity">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <i class="fa fa-file-text-o"></i>
                                        <a href="/users/1">admin</a> created wiki page <a href="/wikis/12/pages/9">askjdashdjs</a> at <a href="/wikis/12">Testing Slug</a>.
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                                        <p><i class="fa fa-clock-o"></i> <time class="timeago" datetime="2016-10-25 10:19:25">a day ago</time></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="activity">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <i class="fa fa-file-text-o"></i>
                                        <a href="/users/1">admin</a> created wiki <a href="/wikis/12">Testing Slug</a>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                                        <p><i class="fa fa-clock-o"></i> <time class="timeago" datetime="2016-10-23 07:24:09">3 days ago</time></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="activity">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <i class="fa fa-file-text-o"></i>
                                        <a href="/users/1">admin</a> created wiki <a href="/wikis/11">Testing</a> at <a href="/organizations/1">askjdhahsd</a>.
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                                        <p><i class="fa fa-clock-o"></i> <time class="timeago" datetime="2016-10-23 07:23:48">3 days ago</time></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="activity">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <i class="fa fa-file-text-o"></i>
                                        <a href="/users/1">admin</a> created wiki <a href="/wikis/8">askdjashdk</a>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                                        <p><i class="fa fa-clock-o"></i> <time class="timeago" datetime="2016-10-23 07:21:32">3 days ago</time></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="activity">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <i class="fa fa-file-text-o"></i>
                                        <a href="/users/1">admin</a> created wiki <a href="/wikis/9">askdjashdk</a>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                                        <p><i class="fa fa-clock-o"></i> <time class="timeago" datetime="2016-10-23 07:21:32">3 days ago</time></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
            </div>
        </div>
    </div>
@endsection
