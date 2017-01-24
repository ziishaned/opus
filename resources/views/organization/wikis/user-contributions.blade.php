@extends('layouts.app')

@section('content')
    <div style="background-color: #f8f8f8; border-bottom: 1px solid #E0E0E0;">
        <div class="container">
            <div class="subnav">
                <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                    <li>
                        <a href="{{ route('organizations.wikis', [$organization->slug, ]) }}">All wikis</a>
                    </li>
                    <li class="active">
                        <a href="{{ route('organizations.wikis.user-contributions', [$organization->slug, ]) }}">My contributions</a>
                    </li>
                    <li>
                        <a href="#">Read list</a>
                    </li>
                    <li>
                        <a href="#" title="Jis py zyada comment or viaitor hon">Trending</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 30px;">
        <div class="row wikis-categories-con" id="ms-container">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ms-item">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h2 class="category-name"><i class="fa fa-sitemap fa-lg fa-fw"></i> Engineering</h2>
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
                    <div class="panel-body has-no-wikis">
                        <h2 class="category-name"><i class="fa fa-sitemap fa-lg fa-fw"></i> New Employee Onboarding</h2>
                        <div style="margin-left: 35px; margin-bottom: 35px; margin-right: 35px;">
                            No pages yet. You can <a href="#">create one here</a>.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ms-item">
                <div class="panel panel-default">
                    <div class="panel-body has-no-wikis">
                        <h2 class="category-name"><i class="fa fa-sitemap fa-lg fa-fw"></i> Product</h2>
                        <div style="margin-left: 35px; margin-bottom: 35px; margin-right: 35px;">
                            No pages yet. You can <a href="#">create one here</a>.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ms-item">
                <div class="panel panel-default">
                    <div class="panel-body has-no-wikis">
                        <h2 class="category-name"><i class="fa fa-sitemap fa-lg fa-fw"></i> Human Resuorces</h2>
                        <div style="margin-left: 35px; margin-bottom: 35px; margin-right: 35px;">
                            No pages yet. You can <a href="#">create one here</a>.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ms-item">
                <div class="panel panel-default">
                    <div class="panel-body has-no-wikis">
                        <h2 class="category-name"><i class="fa fa-sitemap fa-lg fa-fw"></i> Marketing</h2>
                        <div style="margin-left: 35px; margin-bottom: 35px; margin-right: 35px;">
                            No pages yet. You can <a href="#">create one here</a>.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ms-item">
                <div class="panel panel-default">
                    <div class="panel-body has-no-wikis">
                        <h2 class="category-name"><i class="fa fa-sitemap fa-lg fa-fw"></i> Sales</h2>
                        <div style="margin-left: 35px; margin-bottom: 35px; margin-right: 35px;">
                            No pages yet. You can <a href="#">create one here</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
