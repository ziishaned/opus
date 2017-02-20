<div class="home-nav">
	<nav>
		<ul class="list-unstyled list-inline">
			<li class="{{ (Request::is('/') ? 'active' : '') }}">
				<a href="{{ route('home') }}">Home</a>
			</li>
			<li>
				<a href="#">Features</a>
			</li>
			<li>
				<a href="#">Contact Us</a>
			</li>
			<li>
				<a href="#">About Us</a>
			</li>
			<li>
				<a class="btn btn-default" href="{{ route('team.login') }}">Login</a>
			</li>
		</ul>
	</nav>
</div>