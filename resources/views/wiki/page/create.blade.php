@extends('layouts.app')

@section('content')
    <div style="background-color: #f8f8f8; padding-top: 8px; border-bottom: 1px solid #E0E0E0;">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="wiki-head">
                        <h3 style="margin-bottom: 0;" class="wiki-name"><a href="{{ route('wikis.show', [$organization->slug, $wiki->slug, ]) }}">{{ $wiki->name }}</a></h3>
                        <p style="margin-bottom: 0px;" class="text-muted">Created by {{ $wiki->user->first_name . ' ' . $wiki->user->last_name }} on {{ $wiki->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() }} at {{ $wiki->created_at->timezone(Session::get('user_timezone'))->format('h:i A') }}</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="navbar wiki-subnav" style="margin-bottom: 0;">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="#">Overview</a>
                            </li>
                            <li>
                                <a href="#">Permissions</a>
                            </li>
                            <li>
                                <a href="{{ route('wikis.pages.reorder', [$organization->slug, $wiki->slug]) }}">Reorder pages</a>
                            </li>
                            <li style="position: relative; top: 10px;">
                                <a href="{{ route('wikis.pages.create', [$organization->slug, $wiki->slug]) }}" class="btn btn-default" style="padding-top: 5px; padding-bottom: 5px;">Create page</a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <i class="fa fa-caret-down"></i></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#">Delete</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div style="margin-bottom: 10px; margin-top: 10px; height: 50px;">
            <div class="site-breadcrumb">
                <ul class="list-unstyled list-inline" style="margin-bottom: 0px;">
                    <li>
                        <a href="#">{{ $organization->name }}</a>
                    </li>
                    <li>
                        <a href="#">Wikis</a>
                    </li>
                    <li>
                        <a href="#">{{ $wiki->name }}</a>
                    </li>
                    <li class="active">
                        <a href="#">Create page</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3>New page</h3>
                <p style="margin-bottom: 10px;">A wiki contains all the pages with informative text for your project.</p>
                <form action="{{ route('wikis.pages.store', [$organization->slug, $wiki->slug]) }}" method="POST" role="form" style="margin-bottom: 15px;">
                    <input type="text" class="hide" name="wiki_id" value="{{ $wiki->id }}">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group{{ $errors->has('page_name') ? ' has-error' : '' }}">
                                <label for="page-name" class="control-label">Page Name</label>
                                <input type="text" id="page-name" class="form-control input" name="page_name" required="required">
                                @if ($errors->has('page_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('page_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="outline" class="control-label">Short Description</label>
                                <input type="text" name="outline" id="outline" class="form-control input" required="required">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="page-parent" class="control-label">Page parent</label>
                                <select class="form-control input" name="page_parent" id="page-parent">
                                    <option value=""></option>
                                    @foreach($wikiPages as $wikiPage)
                                        <option value="{{ $wikiPage->id }}">{{ $wikiPage->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="page-description-input">
                        <label for="page-description">Description</label>
                        <textarea id="page-description" name="page_description"></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary pull-right" id="create-page-btn" value="Create Page">
                    <div class="clearfix"></div>
                </form>        
            </div>
        </div>
    </div>
@endsection
