<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="{{ (Route::currentRouteName() == 'teams.settings.general' ? 'active' : '') }}">
		<a href="{{ route('teams.settings.general', [$team->slug,]) }}">General</a>
	</li>
	<li role="presentation" class="{{ (Route::currentRouteName() == 'teams.settings.members' ? 'active' : '') }}">
		<a href="{{ route('teams.settings.members', [$team->slug,]) }}">Members</a>
	</li>
	<li role="presentation" class="{{ (Route::currentRouteName() == 'roles.index' || Route::currentRouteName() == 'roles.create' || Route::currentRouteName() == 'roles.edit') ? 'active' : '' }}">
		<a href="{{ route('roles.index', [$team->slug,]) }}">Roles</a>
	</li>
	<li role="presentation" class="{{ (Route::currentRouteName() == 'integrations.index' || Route::currentRouteName() == 'integrations.create' || Route::currentRouteName() == 'integrations.edit') ? 'active' : '' }}">
		<a href="{{ route('integrations.index', [$team->slug,]) }}">Slack</a>
	</li>
</ul>