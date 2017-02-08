@extends('layouts.app')

@section('content')
    <div class="intro">
        <div class="text-center">
            <div class="index-intro">
                <div class="brand animated bounceIn">Opus</div> 
                <div class="content">
                    <h1>Place for teams.</h1>
                    <p class="text-muted">Opus is a place for your team to document who you are, what you do and how to achieve results.</p>
                </div>
            </div>
            <div class="index-buttons">
                <a href="{{ route('organizations.join') }}" class="index-button">Join existing organization</a>
                <a href="{{ route('organizations.create') }}" class="index-button">Create organization</a>
            </div>
        </div>
    </div>
    <div class="features text-center">
        <div class="Carousel">
            <div class="CarouselItem">
                <i class="fa fa-laptop icon"></i>
                <div class="CarouselItem-label">Elegant UI</div>
            </div>
            <div class="CarouselItem">
                <i class="fa fa-mobile icon"></i>
                <div class="CarouselItem-label">Touch-Optimized</div>
            </div>
            <div class="CarouselItem">
                <i class="fa fa-flash icon"></i>
                <div class="CarouselItem-label">Fast &amp; Lightweight</div>
            </div>
            <div class="CarouselItem">
                <i class="fa fa-bell-o icon"></i>
                <div class="CarouselItem-label">Notifications</div>
            </div>
            <div class="CarouselItem">
                <i class="fa fa-tags icon"></i>
                <div class="CarouselItem-label">Tags</div>
            </div>
            <div class="CarouselItem">
                <span class="glyphicon glyphicon-comment icon"></span>
                <div class="CarouselItem-label">Instant Replies</div>
            </div>
            <div class="CarouselItem">
                <i class="fa fa-key icon"></i>
                <div class="CarouselItem-label">Powerful Permissions</div>
            </div>
            <div class="CarouselItem">
                <i class="fa fa-clock-o icon"></i>
                <div class="CarouselItem-label">Real-Time Discussion</div>
            </div>
            <div class="CarouselItem">
                <i class="fa fa-lock icon"></i>
                <div class="CarouselItem-label">Moderation Tools</div>
            </div>
            <div class="CarouselItem">
                <i class="fa fa-font icon"></i>
                <div class="CarouselItem-label">Powerful Formatting</div>
            </div>
        </div>
        <p class="features-text">
            Opus looks stunning on desktop, tablet or phone. Our fully responsive design adjusts perfectly to fit all your devices
        </p>
        <div class="index-buttons">
            <a href="{{ route('organizations.join') }}" class="index-button feature-button">See more features</a>
        </div>
    </div>
@endsection