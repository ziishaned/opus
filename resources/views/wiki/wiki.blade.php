@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row" style="margin-top: 10px;">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<div id="side-nav-con">
					<div class="wiki-head">
	    				<div class="pull-left">
	        				<img src="{!! new LetterAvatar($wiki->name, 'circle', 44) !!}" alt="">
	    				</div>
	    				<div class="pull-left" style="margin-left: 10px;">
		        			<h3 style="margin-bottom: 0; margin-top: 14px;" class="wiki-name"><a href="{{ route('wikis.show', [$organization->slug, $wiki->category->slug, $wiki->slug, ]) }}">{{ $wiki->name }}</a></h3>
	    				</div>
	    				<div class="pull-right">
	    					<div class="dropdown" style="margin-top: 14px;">
		    					<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #424242;"><i class="fa fa-ellipsis-v fa-lg fa-fw" style="margin-bottom: 5px;"></i></a>
		                        <ul class="dropdown-menu dropdown-menu-right">
		                            <li>
				        				<a href="{{ route('wikis.overview', [$organization->slug, $wiki->category->slug, $wiki->slug]) }}"><i class="fa fa-info fa-fw"></i> Overview</a>
				        			</li>
				        			<li>
				        				<a href="#"><i class="fa fa-calendar-o fa-fw"></i> Activity</a>
				        			</li>
				        			<li>
				        				<a href="#"><i class="fa fa-key fa-fw"></i> Permissions</a>
				        			</li>
				        			<li>
					                    <a href="{{ route('pages.reorder', [$organization->slug, $wiki->category->slug, $wiki->slug]) }}"><i class="fa fa-reorder fa-fw"></i> Reorder pages</a>
					                </li>
					                <li class="divider"></li>
									<li>
										<a href="#"><i class="fa fa-trash-o fa-fw"></i> Delete</a>
									</li>
		                        </ul>
	    					</div>
	    				</div>
	    				<div class="clearfix"></div>
	    			</div>
	    			<div class="panel panel-default" style="margin-top: 12px;">
	    				<div class="panel-heading"><i class="fa fa-info-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Shortcuts of pages are added by admins"></i> Page shortcuts</div>
	    				<div class="panel-body">
	    					<ul class="list-unstyled" style="margin-bottom: 0;">
		    					<li class="text-center">This wiki does not have any shortcuts yet.</li>
		    				</ul>
	    				</div>
	    			</div>
					<div style="margin-top: 12px;">
						<div class="panel panel-default" id="wiki-list-con">
				            <div class="panel-heading">Page tree</div>
				        	<div class="panel-body" style="padding-left: 0px !important; padding-bottom: 10px; padding-right: 0px; min-height: 320px; overflow-y: auto;">
								<div id="wiki-page-tree" style="margin-top: -7px;" data-wiki-id="{{ $wiki->id }}" data-organization-id="{{ $organization->id }}"></div>
				        	</div>
				        </div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
		    	<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="subnav pull-right" style="position: relative; top: 10px; right: 6px;">
							<ul class="list-unstyled list-inline">
				    			<li><a href="{{ route('wikis.edit', [$organization->slug, $wiki->category->slug, $wiki->slug]) }}"><i class="fa fa-pencil fa-fw"></i> Edit</a></li>
				    			<li><a href="#"><i class="fa fa-check-square-o fa-fw"></i> Add to read list</a></li>
					            <li class="dropdown">
					                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear"></i> <i class="fa fa-caret-down"></i></a>
					                <ul class="dropdown-menu dropdown-menu-right">	
					                    <li><a href="#"><i class="fa fa-info fa-fw"></i> Overview</a></li>
					                    <li><a href="#"><i class="fa fa-history fa-fw"></i> Page history</a></li>
					                    <li><a href="#"><i class="fa fa-html5 fa-fw"></i> Page source</a></li>
					                   	<li class="divider"></li>
					                    <li><a href="#"><i class="fa fa-file-pdf-o fa-fw"></i> Export to PDF</a></li>
					                    <li><a href="#"><i class="fa fa-file-word-o fa-fw"></i> Export to Word Document</a></li>
					                    <li class="divider"></li>
					                    <li>
					                    	<a href="#" onclick="if(confirm('Are you sure you want to delete wiki?')) {event.preventDefault(); document.getElementById('delete-wiki').submit();}"><i class="fa fa-trash-o fa-fw"></i> Delete</a>
											<form id="delete-wiki" action="{{ route('wikis.destroy', [$organization->slug, $wiki->category->slug, $wiki->slug]) }}" method="POST" style="display: none;">
				                                {!! method_field('delete') !!}
				                                {!! csrf_field() !!}
				                            </form>
					                    </li>
					                </ul>
					            </li>
							</ul>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
		    	<div class="row" style="margin-bottom: 10px;">
		    		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				    	<div class="page-description" style="min-height: 245px;">
				    		@if(str_word_count($wiki->description) > 0)
					    		{!! $wiki->description !!}
				    		@else 
								<p class="nothing-found" style="position: absolute; top: 50%; left: 50%; margin-left: -120px; margin-top: -20px;">This page does not contain any description yet...</p>
				    		@endif
				    	</div>
				    </div>
				</div>
			</div>
		</div>
	</div>	
@endsection