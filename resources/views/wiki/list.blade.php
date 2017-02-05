@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div data-spy="affix" data-offset-top="10">
                        <div class="tabs-vertical" style="margin-bottom: 30px;">
                            <div class="index-head">
                                <h4 class=""><i class="fa fa-link fa-fw"></i> Quick links</h4>
                            </div>
                            <div class="index-body">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#"><span class="glyphicon glyphicon-book"></span> <span class="ml15">All wikis</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tabs-vertical">
                            <div class="index-head">
                                <h4 class=""><i class="fa fa-tags fa-fw"></i> Categories</h4>
                            </div>
                            <div class="index-body">
                                @if($categories->count() > 0)
                                    <ul class="list-unstyled">
                                        @foreach($categories as $category)
                                            <li>
                                                <a href="#"><span class="category-icon" style="background-color: {{ ViewHelper::getBackgroundColor($category->name) }}"></span> <span class="ml15">{{ $category->name }}</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-muted text-center">Fovourite list is empty...</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <div style="min-height: 38px;">
                        <div class="index-head affix-top" data-spy="affix" data-offset-top="10" style="background-color: rgb(255, 255, 255); z-index: 10;">
                            <div class="row">
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                    <h4><span class="glyphicon glyphicon-book"></span> <span class="ml10">All Wikis</span></h4>
                                </div>
                                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 text-right">
                                    <form class="form-inline" role="search">
                                        <div class="form-group">
                                            <input type="text" class="form-control input-sm" placeholder="Filter by name..." style="width: 258px;">
                                        </div>
                                        <button type="submit" class="btn btn-default btn-sm">Search</button>
                                        <a href="#" class="btn btn-link">Clear</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="index-body">
                        <table class="table table-condensed wikis-table">
                            <thead>
                                <tr>
                                    <th>Wiki</th>
                                    <th>Description</th>
                                    <th>Categories</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wikis as $wiki)
                                    <tr>
                                        <td>
                                            <div class="v-center">
                                                <a href="#" class="pull-left"><img src="{!! new Avatar($wiki->name, 'square', 34) !!}" class="media-object img-rounded" alt=""></a>
                                                <a href="#" class="pull-left" style="font-size: 15px; margin-left: 25px;">{{ $wiki->name }}</a>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $wiki->outline }}
                                        </td>
                                        <td>
                                            <ul class="list-unstyled mb0 wiki-category-list">
                                                <li>
                                                    <a href="#" class="no-hoverable"><span class="label label-default">{{ $wiki->category->name }}</span></a>
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <i class="fa fa-info-circle fa-fw"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p class="mb20">Hint: Organization administrators can organise spaces into categories.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
