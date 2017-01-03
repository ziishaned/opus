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
			        <div class="navbar subnav" style="margin-bottom: 0;">
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
		<div class="row" style="margin-top: 20px;">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="panel panel-default" id="wiki-list-con">
				            <div class="panel-heading">Page Tree</div>
				        	<div class="panel-body" style="padding-left: 0px !important; padding-bottom: 10px; padding-right: 0px;">
								<div id="wiki-page-tree" style="margin-top: -7px;" data-wiki-id="{{ $wiki->id }}" data-organization-id="{{ $organization->id }}"></div>
				        	</div>
				        </div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<div class="row">
				    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				    	<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							    <div class="navbar page-subnav" style="margin-bottom: 0;">
						    		<ul class="nav navbar-nav navbar-right">
						    			<li><a href="{{ route('wikis.edit', [$organization->slug, $wiki->slug]) }}"><i class="fa fa-pencil"></i> Edit</a></li>
						    			<li><a href="#"><i class="fa fa-check-square-o"></i> Add to read list</a></li>
							            <li class="dropdown">
							                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear fa-lg"></i> <i class="fa fa-caret-down"></i></a>
							                <ul class="dropdown-menu">	
							                    <li><a href="#"><i class="fa fa-info"></i> Page information</a></li>
							                    <li><a href="#"><i class="fa fa-history"></i> Page history</a></li>
							                    <li><a href="#"><i class="fa fa-html5"></i> Page source</a></li>
							                   	<li class="divider"></li>
							                    <li><a href="#"><i class="fa fa-file-pdf-o"></i> Export to PDF</a></li>
							                    <li><a href="#"><i class="fa fa-file-word-o"></i> Export to Word Document</a></li>
							                    <li class="divider"></li>
							                    <li>
							                    	<a href="#" onclick="if(confirm('Are you sure you want to delete wiki?')) {event.preventDefault(); document.getElementById('delete-wiki').submit();}"><i class="fa fa-trash-o"></i> Delete</a>
													<form id="delete-wiki" action="{{ route('wikis.destroy', [$organization->slug, $wiki->slug]) }}" method="POST" style="display: none;">
						                                {!! method_field('delete') !!}
						                                {!! csrf_field() !!}
						                            </form>
							                    </li>
							                </ul>
							            </li>
						    		</ul>
							    </div>
							</div>
						</div>
				    	<div class="row">
				    		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						    	<div class="page-description" style="padding-top: 10px;">
						    		@if(str_word_count($wiki->description) > 0)
							    		{!! $wiki->description !!}
						    		@else 
										<p class="nothing-found">This page does not contain any description yet...</p>	
						    		@endif
						    	</div>
						    </div>
						</div>
				    </div>
				</div>
			</div>
		</div>
	</div>	
@endsection