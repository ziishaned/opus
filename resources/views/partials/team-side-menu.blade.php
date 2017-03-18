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
				<a href="{{ route('users.readlist', [$team->slug, Auth::user()->slug]) }}">
					<i class="fa fa-tasks fa-fw fa-lg icon"></i>
					<span class="item-name">Read List</span>
				</a>
			</li>
			<li class="item">
				<a href="{{ route('users.readlist', [$team->slug, Auth::user()->slug]) }}">
					<i class="fa fa-shield fa-fw fa-lg icon"></i>
					<span class="item-name">Roles</span>
				</a>
			</li>
			<li class="item">
				<a href="{{ route('users.readlist', [$team->slug, Auth::user()->slug]) }}">
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
				<li>
					<div class="form-group with-icon" style="margin-bottom: 5px;">
						<input type="text" class="form-control fuzzy-search overall-search-input" placeholder="Filter...">
						<i class="fa fa-filter icon"></i>
					</div>
				</li>
				@if($spaces->count() > 0)
					<div class="list">
						@foreach($spaces as $space)
							<li class="item" id="categories-list-item" data-name="{{ $space->name }}">
				                <a href="{{ route('spaces.wikis', [$team->slug, $space->slug, ]) }}">
				                    <div class="cateogry-icon" style="margin-right: 13px; position: relative; top: 1px;"></div>
									<span class="item-name">{{ $space->name }}</span>
									@if($space->wikis->count())
										<span style="color: #c1c1c1; margin-left: auto; margin-right: 2px;">{{ $space->wikis->count() }}</span>
									@endif
				                </a>
				            </li>
			           @endforeach
					</div>
		        @else
		           <li class="text-center text-muted" style="margin-top: 15px; font-size: 13px;">Nothing found...</li>
		        @endif
			</ul>
		</div>
	</div>
</div>