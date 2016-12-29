@extends('layouts.app')

@section('content')
    <div class="subnav" style="background-color: #f8f8f8; border-bottom: 1px solid #E0E0E0;">
        <div class="container">
            <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                <li>
                    <a href="#">Categories</a>
                </li>
                <li class="active">
                    <a href="#">Create category</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div style="margin-bottom: 10px; margin-top: 10px; height: 50px;" class="hidden-xs">
            <div class="site-breadcrumb">
                <ul class="list-unstyled list-inline" style="margin-bottom: 0px;">
                    <li>
                        <a href="#">Facebook</a>
                    </li>
                    <li class="active">
                        <a href="#">Create category</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div style="padding: 30px 0px; border-bottom: 1px solid #ccc;">
                    <h1 class="text-center" style="font-weight: 300; margin-bottom: 14px;">Create a new <span style="font-weight: 500;">Category</span></h1>
                    <p class="text-center" style="font-size: 17px;">Wikis are divided into categories so you can interact with wikis more conveniently.</p>
                </div>
                <div style="margin-top: 20px;">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                            <form action="" method="POST" role="form" id="create-category-form">
                                <div class="form-group">
                                    <label for="" class="control-label">Category name</label>
                                    <input type="text" class="form-control input" id="">
                                </div>
                                <div class="pull-right" style="margin-top: 20px;">
                                    <button type="button" class="btn btn-success">Create</button>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection