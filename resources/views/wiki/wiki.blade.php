@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 style="margin-bottom: 0;"><a href="{{ route('wikis.show', [$organization->slug, $wiki->slug, ]) }}">{{ $wiki->name }}</a> 
								<div class="dropdown pull-right">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-right: 10px; color: #555;"><i class="fa fa-gear"></i></a>
			                        <ul class="dropdown-menu">
			                            <li>
						                	<a href="#"><i class="fa fa-lock"></i> Permissions</a>
						                </li>
			                            <li>
						                	<a href="{{ route('wikis.pages.reorder', [$organization->slug, $wiki->slug]) }}"><i class="fa fa-align-left"></i> Reorder Pages</a>
						                </li>
			                            <li>
					                    	<a href="#" onclick="if(confirm('Are you sure you want to delete wiki?')) {event.preventDefault(); document.getElementById('delete-wiki').submit();}">Delete</a>
											<form id="delete-wiki" action="{{ route('wikis.destroy', [$organization->slug, $wiki->slug]) }}" method="POST" style="display: none;">
				                                {!! method_field('delete') !!}
				                                {!! csrf_field() !!}
				                            </form>
					                    </li>
			                        </ul>
								</div>
								<div class="clearfix"></div>
							</h3>
							<p style="margin-bottom: 0px;" class="text-muted">Created by {{ $wiki->user->first_name . ' ' . $wiki->user->last_name }} on {{ $wiki->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() }} at {{ $wiki->created_at->timezone(Session::get('user_timezone'))->format('h:i A') }}</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="panel panel-default" id="wiki-list-con">
			            <div class="panel-heading" style="background-color: #ffffff;">
			                <div class="row" style="border-bottom: 1px solid #d8d8d8;">
			                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
			                        <h3 class="panel-title" style="margin-bottom: 10px;">Page Tree</h3>    
			                    </div>
			                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						        	<a href="{{ route('wikis.pages.create', [$organization->slug, $wiki->slug]) }}" style="font-size: 14px; position: relative; top: -4px;"><i class="fa fa-file-text-o"></i> Create</a>
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
			        	<div class="panel-body" style="padding-left: 0px !important; padding-bottom: 10px; padding-right: 0px;">
							<div id="wiki-page-tree" style="margin-top: -7px;" data-wiki-id="{{ $wiki->id }}" data-organization-id="{{ $organization->id }}"></div>
			        	</div>
			        </div>
				</div>
			</div>
		</div>
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
			<div class="row">
			    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			    	<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						    <ul class="nav nav-pills center-block" id="organization-nav" style="border: none;">
						        <ul class="nav nav-pills pull-right" id="organization-nav" style="border-bottom: 0px !important;">
						            <li><a href="{{ route('wikis.edit', [$organization->slug, $wiki->slug]) }}"><i class="fa fa-pencil"></i> Edit</a></li>
						            <li class="dropdown">
						                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-download fa-lg"></i> <i class="fa fa-caret-down"></i></a>
						                <ul class="dropdown-menu" style="left: -115px; top: 35px;">
											<li><a href="#"><i class="fa fa-file-pdf-o"></i> PDF</a></li>
						                    <li><a href="#"><i class="fa fa-file-word-o"></i> Word Document</a></li>
						                </ul>
						            </li>
						            <li class="dropdown">
						                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-right: 0px;"><i class="fa fa-gear fa-lg"></i> <i class="fa fa-caret-down"></i></a>
						                <ul class="dropdown-menu" style="left: -110px; top: 35px;">
						                    <li>
						                    	<a href="#" onclick="if(confirm('Are you sure you want to delete wiki?')) {event.preventDefault(); document.getElementById('delete-wiki').submit();}">Delete</a>
												<form id="delete-wiki" action="{{ route('wikis.destroy', [$organization->slug, $wiki->slug]) }}" method="POST" style="display: none;">
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
					    	<div class="page-description" style="padding-top: 10px;">
					    		@if(str_word_count($wiki->description) > 0)
						    		{!! $wiki->description !!}
					    		@else 
									<h3 class="nothing-found">This page does not contain any description yet...</h3>	
					    		@endif
					    	</div>
					    </div>
					</div>
			    </div>
			</div>
		</div>
			<!-- <ul class="list-inline list-unstyled" style="position: relative; top: 5px;">
				@if($wiki->wiki_watching) 
					<li>
						<button data-wiki-id="{{ $wiki->id }}" id="watch-wiki-btn" class="btn btn-default btn-sm pull-left" style="border-radius: 3px 0px 0px 3px;">
					        Unwatch
					    </button>
					    <div class="count-with-arrow pull-left">
							<span class="count wiki-watch-count" style="line-height: 9px;"> {{ ViewHelper::getWikiWatch($wiki->id) }} </span>
						</div>
						<div class="clearfix"></div>
					</li>
				@else
					<li>
						<button data-wiki-id="{{ $wiki->id }}" id="watch-wiki-btn" class="btn btn-default btn-sm pull-left" style="border-radius: 3px 0px 0px 3px;">
					        Watch
					    </button>
					    <div class="count-with-arrow pull-left">
							<span class="count wiki-watch-count" style="line-height: 9px;"> {{ ViewHelper::getWikiWatch($wiki->id) }} </span>
						</div>
						<div class="clearfix"></div>
					</li>
				@endif
			</ul> -->
	</div>
@endsection