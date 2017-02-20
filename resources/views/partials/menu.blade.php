<nav class="navbar navbar-default navbar-fixed-top main-menu" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('dashboard', [ Auth::user()->team->slug ]) }}"><span>opus</span></a>
		</div>

		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav navbar-right">
				<form class="navbar-form navbar-left" role="search">
					<div class="form-group">
						<input type="text" class="form-control overall-search-input" placeholder="Search">
					</div>
				</form>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-plus fa-fw"></i></a>
					<ul class="dropdown-menu dropdown-menu-right" style="margin-top: 6px;">
                        <li><a href="{{ route('wikis.create', [ $team->slug ]) }}">Create Wiki</a></li>
                        <li><a href="{{ route('categories.create', [ $team->slug ]) }}">Create Category</a></li>
                    </ul>
              	</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="/img/no-image.png" width="no-image.png" width="40" height="40" class="img-circle"> <i class="fa fa-caret-down fa-fw"></i></a>
					<ul class="dropdown-menu dropdown-menu-right" style="margin-top: 6px;">
                        <li><a href="{{ route('users.show', [$team->slug, Auth::user()->slug]) }}"><i class="fa fa-user-o fa-fw"></i> Profile</a></li>
                        <li>
                            <a href="{{ route('users.readlist', [$team->slug, Auth::user()->slug]) }}"><i class="fa fa-newspaper-o fa-fw"></i> Read list</a>
                        </li>
                        <li><a href="{{ route('settings.profile', [$team->slug, Auth::user()->slug]) }}"><i class="fa fa-gear fa-fw"></i> User Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('teams.settings.general', [$team->slug,]) }}"><i class="fa fa-users fa-fw"></i> Team Settings</a></li>
                        <li><a href="{{ route('teams.settings.members', [$team->slug,]) }}"><i class="fa fa-envelope-o fa-fw"></i> Invite user</a></li>
                        <li class="divider"></li>
                        <li><a href="home.html"><i class="fa fa-power-off fa-fw"></i> Logout </a></li>
                    </ul>
				</li>
			</ul>
		</div>
	</div>
</nav>