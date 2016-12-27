@extends('layouts.app')

@section('content')
    <div class="site-breadcrumb" style="margin-bottom: 20px;">
        <ul class="list-unstyled list-inline" style="margin-bottom: 0px;">
            <li>
                <a href="#">Facebook</a>
            </li>
            <li class="active">
                <a href="#">Dashboard</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2>Wiki by categories</h2>
            <hr>
            <div class="row wikis-categories-con" id="ms-container">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ms-item">
                    <div class="panel panel-default">
                        <div class="panel-body" style="padding: 35px; box-shadow: 0px 0px 9px rgba(158, 158, 158, 0.31)">
                            <h2 class="category-name" style="margin-bottom: 23px;"><i class="fa fa-sitemap fa-lg fa-fw"></i> Engineering</h2>
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <h3 class="list-group-item-heading">Git semver</h3>
                                    <p class="list-group-item-text">A tool for semantic versioning system.</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <h3 class="list-group-item-heading">Git profile</h3>
                                    <p class="list-group-item-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis quae similique deleniti facilis voluptatem.</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <h3 class="list-group-item-heading">Laravel</h3>
                                    <p class="list-group-item-text">Beatae nostrum, quo. Dolore maxime nisi sint iste temporibus mollitia optio.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ms-item">
                    <div class="panel panel-default">
                        <div class="panel-body" style="padding: 35px; box-shadow: 0px 0px 9px rgba(158, 158, 158, 0.31)">
                            <h2 class="category-name" style="margin-bottom: 23px;"><i class="fa fa-sitemap fa-lg fa-fw"></i> New Employee Onboarding</h2>
                            <div>
                                No pages yet. You can <a href="#">create one here</a>.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ms-item">
                    <div class="panel panel-default">
                        <div class="panel-body" style="padding: 35px; box-shadow: 0px 0px 9px rgba(158, 158, 158, 0.31)">
                            <h2 class="category-name" style="margin-bottom: 23px;"><i class="fa fa-sitemap fa-lg fa-fw"></i> Product</h2>
                            <div>
                                No pages yet. You can <a href="#">create one here</a>.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ms-item">
                    <div class="panel panel-default">
                        <div class="panel-body" style="padding: 35px; box-shadow: 0px 0px 9px rgba(158, 158, 158, 0.31)">
                            <h2 class="category-name" style="margin-bottom: 23px;"><i class="fa fa-sitemap fa-lg fa-fw"></i> Human Resuorces</h2>
                            <div>
                                No pages yet. You can <a href="#">create one here</a>.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ms-item">
                    <div class="panel panel-default">
                        <div class="panel-body" style="padding: 35px; box-shadow: 0px 0px 9px rgba(158, 158, 158, 0.31)">
                            <h2 class="category-name" style="margin-bottom: 23px;"><i class="fa fa-sitemap fa-lg fa-fw"></i> Marketing</h2>
                            <div>
                                No pages yet. You can <a href="#">create one here</a>.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ms-item">
                    <div class="panel panel-default">
                        <div class="panel-body" style="padding: 35px; box-shadow: 0px 0px 9px rgba(158, 158, 158, 0.31)">
                            <h2 class="category-name" style="margin-bottom: 23px;"><i class="fa fa-sitemap fa-lg fa-fw"></i> Sales</h2>
                            <div>
                                No pages yet. You can <a href="#">create one here</a>.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
