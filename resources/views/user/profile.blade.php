@extends('layouts.master')

@section('content')
	@include('partials.team-side-menu')
	<div class="aside-content">
		<div class="user-profile" style="margin-top: 40px;">
			<div class="row no-container">
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 text-center">
					<div data-spy="affix" data-offset-top="1">
						<div class="user-image">
							@if(!empty($user->profile_image)) 
	                            <img src="/img/avatars/{{ $user->profile_image }}" alt="Image" width="180" height="180" style="border-radius: 3px;">
	                        @else
	                            <img src="/img/no-image.png" alt="Image" width="180" height="180" style="border-radius: 3px;">
	                        @endif
						</div>
						<div class="user-detail">
							<h1 class="header">{{ $user->first_name . ' ' . $user->last_name }}</h1>
							<p class="text-muted"><i class="fa fa-envelope-o fa-fw icon"></i> {{  $user->email }}</p>
						</div>
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