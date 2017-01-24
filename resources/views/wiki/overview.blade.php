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
		        			<h3 style="margin-bottom: 0; margin-top: 14px;" class="wiki-name"><a href="{{ route('wikis.show', [$organization->slug, $wiki->slug, ]) }}">{{ $wiki->name }}</a></h3>
	    				</div>
	    				<div class="pull-right">
	    					<div class="dropdown" style="margin-top: 14px;">
		    					<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #424242;"><i class="fa fa-ellipsis-v fa-lg fa-fw" style="margin-bottom: 5px;"></i></a>
		                        <ul class="dropdown-menu dropdown-menu-right">
		                            <li>
				        				<a href="{{ route('wikis.overview', [$organization->slug, $wiki->slug]) }}"><i class="fa fa-info fa-fw"></i> Overview</a>
				        			</li>
				        			<li>
				        				<a href="#"><i class="fa fa-calendar-o fa-fw"></i> Activity</a>
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
						<div class="subnav" style="margin-top: 10px;">
							<ul class="list-unstyled list-inline">
				    			<li class="active"><a href="#"><i class="fa fa-info fa-fw"></i> Overview</a></li>
				    			<li><a href="#"><i class="fa fa-lock"></i> Permissions</a></li>
				    			<li><a href="#"><i class="fa fa-file-text-o"></i> Pages</a></li>
				    			<li><a href="#"><i class="fa fa-inbox"></i> Notifications</a></li>
				    			<li><a href="#"><i class="fa fa-slack"></i> Integrations</a></li>
							</ul>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
		    	<div class="row" style="margin-top: 20px; margin-bottom: 10px;">
		    		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<ul class="list-unstyled overview-info-list">
							<li>
								<div class="row">
									<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
										<div class="overview-label">Name</div>
									</div>
									<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
										{{ $wiki->name }}
									</div>
								</div>	
							</li>
							<li>
								<div class="row">
									<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
										<div class="overview-label">Category</div>
									</div>
									<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
										<a href="#">{{ $wiki->category->name }}</a>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
										<div class="overview-label"><i class="fa fa-info-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Homepage can only set by admins"></i> Homepage</div>
									</div>
									<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
										<a href="#">{{ $wiki->name }}</a>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
										<div class="overview-label">{{ $wiki->user->first_name . ' ' . $wiki->user->last_name }}</div>
									</div>
									<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
										<a href="#">Zeeshan Ahmed</a>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
										<div class="overview-label">Description</div>
									</div>
									<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos deserunt ratione, molestias ipsa doloremque accusantium quae, dolores quo ipsam. In deserunt tenetur dignissimos fugit soluta, temporibus unde non ipsam a.
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
										<div class="overview-label">Administrators</div>
									</div>
									<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
										<ol style="padding-left: 15px;">
											<li>Zeeshan Ahmed</li>
										</ol>
									</div>
								</div>
							</li>
						</ul>
				    </div>
				</div>
			</div>
		</div>
	</div>	
@endsection