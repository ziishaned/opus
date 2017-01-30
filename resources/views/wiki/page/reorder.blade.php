@extends('layouts.app')

@section('content')
	<div style="background-color: #f8f8f8; padding-top: 8px; border-bottom: 1px solid #E0E0E0;">
        <div class="container">
        	<div class="row">
        		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        			<div class="wiki-head">
	        			<h3 style="margin-bottom: 0;" class="wiki-name"><a href="{{ route('wikis.show', [$organization->slug, $category->slug, $wiki->slug, ]) }}">{{ $wiki->name }}</a></h3>
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
			                    <a href="{{ route('pages.reorder', [$organization->slug, $category->slug, $wiki->slug]) }}">Reorder pages</a>
			                </li>
			                <li style="position: relative; top: 10px;">
			                	<a href="{{ route('pages.create', [$organization->slug, $category->slug, $wiki->slug]) }}" class="btn btn-default" style="padding-top: 5px; padding-bottom: 5px;">Create page</a>
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
		<div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	            <h3 class="panel-title" style="margin-top: 10px; color: #555 !important;">Page Tree</h3>
				<p class="text-muted" style="margin-bottom: 0;">You can move any page by dragging it to a new position in the tree.</p>
		    </div>
		</div>
		<div class="row" style="margin-top: 30px;">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div id="reorder-page-tree" style="margin-top: -7px;" data-wiki-slug="{{ $wiki->slug }}" data-organization-slug="{{ $organization->slug }}"></div>
			</div>
		</div>
    </div>
@endsection