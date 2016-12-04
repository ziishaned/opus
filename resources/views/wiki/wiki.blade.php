@extends('layouts.app')

@section('content')
	@include('layouts.partials.wiki-nav')
	<div class="row">
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<div class="panel panel-default" id="wiki-list-con" style="margin-top: 10px;">
	            <div class="panel-heading" style="background-color: #ffffff;">
	                <div class="row" style="border-bottom: 1px solid #d8d8d8;">
	                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	                        <h3 class="panel-title" style="margin-bottom: 10px;">Page Tree</h3>    
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	                        <div class="form-group" style="margin-bottom: 0px; margin-top: 10px;">
	                            <input class="form-control input-sm fuzzy-search" id="searchinput" type="search" placeholder="Find a page..." />
	                            <span class="fa fa-search" style="position: absolute; top: 17px; right: 23px; color: #e7e9ed;"></span>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        	<div class="panel-body" style="padding-left: 0px !important;">
					<div id="wiki-page-tree" style="margin-top: -7px;" data-wiki-id="{{ $wiki->id }}"></div>
	        	</div>
	        </div>
		</div>
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
			<div class="row">
			    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			        <ul class="nav nav-pills center-block" id="organization-nav" style="border-top: 1px solid #e5e5e5; margin-top: 10px;">
		                <ul class="nav nav-pills pull-right" id="organization-nav" style="border-bottom: 0px !important;">
				            <li @if(ViewHelper::getCurrentRoute() == 'wikis/{wiki_slug}/pages/create') class="active" @endif>
				            	<a href="{{ route('wikis.pages.create', $wiki->slug) }}" data-toggle="tooltip" data-placement="top" title="Create a page"><i class="fa fa-file-text-o"></i> Create</a>
				            </li>
				            <li><a href="{{ route('wikis.edit', $wiki->slug) }}"><i class="fa fa-pencil"></i> Edit</a></li>
				            <li class="dropdown">
		                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-download fa-lg"></i> <i class="fa fa-caret-down"></i></a>
		                        <ul class="dropdown-menu" style="left: -115px; top: 35px;">
									<li><a href="#"><i class="fa fa-file-pdf-o"></i> PDF</a></li>
		                            <li><a href="#"><i class="fa fa-file-word-o"></i> Word Document</a></li>
		                        </ul>
		                    </li>
		                    <li class="dropdown">
		                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear fa-lg"></i> <i class="fa fa-caret-down"></i></a>
		                        <ul class="dropdown-menu" style="left: -110px; top: 35px;">
				                    <li>
					                	<a href="{{ route('wikis.pages.reorder', $wiki->slug) }}">Reorder Pages</a>
					                </li>
					                <li class="divider"></li>
				                    <li>
				                    	<a href="#" onclick="if(confirm('Are you sure you want to delete wiki?')) {event.preventDefault(); document.getElementById('delete-wiki').submit();}">Delete</a>
										<form id="delete-wiki" action="{{ route('wikis.destroy', $wiki->slug) }}" method="POST" style="display: none;">
			                                {!! method_field('delete') !!}
			                                {!! csrf_field() !!}
			                            </form>
				                    </li>
		                        </ul>
		                    </li>
		                </ul>
			        </ul>
			    </div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			    	<div class="page-description" style="margin-top: 10px;">
			    		{!! $wiki->description !!}
			    	</div>
				</div>
			</div>
	    </div>
	</div>
@endsection