@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row" style="margin-bottom: 10px;">
                <div class="wiki-nav-con">
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        <div class="row">
                            <div class="pull-left" style="position: relative; top: 10px; left: 15px; margin-right: 5px;">
                                <i class="fa fa-wikipedia-w fa-lg"></i> 
                            </div>
                            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                                <h2 style="margin: 0; margin-bottom: 3px; font-size: 18px; margin-top: 10px; font-weight: normal;"><a href="#" style="color:#4078c0; font-weight: normal; text-transform: capitalize;">{{ $wiki->name }}</a></h2>
                                <p style="margin-bottom: 0;" class="text-muted">Created by {{ ViewHelper::getUsername($wiki->user_id) }} on {{ $wiki->created_at->toFormattedDateString() }} at {{ $wiki->created_at->format('h:i A') }} </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right" style="margin-top: 10px;">
                        <ul class="list-inline list-unstyled" style="margin-bottom: 0px;">
                            <li>
                                <button type="submit" class="btn btn-default pull-left" style="border-radius: 3px 0px 0px 3px;">
                                    <i class="fa fa-star-o"></i> Unstar
                                </button>
                                <div class="count-with-arrow pull-left">
                                    <span class="count star-count"> {{ ViewHelper::getWikiStar($wiki->slug) }} </span>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="nav nav-pills center-block" id="organization-nav" style="border-top: 1px solid #e5e5e5;">
                        <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'wikis/{wiki_slug}') class="active" @endif>
                            <a href="{{ route('wikis.show', $wiki->slug) }}"><i class="fa fa-home"></i> Home</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-text-o"></i> Select Page <i class="fa fa-caret-down"></i></a>
                            <ul class="dropdown-menu page-tree-con" style="left: -95px; top: 35px; width: 200px;">
                                <div id="page-tree">
                                    <ul>
                                        {{-- {{ ViewHelper::makeWikiPageTree($wikiPages, $wiki->id) }} --}}
                                    </ul>
                                </div>
                            </ul>
                        </li>
                        <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'wikis/{wiki_slug}/pages/create') class="active" @endif>
                            <a href="{{ route('wikis.pages.create', $wiki->slug) }}"><i class="fa fa-plus-square"></i> New Page</a>
                        </li>
                        <li><a href="#"><i class="fa fa-sort fa-lg"></i> Reorder Pages</a></li>
                        <ul class="nav nav-pills pull-right" id="organization-nav" style="border-bottom: 0px !important;">
                            
                        </ul>
                    </ul>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <form action="{{ route('wikis.pages.store', $wiki->slug) }}" method="POST" role="form" style="margin-bottom: 15px;">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                    <div class="form-group" style="margin: 0;">
                                        <label for="" class="control-label" style="font-weight: 600;">Select Wiki</label>
                                        <select id="wiki-input" name="wiki_id" placeholder="Find and select wiki.." disabled="disabled">
                                            <option value="{{ $wiki->id }}" selected>{{ $wiki->name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 separator" style="padding: 0; width: 10px; font-size: 30px; position: relative; top: 22px; font-family: 'Open Sans'; font-weight: 300;"></div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group{{ $errors->has('page_name') ? ' has-error' : '' }}" style="margin: 0;">
                                        <label for="page-name" class="control-label" style="font-weight: 600;">Page Name</label>
                                        <input type="text" name="page_name" id="page-name" class="form-control" required="required">
                                        @if ($errors->has('page_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('page_name') }}</strong>
                                            </span>
                                        @endif
                                        <p class="text-muted">Great page names are short and memorable.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                    <div class="form-group" style="margin: 0;">
                                        <label for="page-parent" class="control-label" style="font-weight: 600;">Page Parent</label>
                                        <select id="page-parent" name="page_parent" placeholder="Select page parent.."></select>
                                    </div>
                                    <p class="text-muted">Leave it blank if this page has no parent.</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="page-description-input">
                            <label for="page-description" style="font-weight: 600;">Description</label>
                            <textarea id="page-description" name="page_description"></textarea>
                        </div>
                        <input type="submit" class="btn btn-success pull-right" id="create-page-btn" value="Create Page">
                        <div class="clearfix"></div>
                    </form>        
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row" style="margin-top: 20px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 style="margin: 0px 0px 8px;">Create Page in <span class="text-muted"><i>{{ $wiki->name }}</i></span> Wiki</h3>
            <p class="text-muted">A page contains the information of a project module.</p>
            <hr>
            <form action="{{ route('wikis.pages.store', $wiki->slug) }}" method="POST" role="form" style="margin-bottom: 15px;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                            <div class="form-group" style="margin: 0;">
                                <label for="" class="control-label">Select Wiki</label>
                                <select id="wiki-input" name="wiki_id" placeholder="Find and select wiki.." disabled="disabled">
                                    <option value="{{ $wiki->id }}" selected>{{ $wiki->name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 separator" style="padding: 0; width: 10px; font-size: 30px; position: relative; top: 22px; font-family: 'Open Sans'; font-weight: 300;"></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group{{ $errors->has('page_name') ? ' has-error' : '' }}" style="margin: 0;">
                                <label for="page-name" class="control-label">Page Name</label>
                                <input type="text" name="page_name" id="page-name" class="form-control" required="required">
                                
                                @if ($errors->has('page_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('page_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <p class="text-muted">Great page names are short and memorable.</p>
                    <div class="row">
                    	<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                            <div class="form-group" style="margin: 0;">
                                <label for="page-parent" class="control-label">Page Parent</label>
                                <select id="page-parent" name="page_parent" placeholder="Select page parent.."></select>
                            </div>
		                    <p class="text-muted">Leave it blank if this page has no parent.</p>
                    	</div>
                    </div>
                </div>
                <div class="form-group" id="page-description-input">
                    <label for="page-description">Description</label>
                    <textarea id="page-description" name="page_description"></textarea>
                </div>
                <input type="submit" class="btn btn-success pull-right" id="create-page-btn" value="Create Page">
                <div class="clearfix"></div>
            </form>
        </div>
    </div> --}}
@endsection
