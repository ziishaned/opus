@extends('layouts.master')

@section('content')
	<div class="side-menu hidden-sm hidden-xs">
		<div class="side-menu-inner">
			<ul class="list-unstyled side-menu-top">
				<li class="item active">
					<a href="read-list.html">
						<img src="/img/icons/basic_todo_txt.svg" width="24" height="24" class="icon">
						<span class="item-name">Read List</span>
					</a>
				</li>
				<li class="item">
					<a href="read-list.html">
						<img src="/img/icons/basic_trashcan.svg" width="24" height="24" class="icon">
						<span class="item-name">Trash</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="aside-content">
		<div class="row no-container">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row">
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
						<div class="panel panel-default">
							<div class="panel-heading v-center">
								<div class="pull-left" style="width: 100%;">
									<h5>Read List</h5>
								</div>
								<div class="pull-right" style="width: 100%; text-align: right;">
									<div class="btn-group dropdown"> 
										<button type="button" class="btn btn-default"><i class="fa fa-filter fa-fw"></i> Filter</button> 
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
											<span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> 
										</button> 
										<ul class="dropdown-menu dropdown-menu-right white-pointer" style="margin-top: 6px;"> 
											<li><a href="#"><i class="fa fa-th-list fa-fw"></i> Show all</a></li>
											<li><a href="#"><i class="fa fa-eye fa-fw"></i> Read only</a></li>
											<li><a href="#"><i class="fa fa-eye-slash fa-fw"></i> Unread only</a></li> 
										</ul> 
									</div>	
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-body read-list-con">
								<div class="list-group" style="margin-bottom: 0;">
									<a href="#" class="list-group-item read-list-item">
										<div class="media v-center">
											<div class="pull-left" style="width: 100%;">
												<h4 class="item-name">Demonstration Wiki</h4>
												<p class="text-muted item-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
											</div>
											<div class="pull-right">
												<div class="icon">
													<span class="glyphicon glyphicon-chevron-right"></span>
												</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item read-list-item">
										<div class="media v-center">
											<div class="pull-left" style="width: 100%;">
												<h4 class="item-name">Media heading</h4>
												<p class="text-muted item-description">Text goes here...</p>
											</div>
											<div class="pull-right">
												<div class="icon">
													<span class="glyphicon glyphicon-chevron-right"></span>
												</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item read-list-item">
										<div class="media v-center">
											<div class="pull-left" style="width: 100%;">
												<h4 class="item-name">Media heading</h4>
												<p class="text-muted item-description">Text goes here...</p>
											</div>
											<div class="pull-right">
												<div class="icon">
													<span class="glyphicon glyphicon-chevron-right"></span>
												</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item active read-list-item">
										<div class="media v-center">
											<div class="pull-left" style="width: 100%;">
												<h4 class="item-name">Web QA Automation</h4>
												<p class="text-muted item-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
											</div>
											<div class="pull-right">
												<div class="icon">
													<span class="glyphicon glyphicon-chevron-right"></span>
												</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item read-list-item">
										<div class="media v-center">
											<div class="pull-left" style="width: 100%;">
												<h4 class="item-name">Almosafer web</h4>
												<p class="text-muted item-description">Text goes here...</p>
											</div>
											<div class="pull-right">
												<div class="icon">
													<span class="glyphicon glyphicon-chevron-right"></span>
												</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item read-list-item">
										<div class="media v-center">
											<div class="pull-left" style="width: 100%;">
												<h4 class="item-name">Mobile App Project</h4>
												<p class="text-muted item-description">Text goes here...</p>
											</div>
											<div class="pull-right">
												<div class="icon">
													<span class="glyphicon glyphicon-chevron-right"></span>
												</div>
											</div>
										</div>
									</a>

								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
						<div class="panel panel-default">
							<div class="panel-heading v-center">
								<div class="pull-left" style="width: 100%;">
									<h5>
										<a href="#">Demonstration Wiki</a>
									</h5>
								</div>
								<div class="pull-right" style="width: 100%; text-align: right;">
									<div class="btn-group">
										<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Remove"><i class="fa fa-trash-o"></i></button>
										<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Read"><i class="fa fa-eye"></i></button>
										<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Unread"><i class="fa fa-eye-slash"></i></button>
									</div>	
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-body read-list-item-detail">
								<ul class="list-group">
									<li class="list-group-item">
										<p>Title</p>
										<h5>
											<a href="#">Demonstration Wiki</a>
										</h5>
									</li>
									<li class="list-group-item">
										<p>Added date</p>
										<h5>08/09/2017 at 9:00 pm</h5>
									</li>
									<li class="list-group-item">
										<p>Created by</p>
										<h5>John Doe</h5>
									</li>
									<li class="list-group-item">
										<p>Last updated</p>
										<h5>23/01/2017 at 10:34 pm</h5>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection