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
                    <tbody class="categories-con">
                        @foreach($categories as $category)
                            <tr class="categories-item">
                                <td id="category_name" data-category-id="{{ $category->id }}" data-organization="{{ $organization->slug }}">{{ $category->name }}</td>
                                <td id="category_actions">
                                    <ul class="list-unstyled list-inline categories-actions" style="margin-bottom: 0;">
                                        <li><button type="button" class="btn btn-primary btn-xs" id="edit-category"><i class="fa fa-pencil hidden-xs"></i> Edit</button></li>
                                        <li>
                                            <a href="#" class="btn btn-danger btn-xs" style="color: #fff;" onclick="if(confirm('Wikis having this category will also be deleted. Are you sure you want to delete this category?')) {event.preventDefault(); document.getElementById('delete-category').submit();}"><i class="fa fa-trash-o hidden-xs"></i> Delete</a>
                                            <form id="delete-category" action="{{ route('organizations.categories.destroy', [$organization->slug, $category->id]) }}" method="POST" style="display: none;">
                                                {!! method_field('delete') !!}
                                                {!! csrf_field() !!}
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="infinitescroll-loader-con" style="text-align: center; margin-bottom: 30px;"></div>
        <div class="categories-pagination-con" style="display: none;">{!! $categories->render() !!}</div>
    </div>
@endsection