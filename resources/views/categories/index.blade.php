@extends('layouts.app')

@section('content')
    <div class="subnav" style="background-color: #f8f8f8; border-bottom: 1px solid #E0E0E0;">
        <div class="container">
            <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                <li class="active">
                    <a href="{{ route('organizations.categories.index', [$organization->slug, ]) }}">Categories</a>
                </li>
                <li>
                    <a href="{{ route('organizations.categories.create', [$organization->slug, ]) }}">Create category</a>
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
                        <a href="#">Categories</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <table class="table table-responsive table-condensed table-bordered table-hover categories">
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Engineering</td>
                            <td>
                                <ul class="list-unstyled list-inline categories-actions" style="margin-bottom: 0;">
                                    <li><button type="button" class="btn btn-primary btn-xs"><i class="fa fa-pencil hidden-xs"></i> Edit</button></li>
                                    <li><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o hidden-xs"></i> Delete</button></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>New Employee Onboarding</td>
                            <td>
                                <ul class="list-unstyled list-inline categories-actions" style="margin-bottom: 0;">
                                    <li><button type="button" class="btn btn-primary btn-xs"><i class="fa fa-pencil hidden-xs"></i> Edit</button></li>
                                    <li><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o hidden-xs"></i> Delete</button></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Product</td>
                            <td>
                                <ul class="list-unstyled list-inline categories-actions" style="margin-bottom: 0;">
                                    <li><button type="button" class="btn btn-primary btn-xs"><i class="fa fa-pencil hidden-xs"></i> Edit</button></li>
                                    <li><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o hidden-xs"></i> Delete</button></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Marketing</td>
                            <td>
                                <ul class="list-unstyled list-inline categories-actions" style="margin-bottom: 0;">
                                    <li><button type="button" class="btn btn-primary btn-xs"><i class="fa fa-pencil hidden-xs"></i> Edit</button></li>
                                    <li><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o hidden-xs"></i> Delete</button></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Human Resuorces</td>
                            <td>
                                <ul class="list-unstyled list-inline categories-actions" style="margin-bottom: 0;">
                                    <li><button type="button" class="btn btn-primary btn-xs"><i class="fa fa-pencil hidden-xs"></i> Edit</button></li>
                                    <li><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o hidden-xs"></i> Delete</button></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Sales</td>
                            <td>
                                <ul class="list-unstyled list-inline categories-actions" style="margin-bottom: 0;">
                                    <li><button type="button" class="btn btn-primary btn-xs"><i class="fa fa-pencil hidden-xs"></i> Edit</button></li>
                                    <li><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o hidden-xs"></i> Delete</button></li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection