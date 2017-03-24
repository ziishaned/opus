<div class="side-menu hidden-sm hidden-xs">
	<div class="side-menu-inner">
		<ul class="list-unstyled side-menu-top">
			<li class="nav-header">Quick Links</li>
			<li class="item {{ (Route::currentRouteName() == 'dashboard' ? 'active' : '') }}">
				<a href="{{ route('dashboard', [$team->slug]) }}">
					<i class="fa fa-history fa-fw fa-lg icon"></i>
					<span class="item-name">Activities</span>
				</a>
			</li>
			<li class="item {{ (Route::currentRouteName() == 'users.readlist' ? 'active' : '') }}">
				<a href="{{ route('users.readlist', [$team->slug, Auth::user()->slug]) }}">
					<i class="fa fa-tasks fa-fw fa-lg icon"></i>
					<span class="item-name">Read List</span>
				</a>
			</li>
			<li class="item">
				<a href="{{ route('roles.index', [$team->slug]) }}">
					<i class="fa fa-shield fa-fw fa-lg icon"></i>
					<span class="item-name">Roles</span>
				</a>
			</li>
			<li class="item">
				<a href="{{ route('teams.settings.members', [$team->slug,]) }}">
					<i class="fa fa-group fa-fw fa-lg icon"></i>
					<span class="item-name">Members</span>
				</a>
			</li>
			<li class="item">
				<a href="{{ route('teams.settings.general', [$team->slug,]) }}">
					<i class="fa fa-cog fa-fw fa-lg icon"></i>
					<span class="item-name">Team Settings</span>
				</a>
			</li>
		</ul>
		<div class="side-menu-wiki-list">
			<ul class="list-unstyled" id="categories-list">
				<li class="nav-header" style="position: relative; margin-bottom: 12px;">
					Spaces <span style="font-weight: 900; font-size: 15px;">-</span> {{ $spaces->count() }} 
					<a href="{{ route('spaces.create', [ $team->slug ]) }}" style="position: absolute; right: 10px; top: 5px; color: #9c9c9c;">
						<i class="fa fa-plus fa-fw" data-toggle="tooltip" data-placement="top" title="Create space"></i>
					</a>
				</li>
				@if($spaces->count() > 0)
					<li>
						<div class="form-group with-icon" style="margin-bottom: 5px;">
							<input type="text" class="form-control fuzzy-search" placeholder="Filter...">
							<i class="fa fa-filter icon"></i>
						</div>
					</li>
					<div class="list">
						@foreach($spaces as $item)
							<li class="item {{ isset($space) && ($space->slug === $item->slug) ? 'active' : '' }}" id="categories-list-item" data-name="{{ $item->name }}">
				                <a href="{{ route('spaces.wikis', [$team->slug, $item->slug, ]) }}">
				                    <div class="cateogry-icon" style="margin-right: 13px; position: relative; top: 1px;"></div>
									<span class="item-name">{{ $item->name }}</span>
									@if($item->wikis->count())
										<span style="color: #c1c1c1; margin-left: auto; margin-right: 2px;">{{ $item->wikis->count() }}</span>
									@endif
				                </a>
				            </li>
			           @endforeach
					</div>
		        @else
		           	<li class="text-center text-muted">
		           		<h1 class="nothing-found side" style="margin-top: 20px; "><i class="fa fa-exclamation-triangle fa-fw icon"></i> Nothing found</h1>
		           	</li>
		        @endif
			</ul>
		</div>
	</div>
</div>