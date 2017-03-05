<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="{{ (Route::currentRouteName() == 'teams.settings.general' ? 'active' : '') }}">
		<a href="{{ route('teams.settings.general', [$team->slug,]) }}">General</a>
	</li>
	<li role="presentation" class="{{ (Route::currentRouteName() == 'teams.settings.members' ? 'active' : '') }}">
		<a href="{{ route('teams.settings.members', [$team->slug,]) }}">Members</a>
	</li>
	<li role="presentation" class="{{ (Route::currentRouteName() == 'teams.settings.groups' || Route::currentRouteName() == 'groups.create' || Route::currentRouteName() == 'groups.edit') ? 'active' : '' }}">
		<a href="{{ route('teams.settings.groups', [$team->slug,]) }}">Groups</a>
	</li>
</ul>