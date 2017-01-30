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
		        			<h3 style="margin-bottom: 0; margin-top: 14px;" class="wiki-name"><a href="{{ route('wikis.show', [$organization->slug, $category->slug, $wiki->slug, ]) }}">{{ $wiki->name }}</a></h3>
	    				</div>
	    				<div class="pull-right">
	    					<div class="dropdown" style="margin-top: 14px;">
		    					<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #424242;"><i class="fa fa-ellipsis-v fa-lg fa-fw" style="margin-bottom: 5px;"></i></a>
		                        <ul class="dropdown-menu dropdown-menu-right">
		                            <li>
				        				<a href="{{ route('wikis.overview', [$organization->slug, $category->slug, $wiki->slug]) }}"><i class="fa fa-info fa-fw"></i> Overview</a>
				        			</li>
				        			<li>
				        				<a href="#"><i class="fa fa-calendar-o fa-fw"></i> Activity</a>
				        			</li>
				        			<li>
				        				<a href="#"><i class="fa fa-key fa-fw"></i> Permissions</a>
				        			</li>
				        			<li>
					                    <a href="{{ route('pages.reorder', [$organization->slug, $category->slug, $wiki->slug]) }}"><i class="fa fa-reorder fa-fw"></i> Reorder pages</a>
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
						<div class="subnav">
							<ul class="list-unstyled list-inline">
				    			<li><a href="{{ route('wikis.overview', [$organization->slug, $category->slug, $wiki->slug]) }}"><i class="fa fa-info fa-fw"></i> Overview</a></li>
				    			<li class="active"><a href="{{ route('wikis.permissions', [$organization->slug, $category->slug, $wiki->slug]) }}"><i class="fa fa-lock fa-fw"></i> Permissions</a></li>
				    			<li><a href="#"><i class="fa fa-file-text-o fa-fw"></i> Pages</a></li>
				    			<li><a href="#"><i class="fa fa-inbox fa-fw"></i> Notifications</a></li>
				    			<li><a href="#"><i class="fa fa-slack fa-fw"></i> Integrations</a></li>
							</ul>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
		    	<div class="row" style="margin-top: 5px;">
		    		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								Users with access to {{ $wiki->name }} wiki <span class="label label-default" style="-webkit-text-stroke: 0px;">5</span>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
										<div class="member-con" style="margin-bottom: 18px; border: 1px solid #E0E0E0; padding: 18px 29px; border-radius: 4px; box-shadow: 0px 0px 3px rgba(204, 204, 204, 0.35)">
				                            <div class="member-image pull-left">
                                                <img src="/images/profile-pics/img_2017-01-21-05-14.jpg" width="54" height="54" alt="Image" style="border-radius: 50%; border: 1px solid #fafafa;">
                                            </div>
				                            <div class="member-info pull-left" style="margin-left: 18px; margin-top: 2px;">
				                                <h4 style="margin-top: 5px; margin-bottom: 5px; font-size: 14px;">Zeeshan Ahmed<span class="label label-success" style="padding: 2px 8px; -webkit-text-stroke: 0px; position: relative; top: -2px; left: 8px;">Normal user</span></h4>
				                                <a href="mailto:ziishaned@gmail.com">ziishaned@gmail.com</a>
				                            </div>
				                            <div class="clearfix"></div>
				                        </div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
										<div class="member-con" style="margin-bottom: 18px; border: 1px solid #E0E0E0; padding: 18px 29px; border-radius: 4px; box-shadow: 0px 0px 3px rgba(204, 204, 204, 0.35)">
				                            <div class="member-image pull-left">
                                                <img src="/images/profile-pics/img_2017-01-21-05-14.jpg" width="54" height="54" alt="Image" style="border-radius: 50%; border: 1px solid #fafafa;">
                                            </div>
				                            <div class="member-info pull-left" style="margin-left: 18px; margin-top: 2px;">
				                                <h4 style="margin-top: 5px; margin-bottom: 5px; font-size: 14px;">Zeeshan Ahmed<span class="label label-primary" style="padding: 2px 8px; -webkit-text-stroke: 0px; position: relative; top: -2px; left: 8px;">Admin</span></h4>
				                                <a href="mailto:ziishaned@gmail.com">ziishaned@gmail.com</a>
				                            </div>
				                            <div class="clearfix"></div>
				                        </div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
										<div class="member-con" style="margin-bottom: 18px; border: 1px solid #E0E0E0; padding: 18px 29px; border-radius: 4px; box-shadow: 0px 0px 3px rgba(204, 204, 204, 0.35)">
				                            <div class="member-image pull-left">
                                                <img src="/images/profile-pics/img_2017-01-21-05-14.jpg" width="54" height="54" alt="Image" style="border-radius: 50%; border: 1px solid #fafafa;">
                                            </div>
				                            <div class="member-info pull-left" style="margin-left: 18px; margin-top: 2px;">
				                                <h4 style="margin-top: 5px; margin-bottom: 5px; font-size: 14px;">Zeeshan Ahmed<span class="label label-primary" style="padding: 2px 8px; -webkit-text-stroke: 0px; position: relative; top: -2px; left: 8px;">Admin</span></h4>
				                                <a href="mailto:ziishaned@gmail.com">ziishaned@gmail.com</a>
				                            </div>
				                            <div class="clearfix"></div>
				                        </div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
										<div class="member-con" style="margin-bottom: 18px; border: 1px solid #E0E0E0; padding: 18px 29px; border-radius: 4px; box-shadow: 0px 0px 3px rgba(204, 204, 204, 0.35)">
				                            <div class="member-image pull-left">
                                                <img src="/images/profile-pics/img_2017-01-21-05-14.jpg" width="54" height="54" alt="Image" style="border-radius: 50%; border: 1px solid #fafafa;">
                                            </div>
				                            <div class="member-info pull-left" style="margin-left: 18px; margin-top: 2px;">
				                                <h4 style="margin-top: 5px; margin-bottom: 5px; font-size: 14px;">Zeeshan Ahmed<span class="label label-success" style="padding: 2px 8px; -webkit-text-stroke: 0px; position: relative; top: -2px; left: 8px;">Normal user</span></h4>
				                                <a href="mailto:ziishaned@gmail.com">ziishaned@gmail.com</a>
				                            </div>
				                            <div class="clearfix"></div>
				                        </div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
										<div class="member-con" style="border: 1px solid #E0E0E0; padding: 18px 29px; border-radius: 4px; box-shadow: 0px 0px 3px rgba(204, 204, 204, 0.35)">
				                            <div class="member-image pull-left">
                                                <img src="/images/profile-pics/img_2017-01-21-05-14.jpg" width="54" height="54" alt="Image" style="border-radius: 50%; border: 1px solid #fafafa;">
                                            </div>
				                            <div class="member-info pull-left" style="margin-left: 18px; margin-top: 2px;">
				                                <h4 style="margin-top: 5px; margin-bottom: 5px; font-size: 14px;">Zeeshan Ahmed<span class="label label-primary" style="padding: 2px 8px; -webkit-text-stroke: 0px; position: relative; top: -2px; left: 8px;">Owner</span></h4>
				                                <a href="mailto:ziishaned@gmail.com">ziishaned@gmail.com</a>
				                            </div>
				                            <div class="clearfix"></div>
				                        </div>
									</div>
								</div>
							</div>
						</div>
				    </div>
				</div>
			</div>
		</div>
	</div>	
@endsection