<nav class="navbar navbar-default navbar-fixed-top main-menu" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>

		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li class="with-img">
					<a href="{{ route('dashboard', [ Auth::user()->getTeam()->slug ]) }}">
						@if($team->team_logo)
                            <img src="/img/avatars/{{ $team->team_logo }}" alt="" width="155" height="155" class="media-object" style="border-radius: 3px;">
                        @else
                            <img src="/img/no-image.png" alt="" width="155" height="155" class="media-object" style="border-radius: 3px;">
                        @endif
                        {{ $team->name }}
					</a>
				</li>
				<li>
					<a href="#">Wikis</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<form class="navbar-form navbar-left" role="search">
					<div class="form-group with-icon">
						<input type="text" class="form-control overall-search-input" placeholder="Search...">
						<i class="fa fa-search icon"></i>
					</div>
				</form>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-left: 0; padding-right: 0;"><i class="fa fa-plus fa-fw"></i></a>
					<ul class="dropdown-menu dropdown-menu-right" style="margin-top: -3px; margin-right: -15px;">
                        <li><a href="{{ route('wikis.create', [ $team->slug ]) }}">Create wiki</a></li>
                        <li><a href="{{ route('categories.create', [ $team->slug ]) }}">Craete category</a></li>
                    </ul>
              	</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }} <i class="fa fa-caret-down fa-fw"></i></a>
					<ul class="dropdown-menu dropdown-menu-right" style="margin-top: -3px;">
                        <li><a href="{{ route('users.show', [$team->slug, Auth::user()->slug]) }}">Profile</a></li>
                        <li>
                            <a href="{{ route('users.readlist', [$team->slug, Auth::user()->slug]) }}">Read list</a>
                        </li>
                        <li><a href="{{ route('settings.profile', [$team->slug, Auth::user()->slug]) }}">User Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('teams.settings.general', [$team->slug,]) }}">Team Settings</a></li>
                        <li><a href="{{ route('teams.settings.members', [$team->slug,]) }}">Invite user</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('logout') }}">Logout </a></li>
                    </ul>
				</li>
			</ul>
		</div>
	</div>
</nav>