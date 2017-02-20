@extends('layouts.master')

@section('content')
	<div class="user-profile">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
				<div class="user-image">
					<img src="/img/no-image.png" class="img-circle" width="180" height="180">
				</div>
				<div class="user-detail">
					<h1 class="header">John Doe</h1>
					<p class="text-muted"><i class="fa fa-envelope-o fa-fw icon"></i> john_doe@gmail.com</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<div class="page-header">All activities</div>
				<div class="events-list">
					<div class="media event">
						<a class="pull-left event-user-image" href="#">
							<img class="media-object img-circle" src="/img/no-image.png" alt="Image" width="50" height="50">
						</a>
						<div class="media-body">
							<div class="event-top">
								<div class="pull-left event-icon">
									<img src="/img/icons/basic_message.svg" width="22" height="22" alt="Image">
								</div>
								<div class="pull-left">
									<a href="#">You</a> commented on a page <a href="#">Hell yah</a>.
								</div>
								<div class="clearfix"></div>
							</div>
							<p class="text-muted">2 days ago</p>
						</div>
					</div>
					<div class="media event">
						<a class="pull-left event-user-image" href="#">
							<img class="media-object img-circle" src="/img/no-image.png" alt="Image" width="50" height="50">
						</a>
						<div class="media-body">
							<div class="event-top">
								<div class="pull-left event-icon">
									<img src="/img/icons/basic_webpage_txt.svg" width="22" height="22" alt="Image">
								</div>
								<div class="pull-left">
									<a href="#">You</a> created on a page <a href="#">How to install</a>.
								</div>
								<div class="clearfix"></div>
							</div>
							<p class="text-muted">2 days ago</p>
						</div>
					</div>
					<div class="media event">
						<a class="pull-left event-user-image" href="#">
							<img class="media-object img-circle" src="/img/no-image.png" alt="Image" width="50" height="50">
						</a>
						<div class="media-body">
							<div class="event-top">
								<div class="pull-left event-icon">
									<img src="/img/icons/basic_trashcan.svg" width="22" height="22" alt="Image">
								</div>
								<div class="pull-left">
									<a href="#">You</a> deleted a wiki <a href="#">Demonstration Wiki</a>.
								</div>
								<div class="clearfix"></div>
							</div>
							<p class="text-muted">2 days ago</p>
						</div>
					</div>
					<div class="media event">
						<a class="pull-left event-user-image" href="#">
							<img class="media-object img-circle" src="/img/no-image.png" alt="Image" width="50" height="50">
						</a>
						<div class="media-body">
							<div class="event-top">
								<div class="pull-left event-icon">
									<img src="/img/icons/basic_notebook.svg" width="22" height="22" alt="Image">
								</div>
								<div class="pull-left">
									<a href="#">You</a> create a wiki <a href="#">Hell yah</a>.
								</div>
								<div class="clearfix"></div>
							</div>
							<p class="text-muted">2 days ago</p>
						</div>
					</div>
					<div class="media event">
						<a class="pull-left event-user-image" href="#">
							<img class="media-object img-circle" src="/img/no-image.png" alt="Image" width="50" height="50">
						</a>
						<div class="media-body">
							<div class="event-top">
								<div class="pull-left event-icon">
									<img src="/img/icons/basic_message.svg" width="22" height="22" alt="Image">
								</div>
								<div class="pull-left">
									<a href="#">You</a> commented on a page <a href="#">Hell yah</a>.
								</div>
								<div class="clearfix"></div>
							</div>
							<p class="text-muted">2 days ago</p>
						</div>
					</div>
					<div class="media event">
						<a class="pull-left event-user-image" href="#">
							<img class="media-object img-circle" src="/img/no-image.png" alt="Image" width="50" height="50">
						</a>
						<div class="media-body">
							<div class="event-top">
								<div class="pull-left event-icon">
									<img src="/img/icons/basic_floppydisk.svg" width="22" height="22" alt="Image">
								</div>
								<div class="pull-left">
									<a href="#">You</a> updated on a page <a href="#">Hell yah</a>.
								</div>
								<div class="clearfix"></div>
							</div>
							<p class="text-muted">2 days ago</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection