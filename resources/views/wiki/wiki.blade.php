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
	                            <div id="page-tree" style="padding-left: 5px;">
									<ul>
										{{ ViewHelper::makeWikiPageTree($wikiPages, null) }}
									</ul>
								</div>
	                        </ul>
	                    </li>
			            <li>
			            	<a href="{{ route('wikis.pages.create', $wiki->slug) }}"><i class="fa fa-plus-square"></i> New Page</a>
			            </li>
	                    <li><a href="#"><i class="fa fa-sort fa-lg"></i> Reorder Pages</a></li>
	                    <ul class="nav nav-pills pull-right" id="organization-nav" style="border-bottom: 0px !important;">
				            <li class="dropdown">
		                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-download fa-lg"></i> <i class="fa fa-caret-down"></i></a>
		                        <ul class="dropdown-menu" style="left: -163px; top: 35px;">
		                            <li><a href="#"><i class="fa fa-file-pdf-o"></i> Export to PDF</a></li>
		                            <li><a href="#"><i class="fa fa-exchange"></i> Export to Word</a></li>
		                            <li><a href="#"><i class="fa fa-file-word-o"></i> Import Word Document</a></li>
		                        </ul>
		                    </li>
		                    <li class="dropdown">
		                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear fa-lg"></i> <i class="fa fa-caret-down"></i></a>
		                        <ul class="dropdown-menu" style="left: -110px; top: 35px;">
		                            <li><a href="{{ route('wikis.edit', $wiki->slug) }}"><i class="fa fa-pencil"></i> Edit</a></li>
				                    <li>
				                    	<a href="#" onclick="event.preventDefault(); document.getElementById('delete-wiki').submit();"><i class="fa fa-trash-o"></i> Delete</a>
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
			    	<div class="page-description" style="padding-left: 20px; padding-right: 20px;">
			    		{!! $wiki->description !!}
			    	</div>
			    </div>
			</div>
	    </div>
	    {{-- <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<div class="row">
                		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		                    <h3 class="panel-title">Page Tree</h3>
                		</div>
                	</div>
                </div>
                <div class="list-group">
                	@if($wikiPages->count() == 0)
	                	<div class="list-group" style="margin-bottom: 0;">
		                	<li class="list-group-item" style="text-align: center;">Nothing found</li>
		                </div>
	               	@else
	                    <div id="page-tree" style="padding-top: 8px; padding-bottom: 8px;">
							<ul>
								{{ ViewHelper::makeWikiPageTree($wikiPages, null) }}
							</ul>
						</div>
					@endif
                </div>
            </div>
	    </div> --}}
	</div>
@endsection