<div class="home-nav">
	<nav>
		<ul class="list-unstyled list-inline">
			<li class="{{ (Request::is('/') ? 'active' : '') }}">
				<a href="{{ route('home') }}">Home</a>
			</li>
			<li>
				<a href="#features">Features</a>
			</li>
			<li>
				<a href="#about-us">About Us</a>
			</li>
			<li>
				<a href="#">Contact Us</a>
			</li>
		</ul>
	</nav>
</div>