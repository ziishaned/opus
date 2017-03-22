@extends('layouts.master')

@section('content')
	<div class="home-con">
		@include('partials.home-nav')
		<div class="home-page brand-page-con">
			<div class="brand-intro">
				<div style="text-align: center; margin-bottom: 15px;">
					<img src="/img/logo.png"> 
				</div>
				<h1 class="brand-name">opus</h1>
				<p class="minor-text">Opus is a place for your team to document who you are, what you do and how to achieve results.</p>
				<div class="text-center brand-buttons">
					<a href="{{ route('team.create') }}" class="btn btn-success">Create Team</a>
					<a class="btn btn-default" href="{{ route('team.login') }}">Login</a>
				</div>
			</div>
			<div class="brand-img">
				<div class="browser-buttons">
					<img src="img/mac-top.png" class="browser-buttons-inner" width="54">
				</div>
				<img src="img/brand.png">
			</div>
		</div>
		<div class="features text-center">
		    <div class="Carousel">
		        <div class="CarouselItem">
		        	<img src="img/icons/software_layout_header_sideleft.svg" class="icon">
		            <div class="CarouselItem-label">Elegant UI</div>
		        </div>
		        <div class="CarouselItem">
			        <img src="img/icons/basic_smartphone.svg" class="icon">
		            <div class="CarouselItem-label">Touch-Optimized</div>
		        </div>
		        <div class="CarouselItem">
		            <img src="img/icons/basic_bolt.svg" class="icon">
		            <div class="CarouselItem-label">Fast</div>
		        </div>
		        <div class="CarouselItem">
		            <img src="img/icons/basic_info.svg" class="icon">
		            <div class="CarouselItem-label">Notifications</div>
		        </div>
		        <div class="CarouselItem">
		            <img src="img/icons/ecommerce_sales.svg" class="icon">
		            <div class="CarouselItem-label">Tags</div>
		        </div>
		        <div class="CarouselItem">
		            <img src="img/icons/basic_message_multiple.svg" class="icon">
		            <div class="CarouselItem-label">Instant Replies</div>
		        </div>
		        <div class="CarouselItem">
		            <img src="img/icons/basic_key.svg" class="icon">
		            <div class="CarouselItem-label">Powerful Permissions</div>
		        </div>
		        <div class="CarouselItem">
		            <img src="img/icons/basic_clockwise.svg" class="icon">
		            <div class="CarouselItem-label">Real-Time Discussion</div>
		        </div>
		        <div class="CarouselItem">
		            <img src="img/icons/basic_lock.svg" class="icon">
		            <div class="CarouselItem-label">Moderation Tools</div>
		        </div>
		        <div class="CarouselItem">
		            <img src="img/icons/software_font_smallcaps.svg" class="icon">
		            <div class="CarouselItem-label">Powerful Formatting</div>
		        </div>
		    </div>
		    <p class="features-text">
		        Opus looks stunning on desktop, tablet or phone. Our fully responsive design adjusts perfectly to fit all your devices
		    </p>
	        <a href="#" class="btn more-feature-button">See more features</a>
		</div>
	</div>
@endsection