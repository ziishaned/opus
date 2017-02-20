@extends('layouts.master')

@section('content')
	<div class="side-menu hidden-sm hidden-xs">
		<div class="side-menu-inner">
			<ul class="list-unstyled side-menu-top">
				<li class="item">
					<a href="wikis-list.html">
						<img src="/img/icons/basic_notebook.svg" width="24" height="24" class="icon">
						<span class="item-name">All wikis</span>
					</a>
				</li>
			</ul>
			<div class="side-menu-wiki-list">
				<ul class="list-unstyled">
					<li class="nav-header">All categories</li>
					<li class="item">
						<a href="#">
							<div class="media">
								<div class="pull-left">
									<div class="cateogry-icon" style="background-color: #1e88e5;"></div>
								</div>
								<div class="media-body">
									<p class="wiki-name">Demonstration Space</p>
								</div>
							</div>
						</a>
					</li>
					<li class="item">
						<a href="#">
							<div class="media">
								<div class="pull-left">
									<div class="cateogry-icon" style="background-color: #5c6bc0;"></div>
								</div>
								<div class="media-body">
									<p class="wiki-name">Web QA Automation</p>
								</div>
							</div>
						</a>
					</li>
					<li class="item">
						<a href="#">
							<div class="media">
								<div class="pull-left">
									<div class="cateogry-icon" style="background-color: #ad1457;"></div>
								</div>
								<div class="media-body">
									<p class="wiki-name">Almosafer web</p>
								</div>
							</div>
						</a>
					</li>
					<li class="item">
						<a href="#">
							<div class="media">
								<div class="pull-left">
									<div class="cateogry-icon" style="background-color: #b71c1c;"></div>
								</div>
								<div class="media-body">
									<p class="wiki-name">Mobile App Project</p>
								</div>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="aside-content">
		<div class="row no-container">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="wikis-list-inner">
					<div class="pull-left">
						<h1 class="wikis-list-header">All Wikis</h1>
					</div>
					<div class="pull-right">
						<form action="" method="POST" role="form" class="form-inline">
							<div class="form-group with-icon">
								<input type="text" class="form-control" id="" style="width: 250px;">
								<i class="fa fa-search icon"></i>
							</div>
							<button type="submit" class="btn btn-default"><i class="fa fa-filter fa-fw"></i> Filter</button>
						</form>	
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="wikis-list">
					<div class="list-group">
						<a href="#" class="list-group-item wikis-list-item">
							<div class="media">
								<div class="pull-left">
									<img class="media-object" src="/img/icons/basic_notebook.svg" alt="Image" width="34" height="34">
								</div>
								<div class="media-body">
									<h4 class="media-heading">Dingo project management</h4>
									<div class="wiki-item-heading-bottom">
										<div class="pull-left">
											<i class="fa fa-refresh fa-fw"></i> Last updated by <object><a href="#" class="person-name">Zeeshan Ahmed</a></object> about 2 hours ago
										</div>
										<div class="pull-right">
											<div class="item-category-label">Demonstration Space</div>
										</div>
										<div class="clearfix"></div>
									</div>
									<p class="wiki-item-description">A full-featured personal project management tool with task boards.</p>
								</div>
							</div>	
						</a>
						<a href="#" class="list-group-item wikis-list-item">
							<div class="media">
								<div class="pull-left">
									<img class="media-object" src="/img/icons/basic_notebook.svg" alt="Image" width="34" height="34">
								</div>
								<div class="media-body">
									<h4 class="media-heading">Git profile</h4>
									<div class="wiki-item-heading-bottom">
										<div class="pull-left">
											<i class="fa fa-refresh fa-fw"></i> Last updated by <object><a href="#" class="person-name">John Doe</a></object> about 2 hours ago
										</div>
										<div class="pull-right">
											<div class="item-category-label" style="background-color: #1e88e5;">Mobile App Project</div>
										</div>
										<div class="clearfix"></div>
									</div>
									<p class="wiki-item-description">Utility that helps you switch git configurations with ease.</p>
								</div>
							</div>	
						</a>
						<a href="#" class="list-group-item wikis-list-item">
							<div class="media">
								<div class="pull-left">
									<img class="media-object" src="/img/icons/basic_notebook.svg" alt="Image" width="34" height="34">
								</div>
								<div class="media-body">
									<h4 class="media-heading">Inspector</h4>
									<div class="wiki-item-heading-bottom">
										<div class="pull-left">
											<i class="fa fa-refresh fa-fw"></i> Last updated by <object><a href="#" class="person-name">Elloit</a></object> about 2 hours ago
										</div>
										<div class="pull-right">
											<div class="item-category-label" style="background-color: #ad1457;">Almosafer web</div>
										</div>
										<div class="clearfix"></div>
									</div>
									<p class="wiki-item-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>	
						</a>
						<a href="#" class="list-group-item wikis-list-item">
							<div class="media">
								<div class="pull-left">
									<img class="media-object" src="/img/icons/basic_notebook.svg" alt="Image" width="34" height="34">
								</div>
								<div class="media-body">
									<h4 class="media-heading">Demonstration Space</h4>
									<div class="wiki-item-heading-bottom">
										<div class="pull-left">
											<i class="fa fa-refresh fa-fw"></i> Last updated by <object><a href="#" class="person-name">Elloit</a></object> about 2 hours ago
										</div>
										<div class="pull-right">
											<div class="item-category-label" style="background-color: #1e88e5;">Web QA Automation</div>
										</div>
										<div class="clearfix"></div>
									</div>
									<p class="wiki-item-description">PHP library that fetches the social accounts, website, name, photos, employment history and other details possible for the user by their email.</p>
								</div>
							</div>	
						</a>
						<a href="#" class="list-group-item wikis-list-item">
							<div class="media">
								<div class="pull-left">
									<img class="media-object" src="/img/icons/basic_notebook.svg" alt="Image" width="34" height="34">
								</div>
								<div class="media-body">
									<h4 class="media-heading">Yell</h4>
									<div class="wiki-item-heading-bottom">
										<div class="pull-left">
											<i class="fa fa-refresh fa-fw"></i> Last updated by <object><a href="#" class="person-name">Elloit</a></object> about 2 hours ago
										</div>
										<div class="pull-right">
											<div class="item-category-label" style="background-color: #b71c1c;">Demonstration Space</div>
										</div>
										<div class="clearfix"></div>
									</div>
									<p class="wiki-item-description">PHP package to make your objects strict and throw exception when you try to access or set some undefined property in your objects.</p>
								</div>
							</div>	
						</a>
						<a href="#" class="list-group-item wikis-list-item">
							<div class="media">
								<div class="pull-left">
									<img class="media-object" src="/img/icons/basic_notebook.svg" alt="Image" width="34" height="34">
								</div>
								<div class="media-body">
									<h4 class="media-heading">Web QA Automation</h4>
									<div class="wiki-item-heading-bottom">
										<div class="pull-left">
											<i class="fa fa-refresh fa-fw"></i> Last updated by <object><a href="#" class="person-name">Elloit</a></object> about 2 hours ago
										</div>
										<div class="pull-right">
											<div class="item-category-label">Demonstration Space</div>
										</div>
										<div class="clearfix"></div>
									</div>
									<p class="wiki-item-description">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
								</div>
							</div>	
						</a>
						<a href="#" class="list-group-item wikis-list-item">
							<div class="media">
								<div class="pull-left">
									<img class="media-object" src="/img/icons/basic_notebook.svg" alt="Image" width="34" height="34">
								</div>
								<div class="media-body">
									<h4 class="media-heading">Almosafer web</h4>
									<div class="wiki-item-heading-bottom">
										<div class="pull-left">
											<i class="fa fa-refresh fa-fw"></i> Last updated by <object><a href="#" class="person-name">Elloit</a></object> about 2 hours ago
										</div>
										<div class="pull-right">
											<div class="item-category-label">Demonstration Space</div>
										</div>
										<div class="clearfix"></div>
									</div>
									<p class="wiki-item-description">Duis aute irure dolor in reprehenderit in voluptate velit esse
									cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
									proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
								</div>
							</div>	
						</a>
						<a href="#" class="list-group-item wikis-list-item">
							<div class="media">
								<div class="pull-left">
									<img class="media-object" src="/img/icons/basic_notebook.svg" alt="Image" width="34" height="34">
								</div>
								<div class="media-body">
									<h4 class="media-heading">Mobile App Project</h4>
									<div class="wiki-item-heading-bottom">
										<div class="pull-left">
											<i class="fa fa-refresh fa-fw"></i> Last updated by <object><a href="#" class="person-name">Elloit</a></object> about 2 hours ago
										</div>
										<div class="pull-right">
											<div class="item-category-label">Demonstration Space</div>
										</div>
										<div class="clearfix"></div>
									</div>
									<p class="wiki-item-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>	
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection