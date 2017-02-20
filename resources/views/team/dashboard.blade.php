@extends('layouts.master')

@section('content')
	@include('partials.team-side-menu')
	<div class="aside-content">
		<div class="row no-container">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<div class="page-header">All activities</div>
				@if($activities->count() > 0)
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
					</div>
				@else 
					<h1 class="nothing-found"><img src="/img/icons/basic_info.svg" width="44"> No activity found</h1>
				@endif
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						Recent Wikis
					</div>
					<div class="panel-body" style="padding: 15px 0px">
						@if($wikis->count() > 0)
							<ul class="list-unstyled recent-wikis-list">
								<li class="item">
									<a href="#">
										<div class="media">
											<div class="pull-left">
												<img class="media-object" src="/img/icons/basic_book.svg" width="24" height="24" alt="Image">
											</div>
											<div class="media-body">
												<p class="wiki-name">Demonstration Space</p>
											</div>
										</div>
									</a>
								</li>
							</ul>
						@else 
							<h1 class="nothing-found side">No recent wikis</h1>
						@endif
					</div>
				</div>	
			</div>
		</div>
	</div>
@endsection