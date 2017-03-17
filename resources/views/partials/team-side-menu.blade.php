<div class="side-menu hidden-sm hidden-xs">
	<div class="side-menu-inner">
		<ul class="list-unstyled side-menu-top">
			<li class="nav-header">Quick Links</li>
			<li class="item {{ (Route::currentRouteName() == 'dashboard' ? 'active' : '') }}">
				<a href="dashboard.html">
					<i class="fa fa-history fa-fw fa-lg icon"></i>
					<span class="item-name">Activities</span>
				</a>
			</li>
			<li class="item">
				<a href="{{ route('teams.wikis', [$team->slug]) }}">
					<i class="fa fa-book fa-fw fa-lg icon"></i>
					<span class="item-name">Wikis</span>
				</a>
			</li>
			<li class="item">
				<a href="{{ route('wikis.create', [ $team->slug ]) }}">
					<i class="fa fa-plus fa-fw fa-lg icon"></i>
					<span class="item-name">Create Wiki</span>
				</a>
			</li>
			<li class="item">
				<a href="{{ route('users.readlist', [$team->slug, Auth::user()->slug]) }}">
					<i class="fa fa-tasks fa-fw fa-lg icon"></i>
					<span class="item-name">Read List</span>
				</a>
			</li>
			<li class="item">
				<a href="{{ route('teams.settings.members', [$team->slug,]) }}">
					<i class="fa fa-user-plus fa-fw fa-lg icon"></i>
					<span class="item-name">Invite User</span>
				</a>
			</li>
		</ul>
		<div class="side-menu-wiki-list side-menu-top">
			<ul class="list-unstyled">
				<li class="nav-header">Favourite Wikis</li>
				@if($likeWikis->count() > 0) 
					@foreach($likeWikis as $wiki)
						<li class="item">
							<a href="{{ route('wikis.show', [$team->slug, $wiki->subject->space->slug, $wiki->subject->slug]) }}">
								<i class="fa fa-book fa-fw fa-lg icon"></i> {{ $wiki->subject->name }}
							</a>
						</li>
					@endforeach
				@else
					<li class="text-center text-muted" style="margin-top: 15px; font-size: 13px;">Nothing found...</li>
				@endif
			</ul>
		</div>
	</div>
</div>