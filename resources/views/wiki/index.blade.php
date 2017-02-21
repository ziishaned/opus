@extends('layouts.master')

@section('content')
	<div class="side-menu hidden-sm hidden-xs">
		<div class="wiki-side-menu">
			<div class="side-menu-inner">
				<div class="wiki-intro">
					<h1 class="header"><a href="#">Demonstration Space</a> <a href="#" style="margin-left: 8px;"><i class="fa fa-star-o fa-fw"></i></a></h1>
				</div>
				<ul class="list-unstyled side-menu-top">
					<li class="nav-header" style="margin-bottom: 8px;">Quick Links</li>
					<li class="item active">
						<a href="dashboard.html">
							<img src="/img/icons/basic_clockwise.svg" width="24" height="24" class="icon">
							<span class="item-name">Activity</span>
						</a>
					</li>
					<li class="item">
						<a href="wikis-list.html">
							<img src="/img/icons/basic_webpage_txt.svg" width="24" height="24" class="icon">
							<span class="item-name">All Pages</span>
						</a>
					</li>
				</ul>
				<div class="side-menu-page-shortcuts-list">
					<ul class="list-unstyled">
						<li class="nav-header">Shortcuts</li>
						<li class="text-center text-muted" style="margin-top: 5px;">Nothing found...</li>
					</ul>
				</div>
				<div class="side-menu-page-tree-list">
					<ul class="list-unstyled">
						<li class="nav-header">Page tree</li>
					</ul>
				</div>
			</div>
			<div class="wiki-setting-bottom">
				<div class="dropup">
				  	<button class="btn dropdown-toggle wiki-setting-button" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	<i class="fa fa-cog fa-fw fa-lg"></i> Wiki Settings
				    	<i class="fa fa-caret-down fa-fw"></i>
				  	</button>
				 	<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
					    <li><a href="wiki-overview.html"><i class="fa fa-info-circle fa-fw"></i> Overview</a></li>
					    <li><a href="#"><i class="fa fa-lock fa-fw"></i> Permissions</a></li>
					    <li><a href="#"><i class="fa fa-slack fa-fw"></i> Integrations</a></li>
					    <li><a href="#"><i class="fa fa-exclamation-triangle fa-fw"></i> Notifications</a></li>
					    <li class="divider"></li>
					    <li><a href="#"><i class="fa fa-list-ol fa-fw"></i> Reorder pages</a></li>
				  	</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="aside-content">
		<div class="row no-container">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<div class="page-header">All activities</div>
				<div class="events-list">
					<div class="media event">
						<a class="pull-left event-user-image" href="#">
							<img class="media-object img-circle" src="/img/elliot.jpg" alt="Image">
						</a>
						<div class="media-body">
							<div class="event-top">
								<div class="pull-left event-icon">
									<img src="/img/icons/basic_message.svg" width="22" height="22" alt="Image">
								</div>
								<div class="pull-left">
									<a href="#">Elliot</a> commented on a page <a href="#">How to install</a>.
								</div>
								<div class="clearfix"></div>
							</div>
							<p class="text-muted">2 days ago</p>
						</div>
					</div>
					<div class="media event">
						<a class="pull-left event-user-image" href="#">
							<img class="media-object img-circle" src="/img/helen.jpg" alt="Image">
						</a>
						<div class="media-body">
							<div class="event-top">
								<div class="pull-left event-icon">
									<img src="/img/icons/basic_webpage_txt.svg" width="22" height="22" alt="Image">
								</div>
								<div class="pull-left">
									<a href="#">Helen</a> created on a page <a href="#">How to install</a>.
								</div>
								<div class="clearfix"></div>
							</div>
							<p class="text-muted">2 days ago</p>
						</div>
					</div>
					<div class="media event">
						<a class="pull-left event-user-image" href="#">
							<img class="media-object img-circle" src="/img/jenny.jpg" alt="Image">
						</a>
						<div class="media-body">
							<div class="event-top">
								<div class="pull-left event-icon">
									<img src="/img/icons/basic_trashcan.svg" width="22" height="22" alt="Image">
								</div>
								<div class="pull-left">
									<a href="#">Jenny</a> deleted a wiki <a href="#">Demonstration Wiki</a>.
								</div>
								<div class="clearfix"></div>
							</div>
							<p class="text-muted">2 days ago</p>
						</div>
					</div>
					<div class="media event">
						<a class="pull-left event-user-image" href="#">
							<img class="media-object img-circle" src="/img/joe.jpg" alt="Image">
						</a>
						<div class="media-body">
							<div class="event-top">
								<div class="pull-left event-icon">
									<img src="/img/icons/basic_notebook.svg" width="22" height="22" alt="Image">
								</div>
								<div class="pull-left">
									<a href="#">Joe</a> create a wiki <a href="wiki.html">Demonstration Space</a>.
								</div>
								<div class="clearfix"></div>
							</div>
							<p class="text-muted">2 days ago</p>
						</div>
					</div>
					<div class="media event">
						<a class="pull-left event-user-image" href="#">
							<img class="media-object img-circle" src="/img/laura.jpg" alt="Image">
						</a>
						<div class="media-body">
							<div class="event-top">
								<div class="pull-left event-icon">
									<img src="/img/icons/basic_message.svg" width="22" height="22" alt="Image">
								</div>
								<div class="pull-left">
									<a href="#">Laura</a> commented on a page <a href="#">Hell yah</a>.
								</div>
								<div class="clearfix"></div>
							</div>
							<p class="text-muted">2 days ago</p>
						</div>
					</div>
					<div class="media event">
						<a class="pull-left event-user-image" href="#">
							<img class="media-object img-circle" src="/img/elliot.jpg" alt="Image">
						</a>
						<div class="media-body">
							<div class="event-top">
								<div class="pull-left event-icon">
									<img src="/img/icons/basic_floppydisk.svg" width="22" height="22" alt="Image">
								</div>
								<div class="pull-left">
									<a href="#">Elliot</a> updated on a page <a href="#">Hell yah</a>.
								</div>
								<div class="clearfix"></div>
							</div>
							<p class="text-muted">2 days ago</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						Comments
					</div>
					<div class="panel-body wiki-comments-con">
						<div class="comments">
							<div class="comment">
								<div class="media">
									<div class="pull-left">
										<img class="media-object img-circle" src="/img/elliot.jpg" alt="Image">
									</div>
									<div class="media-body">
										<h4 class="media-heading user-name"><a href="#">Elliot</a> <small class="comment-time">Today at 9:00 pm</small></h4>
										<p>This has been very useful for my research. Thanks as well!</p>
									</div>
								</div>
							</div>
							<div class="comment">
								<div class="media">
									<div class="pull-left">
										<img class="media-object img-circle" src="/img/helen.jpg" alt="Image">
									</div>
									<div class="media-body">
										<h4 class="media-heading user-name"><a href="#">Helen</a> <small class="comment-time">Today at 10:05 pm</small></h4>
										<p>How artistic!</p>
									</div>
								</div>
							</div>
							<div class="comment">
								<div class="media">
									<div class="pull-left">
										<img class="media-object img-circle" src="/img/jenny.jpg" alt="Image">
									</div>
									<div class="media-body">
										<h4 class="media-heading user-name"><a href="#">Jenny</a> <small class="comment-time">Today at 10:05 pm</small></h4>
										<p>Elliot you are always so right :)</p>
									</div>
								</div>
							</div>
							<div class="comment">
								<div class="media">
									<div class="pull-left">
										<img class="media-object img-circle" src="/img/joe.jpg" alt="Image">
									</div>
									<div class="media-body">
										<h4 class="media-heading user-name"><a href="#">Joe</a> <small class="comment-time">Today at 10:05 pm</small></h4>
										<p>Dude, this is awesome. Thanks so much</p>
									</div>
								</div>
							</div>
							<div class="comment">
								<div class="media">
									<div class="pull-left">
										<img class="media-object img-circle" src="/img/justen.jpg" alt="Image">
									</div>
									<div class="media-body">
										<h4 class="media-heading user-name"><a href="#">Justen</a> <small class="comment-time">Today at 10:05 pm</small></h4>
										<p>Hey guys, I hope this example comment is helping you read this documentation.</p>
									</div>
								</div>
							</div>
							<div class="comment">
								<div class="media">
									<div class="pull-left">
										<img class="media-object img-circle" src="/img/laura.jpg" alt="Image">
									</div>
									<div class="media-body">
										<h4 class="media-heading user-name"><a href="#">Laura</a> <small class="comment-time">Today at 10:05 pm</small></h4>
										<p>Revolutionary!</p>
									</div>
								</div>
							</div>
							<div class="comment">
								<div class="media">
									<div class="pull-left">
										<img class="media-object img-circle" src="/img/matt.jpg" alt="Image">
									</div>
									<div class="media-body">
										<h4 class="media-heading user-name"><a href="#">Matt</a> <small class="comment-time">Today at 10:05 pm</small></h4>
										<p>This will be great for business reports. I will definitely download this.</p>
									</div>
								</div>
							</div>
						</div>
						<div class="wiki-comment-form">
							<form action="" method="POST" role="form">
								<textarea class="form-control" id="" placeholder="Write a comment"></textarea>
							</form>
						</div>
					</div>
				</div>
				<!-- <div class="panel panel-default">
					<div class="panel-heading">
						Contributors list
					</div>
					<div class="panel-body" style="padding: 15px 12px; padding-bottom: 4px;">
						<ul class="list-unstyled list-inline wiki-contributer-list">
							<li>
								<a href="#">
									<img src="/img/elliot.jpg" class="img-circle" data-toggle="tooltip" data-placement="bottom" title="Elliot (33 days ago)">
								</a>		
							</li>
							<li>
								<a href="#">
									<img src="/img/helen.jpg" class="img-circle" data-toggle="tooltip" data-placement="bottom" title="Helen (48 days ago)">
								</a>		
							</li>
							<li>
								<a href="#">
									<img src="/img/jenny.jpg" class="img-circle" data-toggle="tooltip" data-placement="bottom" title="Jenny (54 days ago)">
								</a>		
							</li>
							<li>
								<a href="#">
									<img src="/img/joe.jpg" class="img-circle" data-toggle="tooltip" data-placement="bottom" title="Joe (58 days ago)">
								</a>		
							</li>
							<li>
								<a href="#">
									<img src="/img/justen.jpg" class="img-circle" data-toggle="tooltip" data-placement="bottom" title="Justen (59 days ago)">
								</a>		
							</li>
							<li>
								<a href="#">
									<img src="/img/laura.jpg" class="img-circle" data-toggle="tooltip" data-placement="bottom" title="Laura (60 days ago)">
								</a>		
							</li>
						</ul>
					</div>
				</div> -->	
			</div>	
		</div>
	</div>
@endsection