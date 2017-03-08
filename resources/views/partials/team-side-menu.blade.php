<div class="side-menu hidden-sm hidden-xs">
	<div class="side-menu-inner">
		<ul class="list-unstyled side-menu-top">
			<li class="nav-header">Quick Links</li>
			<li class="item active">
				<a href="dashboard.html">
					<img src="/img/icons/basic_rss.svg" width="20" height="20" class="icon">
					<span class="item-name">Activities</span>
				</a>
			</li>
			<li class="item">
				<a href="{{ route('teams.wikis', [$team->slug]) }}">
					<img src="/img/icons/basic_book.svg" width="20" height="20" class="icon">
					<span class="item-name">Wikis</span>
				</a>
			</li>
			<li class="item">
				<a href="{{ route('wikis.create', [ $team->slug ]) }}">
					<img src="/img/icons/basic_book_pencil.svg" width="20" height="20" class="icon">
					<span class="item-name">Create Wiki</span>
				</a>
			</li>
			<li class="item">
				<a href="{{ route('users.readlist', [$team->slug, Auth::user()->slug]) }}">
					<img src="/img/icons/basic_todo_txt.svg" width="20" height="20" class="icon">
					<span class="item-name">Read List</span>
				</a>
			</li>
			<li class="item">
				<a href="{{ route('teams.settings.members', [$team->slug,]) }}">
					<img src="/img/icons/basic_mail.svg" width="20" height="20" class="icon">
					<span class="item-name">Invite User</span>
				</a>
			</li>
		</ul>
		<div class="side-menu-wiki-list">
			<ul class="list-unstyled">
				<li class="nav-header">Favourite Wikis</li>
				@if($likeWikis->count() > 0) 
					@foreach($likeWikis as $wiki)
						<li class="item">
							<a href="{{ route('wikis.show', [$team->slug, $wiki->subject->category->slug, $wiki->subject->slug]) }}">
								<img src="/img/icons/basic_book.svg" width="20" height="20" alt="Image" style="margin-right: 12px;"> <span style="position: relative; top: -2px;">{{ $wiki->subject->name }}</span>
							</a>
						</li>
					@endforeach
				@else
					<li class="text-center text-muted" style="margin-top: 5px; font-size: 13px;">Nothing found...</li>
				@endif
			</ul>
		</div>
	</div>
</div>