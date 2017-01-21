@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" style="background-color: #f8f8f8; border-right: 1px solid #ddd; height: 100%; position: fixed;">
				<div class="wiki-sidebar">
					<div>
						<div class="row">
			        		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			        			<div class="wiki-head" style="padding: 15px 0px;">
			        				<ul class="list-inline list-unstyled" style="margin-bottom: 0px;">
			        					<li>
					        				<img src="{{ new LetterAvatar($wiki->name, 'circle', 44) }}" alt=""> 
			        					</li>
			        					<li>
			        						<h3 class="wiki-name" style="position: relative; top: 4px;">
						        				<a href="{{ route('wikis.show', [$organization->slug, $wiki->slug, ]) }}">{{ $wiki->name }}</a>
			        						</h3>
			        					</li>
			        					<li class="dropdown" style="float: right; position: relative; top: 3.2px;">
											<a href="#" style="color: #424242;" class="dropdown-toggle btn btn-default" data-toggle="dropdown"><i class="fa fa-gear"></i> <i class="fa fa-caret-down"></i></a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li>
										    		<a href="#"><i class="fa fa-info fa-fw"></i> Wiki information</a>
										    	</li>
												<li>
							        				<a href="#"><i class="fa fa-key fa-fw"></i> Permissions</a>
							        			</li>
							        			<li>
								                    <a href="{{ route('pages.reorder', [$organization->slug, $wiki->slug]) }}"><i class="fa fa-reorder fa-fw"></i> Reorder pages</a>
								                </li>
												<li class="divider"></li>
												<li>
													<a href="#"><i class="fa fa-trash-o fa-fw"></i> Delete</a>
												</li>
											</ul>
			        					</li>
			        				</ul>
			        			</div>
			        		</div>
		        		</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					            <div style="margin-bottom: 15px;">
									<h3>Page Tree</h3>
				                </div>
					        	<div id="wiki-page-tree-con-a" style="position: relative; top: -5px; left: -5px;">
									<div id="wiki-page-tree" data-wiki-id="{{ $wiki->id }}" data-organization-id="{{ $organization->id }}"></div>
					        	</div>
				            </div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9" style="margin-left: 337px;">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					    <div class="navbar" style="margin-bottom: 0; margin-top: 10px;">
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
				    	<div class="page-description" style="padding-bottom: 25px; position: relative; top: -10px;">
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
@endsection