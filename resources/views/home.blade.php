@extends('layouts.master')

@section('content')
	<div class="home-con">
		@include('partials.home-nav')
		<div class="home-page brand-page-con">
			<div class="brand-intro text-center">
				<p style="margin-bottom: 38px;">
					<img src="/img/home-logo.png" width="147">
				</p>
				<h1 style="margin-bottom: 24px;">A place for teams.</h1>
				<p class="minor-text" style="margin-bottom: 30px;">Opus is a place for your team to document who you are, what you do and how to achieve results.</p>
				<div class="brand-buttons">
					<a href="{{ route('team.create') }}" class="btn btn-default home-head-btn">Create Team</a>
					<a href="{{ route('team.login') }}" class="btn btn-default home-head-btn">Login Team</a>
				</div>
			</div>
			<div class="brand-img">
				<img src="img/brand.png" style="border-radius: 5px; box-shadow: 0px 1px 8px #b3b3b3; ">
			</div>
		</div>
		<div style="padding-top: 45px; padding-bottom: 45px;" id="features">
			<div class="row no-container" style="width: 1130px; margin: auto;">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="text-center" style="margin-bottom: 55px; margin-top: 30px;">
						<h1 style="width: 100%; border-bottom: 1px solid #000; line-height: 0.1em; margin: 10px 0 26px; font-size: 28px;"><span style="background:#fff; padding:0 10px;">Features<span></h1>
						<p style="font-size: 16px; margin-bottom: 12px;">Opus is packed full of innovation, all wrapped up in a beautiful design. This isn't just a nice skin.</p>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 45px;">
					<div class="media">
						<div class="pull-left" style="padding-right: 20px;">
							<img src="img/icons/software_layout_header_sideleft.svg" class="media-object">
						</div>
						<div class="media-body">
							<h4 class="media-heading">Elegant UI</h4>
							<p>Opus looks and feels great out of the box. The user interface is streamlined so you can spend less time clicking and more productive.</p>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 45px;">
					<div class="media">
						<div class="pull-left" style="padding-right: 20px;">
							<img src="img/icons/basic_smartphone.svg" class="media-object">
						</div>
						<div class="media-body">
							<h4 class="media-heading">Touch-Optimized</h4>
							<p>Opus looks and feels great out of the box. The user interface is streamlined so you can spend less time clicking and more time talking.</p>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 45px;">
					<div class="media">
						<div class="pull-left" style="padding-right: 20px;">
							<img src="img/icons/basic_bolt.svg" class="media-object">
						</div>
						<div class="media-body">
							<h4 class="media-heading">Fast</h4>
							<p>Opus looks and feels great out of the box. The user interface is streamlined so you can spend less time clicking and more time talking.</p>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 45px;">
					<div class="media">
						<div class="pull-left" style="padding-right: 20px;">
							<img src="img/icons/basic_info.svg" class="media-object">
						</div>
						<div class="media-body">
							<h4 class="media-heading">Notifications</h4>
							<p>Opus looks and feels great out of the box. The user interface is streamlined so you can spend less time clicking and more time talking.</p>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 45px;">
					<div class="media">
						<div class="pull-left" style="padding-right: 20px;">
							<img src="img/icons/ecommerce_sales.svg" class="media-object">
						</div>
						<div class="media-body">
							<h4 class="media-heading">Tags</h4>
							<p>Opus looks and feels great out of the box. The user interface is streamlined so you can spend less time clicking and more time talking.</p>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 45px;">
					<div class="media">
						<div class="pull-left" style="padding-right: 20px;">
							<img src="img/icons/basic_message_multiple.svg" class="media-object">
						</div>
						<div class="media-body">
							<h4 class="media-heading">Instant Replies</h4>
							<p>Opus looks and feels great out of the box. The user interface is streamlined so you can spend less time clicking and more time talking.</p>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 45px;">
					<div class="media">
						<div class="pull-left" style="padding-right: 20px;">
							<img src="img/icons/basic_key.svg" class="media-object">
						</div>
						<div class="media-body">
							<h4 class="media-heading">Powerful Permissions</h4>
							<p>Opus looks and feels great out of the box. The user interface is streamlined so you can spend less time clicking and more time talking.</p>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 45px;">
					<div class="media">
						<div class="pull-left" style="padding-right: 20px;">
							<img src="img/icons/basic_clockwise.svg" class="media-object">
						</div>
						<div class="media-body">
							<h4 class="media-heading">Real-Time Discussion</h4>
							<p>Opus looks and feels great out of the box. The user interface is streamlined so you can spend less time clicking and more time talking.</p>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 38px;">
					<div class="media">
						<div class="pull-left" style="padding-right: 20px;">
							<img src="img/icons/basic_lock.svg" class="media-object">
						</div>
						<div class="media-body">
							<h4 class="media-heading">Moderation Tools</h4>
							<p>Opus looks and feels great out of the box. The user interface is streamlined so you can spend less time clicking and more time talking.</p>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 38px;">
					<div class="media">
						<div class="pull-left" style="padding-right: 20px;">
							<img src="img/icons/software_font_smallcaps.svg" class="media-object">
						</div>
						<div class="media-body">
							<h4 class="media-heading">Powerful Formatting</h4>
							<p>Opus looks and feels great out of the box. The user interface is streamlined so you can spend less time clicking and more time talking.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="about-us" style="margin-bottom: 45px;">
			<div class="row no-container text-center" style="width: 1130px; margin: auto;">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="text-center" style="margin-bottom: 30px;">
						<h1 style="width: 100%; border-bottom: 1px solid #000; line-height: 0.1em; margin: 10px 0 25px; font-size: 28px;"><span style="background:#fff; padding:0 10px;">About Us<span></h1>
						<p style="font-size: 18px; margin-bottom: 12px; width: 695px; margin: auto;">
							We're a couple of passionate software developers.
						</p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<ul class="list-unstyled list-inline">
						<li style="padding-right: 13px; padding-left: 13px;">
							<img src="/img/zeeshan.jpg" class="img-circle" width="134" height="134" style="margin-bottom: 10px">
							<h3 style="font-size: 21px; margin-bottom: 3px;">Zeeshan Ahmed</h3>
							<p style="margin-bottom: 8px;"><a href="mailto:ziishaned@gmail.com">ziishaned@gmail.com</a></p>
							<ul class="list-unstyled list-inline" style="margin-bottom: 0;">
								<li>
									<a href="https://github.com/zeeshanu"><img src="/img/github.ico" width="22" height="22"></a>
								</li>
								<li>
									<a href="https://twitter.com/ziishaned"><img src="/img/twitter.ico" width="22" height="22"></a>
								</li>
							</ul>
						</li>
						<li style="padding-right: 13px; padding-left: 13px;">
							<img src="/img/adnan.jpg" class="img-circle" width="134" height="134" style="margin-bottom: 10px">
							<h3 style="font-size: 21px; margin-bottom: 3px;">Adnan Ahmed</h3>
							<p style="margin-bottom: 8px;"><a href="mailto:mahradnan@hotmail.com">mahradnan@hotmail.com</a></p>
							<ul class="list-unstyled list-inline" style="margin-bottom: 0;">
								<li>
									<a href="https://github.com/idnan"><img src="/img/github.ico" width="22" height="22"></a>
								</li>
								<li>
									<a href="https://twitter.com/idnan_se"><img src="/img/twitter.ico" width="22" height="22"></a>
								</li>
							</ul>
						</li>
						<li style="padding-right: 13px; padding-left: 13px;">
							<img src="/img/kamran.jpg" class="img-circle" width="134" height="134" style="margin-bottom: 10px">
							<h3 style="font-size: 21px; margin-bottom: 3px;">Kamran Ahmed</h3>
							<p style="margin-bottom: 8px;"><a href="mailto:kamranahmed.se@gmail.com">kamranahmed.se@gmail.com</a></p>
							<ul class="list-unstyled list-inline" style="margin-bottom: 0;">
								<li>
									<a href="https://github.com/kamranahmedse"><img src="/img/github.ico" width="22" height="22"></a>
								</li>
								<li>
									<a href="https://twitter.com/kamranahmedse"><img src="/img/twitter.ico" width="22" height="22"></a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div style="background: #404041; padding: 50px 0; color: #f7f5ef;">
			<div class="row no-container"  style="width: 1130px; margin: auto;">
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					<ul class="list-unstyled">
						<li style="font-size: 20px; margin-bottom: 20px; font-weight: 500;">Product</li>
						<li>
							<a href="#features" style="text-decoration: none; color: #c5dae6; display: block; margin-bottom: 10px; line-height: 140%; font-size: 15px;">Features</a>
						</li>
						<li>
							<a href="#" style="text-decoration: none; color: #c5dae6; display: block; margin-bottom: 10px; line-height: 140%; font-size: 15px;">About Us</a>
						</li>
					</ul>
				</div>
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					<ul class="list-unstyled">
						<li style="font-size: 20px; margin-bottom: 20px; font-weight: 500;">Social</li>
						<li>
							<a href="#features" style="text-decoration: none; color: #c5dae6; display: block; margin-bottom: 10px; line-height: 140%; font-size: 15px;">Twitter</a>
						</li>
						<li>
							<a href="#" style="text-decoration: none; color: #c5dae6; display: block; margin-bottom: 10px; line-height: 140%; font-size: 15px;">Github</a>
						</li>
						<li>
							<a href="#" style="text-decoration: none; color: #c5dae6; display: block; margin-bottom: 10px; line-height: 140%; font-size: 15px;">Contact Us</a>
						</li>
					</ul>
				</div>
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-4 col-lg-offset-4 text-center">
					<div>
						<img src="/img/fotter-logo.png" width="88" style="margin-bottom: 15px;">
						<p>Copyright © 2015 <a href="mailto:ziishaned@gmail.com" style="color: #fff; text-decoration: none;">Zeeshan Ahmed</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection