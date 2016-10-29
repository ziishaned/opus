@extends('layouts.app')

@section('content')
	<div class="row">
	    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	    	<div class="panel panel-default">
                <div class="panel-heading">
                	<div class="row" style="display: flex; align-items: center;">
                		<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
		                    <h3 class="panel-title">{{ $wiki->name }}</h3>
                		</div>
                		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                			<div class="dropdown">
							  <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="manage-wiki-dropdown" style="color: #333;"><i class="fa fa-gear fa-lg"></i> <span class="caret"></span></a>
							  <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu2" style="top: 25px;">
							    <li><a href="#"><i class="fa fa-align-left"></i> Reorder Pages</a></li>
							    <li>
							    	<a href="#" onclick="event.preventDefault(); document.getElementById('delete-wiki').submit();"><i class="fa fa-trash-o"></i> Delete</a>
									<form id="delete-wiki" action="{{ route('wikis.destroy', $wiki->slug) }}" method="POST" style="display: none;">
	                                    {!! method_field('delete') !!}
	                                    {!! csrf_field() !!}
	                                </form>
							    </li>
							  </ul>
							</div>	
                		</div>
                	</div>
                </div>
                <div class="list-group">
                    <a href="{{ route('wikis.show', $wiki->slug) }}" class="list-group-item"><i class="fa fa-home"></i> Home</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                	<div class="row">
                		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		                    <h3 class="panel-title">Wiki Shortcuts</h3>
                		</div>
                	</div>
                </div>
                <div class="list-group">
                	<li class="list-group-item" style="text-align: center;">Nothing found</li>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                	<div class="row">
                		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		                    <h3 class="panel-title">Page Tree</h3>
                		</div>
                		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                			<a href="{{ route('wikis.pages.create', $wiki->slug) }}" class="btn btn-success btn-xs">Create Page</a>
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
	    </div>
	    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	    	<div class="row">
		    	<div class="wiki-nav-con">
		    		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				        <ul class="nav nav-pills">
				            <li><a href="#">Pages</a></li>
					    </ul>
		    		</div>
		    		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
		    			<ul class="nav nav-pills navbar-right" style="margin-right: 10px;">
				            <li><a href="{{ route('wikis.edit', $wiki->slug) }}"><i class="fa fa-pencil"></i> Edit</a></li>
				            <li><a href="#"><i class="fa fa-clock-o"></i> Save for later</a></li>
				            <li><a href="#"><i class="fa fa-eye"></i> Watch</a></li>
				            <li class="dropdown">
		                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v fa-lg"></i></a>
		                        <ul class="dropdown-menu">
		                            <li><a href="#"><i class="fa fa-paperclip"></i> Attachments <span class="badge">0</span></a></li>
		                            <li><a href="#"><i class="fa fa-history"></i> Page History</a></li>
		                            <li><a href="#"><i class="fa fa-lock"></i> Privacy</a></li>
		                            <li class="divider"></li>
		                            <li><a href="#"><i class="fa fa-file-pdf-o"></i> Export to PDF</a></li>
		                            <li><a href="#"><i class="fa fa-exchange"></i> Export to Word</a></li>
		                            <li><a href="#"><i class="fa fa-file-word-o"></i> Import Word Document</a></li>
		                            <li class="divider"></li>
		                            <li><a href="#"><i class="fa fa-copy"></i> Copy</a></li>
		                            <li><a href="#"><i class="fa fa-arrows"></i> Move</a></li>
		                            <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
		                        </ul>
		                    </li>
				        </ul>	
		    		</div>
		    	</div>
	    	</div>
	    	<div class="clearfix"></div>
	    	<div class="row">
	    		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    			<div class="well well-sm" style="margin-bottom: 0px; border-radius: 0; color: #fff; border: 1px solid transparent; box-shadow: 0 1px 1px rgba(0,0,0,.05); background-color: #555;">
		    			<div class="pull-left">
			    			<h2 style="margin: 0; margin-bottom: 3px; font-size: 18px;">{{ $wiki->name }}</h2>
		    				<p style="margin-bottom: 0;">Created by {{ ViewHelper::getUsername($wiki->user_id) }} on {{ $wiki->created_at->toFormattedDateString() }}</p>
		    			</div>
		    			<div class="pull-right" style="margin-top: 15px;">
		    				<ul class="list-unstyled list-inline">
			    				<li><i class="fa fa-heart"></i> {{ ViewHelper::getWikiStar($wiki->slug) }}</li>
			    			</ul>
		    			</div>
				    	<div class="clearfix"></div>
	    			</div>		
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
	</div>
@endsection