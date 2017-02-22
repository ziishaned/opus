@extends('layouts.master')

@section('content')
	@include('wiki.partials.menu')
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
				@include('wiki.partials.comment')
			</div>	
		</div>
	</div>
@endsection