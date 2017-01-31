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
					@include('layouts.partials.page-tree')
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
		    	<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="wiki-subnav">
							<ul class="list-unstyled list-inline">
				    			<li class="active"><a href="{{ route('wikis.overview', [$organization->slug, $wiki->category->slug, $wiki->slug]) }}"><i class="fa fa-info fa-fw"></i> Overview</a></li>
				    			<li><a href="{{ route('wikis.permissions', [$organization->slug, $wiki->category->slug, $wiki->slug]) }}"><i class="fa fa-lock fa-fw"></i> Permissions</a></li>
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
							<div class="panel-heading">Wiki overview</div>
							<div class="panel-body">
								<form action="" method="POST" role="form">
									<div class="row">
										<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="">Name</label>
												<input type="text" class="form-control focus" id="" value="{{ $wiki->name }}" placeholder="Input field">
											</div>
										</div>
										<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="">Created by</label>
												<input type="text" name="" id="input" class="form-control" value="{{ $wiki->user->first_name . ' ' . $wiki->user->last_name }}" disabled="disabled">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="">Outline</label>
										<input type="text" name="" id="input" class="form-control" value="{{ $wiki->outline }}">
									</div>
									<div class="form-group">
										<label for="">Category</label>
										<select name="" id="input" class="form-control" required="required">
											<option value="">{{ $wiki->category->name }}</option>
										</select>
									</div>
									<div class="form-group">
										<label for="">Wiki homepage</label>
										<select name="" id="input" class="form-control" required="required">
											<option value="">Select wiki homepage</option>
										</select>
									</div>
									<input type="submit" class="btn btn-success" value="Update">
									<div class="clearfix"></div>
								</form>
							</div>
						</div>
				    </div>
				</div>
			</div>
		</div>
	</div>	
@endsection