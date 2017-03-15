@extends('layouts.master')

@section('content')
	@include('partials.team-side-menu')
	<div class="aside-content">
		<div class="user-profile" style="margin-top: 40px;">
			<div class="row no-container">
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 text-center">
					<div class="user-image">
						<img src="/img/no-image.png" width="180" height="180" style="border-radius: 3px;">
					</div>
					<div class="user-detail">
						<h1 class="header">John Doe</h1>
						<p class="text-muted"><i class="fa fa-envelope-o fa-fw icon"></i> john_doe@gmail.com</p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
					<div class="page-header">Activities</div>
					<div class="events-list">
						@include('user.partials.activity')
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection