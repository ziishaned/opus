@extends('layouts.master')

@section('content')
	<div class="home-con">
        <div class="header-bg">
            @include('partials.home-nav')
            <div>
                <div style="padding: 109px 0px;" class="text-center">
                    <div style="margin-bottom: 45px;">
                        <img src="/img/white-logo.png" alt="">
                    </div>
                    <h1 style="line-height: 52px;font-size: 38px; font-weight: 700; width: 610px; margin: auto auto 24px;color: white;font-weight: 100;">Opus lets you work more collaboratively and get more done.</h1>
                    <p class="minor-text" style="font-size: 17px;width: 550px;margin: auto auto 24px;font-weight: normal;color: white;">Opus let you work more collaboratively to document who you are, what you do and how to achieve results.</p>
                    <div class="brand-buttons text-center">
                        <a href="{{ route('team.create') }}" class="btn btn-default home-head-btn">Create Team</a>
                        <a href="{{ route('team.login') }}" class="btn btn-default home-head-btn">Login Team</a>
                    </div>
                </div>
            </div>
        </div>
        <div style="padding-top: 95px; padding-bottom: 75px;" id="features">
			<div class="row no-container">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
					<h1 style="font-weight: 100; font-size: 38px; margin-bottom: 15px;">Elegant UI and so much more.</h1>
					<p style="color: rgba(0,0,0,0.55); font-size: 17px; line-height: 24px; font-weight: 400; margin: 0 0 70px; ">Check out all you can do in Opus.</p>
				</div>
			</div>
			<div class="row no-container" style="width: 1130px; margin: auto;">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 45px;">
					<div class="media">
						<div class="pull-left" style="padding-right: 20px;">
							<img src="img/icons/browser.png" class="media-object">
						</div>
						<div class="media-body">
							<h4 class="media-heading" style="margin-bottom: 10px; font-size: 16px; font-weight: 600; line-height: 26px; color: #444444;">Elegant UI</h4>
							<p style="font-size: 14px; color: #444444; line-height: 22px; font-weight: 300;">
								We have thought carefully about design so you don’t have to. You need only focus on your content, we make it look amazing
							</p>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 45px;">
					<div class="media">
						<div class="pull-left" style="padding-right: 20px;">
							<img src="img/icons/devices.png" class="media-object">
						</div>
						<div class="media-body">
							<h4 class="media-heading" style="margin-bottom: 10px; font-size: 16px; font-weight: 600; line-height: 26px; color: #444444;">Touch-Optimized</h4>
							<p style="font-size: 14px; color: #444444; line-height: 22px; font-weight: 300;">
								Opus looks stunning on desktop, tablet or phone. Our fully responsive design adjusts perfectly to fit all your devices.
							</p>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 45px;">
					<div class="media">
						<div class="pull-left" style="padding-right: 20px;">
							<img src="img/icons/lightning.png" class="media-object">
						</div>
						<div class="media-body">
							<h4 class="media-heading" style="margin-bottom: 10px; font-size: 16px; font-weight: 600; line-height: 26px; color: #444444;">Fast</h4>
							<p style="font-size: 14px; color: #444444; line-height: 22px; font-weight: 300;">
								Careful optimization of the user experience and fast performance means a low barrier for content creation and editing.
							</p>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 45px;">
					<div class="media">
						<div class="pull-left" style="padding-right: 20px;">
							<img src="img/icons/megaphone.png" class="media-object">
						</div>
						<div class="media-body">
							<h4 class="media-heading" style="margin-bottom: 10px; font-size: 16px; font-weight: 600; line-height: 26px; color: #444444;">Notifications</h4>
							<p style="font-size: 14px; color: #444444; line-height: 22px; font-weight: 300;">
								Instantly received notification when some one mention you in comment. Opus has first-class notifications out of the box.
							</p>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 45px;">
					<div class="media">
						<div class="pull-left" style="padding-right: 20px;">
							<img src="img/icons/tag.png" class="media-object">
						</div>
						<div class="media-body">
							<h4 class="media-heading" style="margin-bottom: 10px; font-size: 16px; font-weight: 600; line-height: 26px; color: #444444;">Tags</h4>
							<p style="font-size: 14px; color: #444444; line-height: 22px; font-weight: 300;">
								Tags gives you freedom to define your own structure. You can assign tags to wiki and pages.
							</p>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 45px;">
					<div class="media">
						<div class="pull-left" style="padding-right: 20px;">
							<img src="img/icons/chat.png" class="media-object">
						</div>
						<div class="media-body">
							<h4 class="media-heading" style="margin-bottom: 10px; font-size: 16px; font-weight: 600; line-height: 26px; color: #444444;">Instant Replies</h4>
							<p style="font-size: 14px; color: #444444; line-height: 22px; font-weight: 300;">
								Mention users and reply to pages to make the discussion flow. Linear discussion just got an added dimension.
							</p>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 45px;">
					<div class="media">
						<div class="pull-left" style="padding-right: 20px;">
							<img src="img/icons/shield.png" class="media-object">
						</div>
						<div class="media-body">
							<h4 class="media-heading" style="margin-bottom: 10px; font-size: 16px; font-weight: 600; line-height: 26px; color: #444444;">Powerful Permissions</h4>
							<p style="font-size: 14px; color: #444444; line-height: 22px; font-weight: 300;">
								Take control of your wikis with fine-grained permissions. Assign permissions to role for extra flexibility.
							</p>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 45px;">
					<div class="media">
						<div class="pull-left" style="padding-right: 20px;">
							<img src="img/icons/clock.png" class="media-object">
						</div>
						<div class="media-body">
							<h4 class="media-heading" style="margin-bottom: 10px; font-size: 16px; font-weight: 600; line-height: 26px; color: #444444;">Real-Time Activity</h4>
							<p style="font-size: 14px; color: #444444; line-height: 22px; font-weight: 300;">
								Every activity of a user in team is stored so you can check what a person did, where and when. 
							</p>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 38px;">
					<div class="media">
						<div class="pull-left" style="padding-right: 20px;">
							<img src="img/icons/padlock.png" class="media-object">
						</div>
						<div class="media-body">
							<h4 class="media-heading" style="margin-bottom: 10px; font-size: 16px; font-weight: 600; line-height: 26px; color: #444444;">Moderation Tools</h4>
							<p style="font-size: 14px; color: #444444; line-height: 22px; font-weight: 300;">
								Make shortcuts of important pages in wiki. Insert pages in read list and also start watching a wiki.
							</p>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 38px;">
					<div class="media">
						<div class="pull-left" style="padding-right: 20px;">
							<img src="img/icons/text.png" class="media-object">
						</div>
						<div class="media-body">
							<h4 class="media-heading" style="margin-bottom: 10px; font-size: 16px; font-weight: 600; line-height: 26px; color: #444444;">Powerful Formatting</h4>
							<p style="font-size: 14px; color: #444444; line-height: 22px; font-weight: 300;">
								Manipulate the layout of a page directly, write html and Emoji are supported out of the box, with a live preview.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
        <div class="footer" style="background: #f9f9f9; clear: both; font-size: 12px; padding-bottom: 16px; padding-top: 16px; border-top: 1px solid #cfcfcf;">
            <div style="width: 1130px; margin: auto;">
                <div class="row no-container">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <ul style="margin-bottom: 0;" class="list-inline list-unstyled">
                            <li><a href="#"><i class="fa fa-twitter fa-fw"></i> @Zeeshanu</a></li>
                            <li><a href="#"><i class="fa fa-github-alt fa-fw"></i> Opus</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                        Copyright © {{ date("Y") }} <a href="mailto:ziishaned@gmail.com" style="text-decoration: none;">Zeeshan Ahmed</a>
                    </div>
                </div>
            </div>
        </div>
	</div>
@endsection