@extends('layouts.master')

@section('content')
	<div class="user-profile">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
				<div class="user-image">
					<img src="/img/no-image.png" width="180" height="180" style="border-radius: 3px;">
				</div>
				<div class="user-detail">
					<h1 class="header">John Doe</h1>
					<p class="text-muted"><i class="fa fa-envelope-o fa-fw icon"></i> john_doe@gmail.com</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<div class="page-header"><img src="/img/icons/basic_rss.svg" width="24" height="24" style="position: relative; top: -5px; margin-right: 10px;"> All activities</div>
				<div class="events-list">
					@include('user.partials.activity')
				</div>
			</div>
		</div>
	</div>
@endsection