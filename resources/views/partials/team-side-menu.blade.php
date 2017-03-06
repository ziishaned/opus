<div class="side-menu hidden-sm hidden-xs">
	<div class="side-menu-inner">
		<ul class="list-unstyled side-menu-top">
			<li class="nav-header">Quick Links</li>
			<li class="item active">
				<a href="dashboard.html">
					<img src="/img/icons/basic_home.svg" width="24" height="24" class="icon">
					<span class="item-name">Home</span>
				</a>
			</li>
			<li class="item">
				<a href="{{ route('teams.wikis', [$team->slug]) }}">
					<img src="/img/icons/basic_book.svg" width="24" height="24" class="icon">
					<span class="item-name">Wikis</span>
				</a>
			</li>
			<li class="item">
				<a href="{{ route('wikis.create', [ $team->slug ]) }}">
					<img src="/img/icons/basic_book_pencil.svg" width="24" height="24" class="icon">
					<span class="item-name">Create Wiki</span>
				</a>
			</li>
			<li class="item">
				<a href="{{ route('users.readlist', [$team->slug, Auth::user()->slug]) }}">
					<img src="/img/icons/basic_todo_txt.svg" width="24" height="24" class="icon">
					<span class="item-name">Read List</span>
				</a>
			</li>
			<li class="item">
				<a href="{{ route('teams.settings.members', [$team->slug,]) }}">
					<img src="/img/icons/basic_mail.svg" width="24" height="24" class="icon">
					<span class="item-name">Invite User</span>
				</a>
			</li>
		</ul>
		<div class="side-menu-wiki-list">
			<ul class="list-unstyled">
				<li class="nav-header">Favourite Wikis</li>
				<li class="item">
					<a href="#">
						<img src="/img/icons/basic_book.svg" width="20" height="20" alt="Image" style="margin-right: 12px;"> <span style="position: relative; top: -2px;">Demonstration Space</span>
					</a>
				</li>
				<li class="item">
					<a href="#">
						<img src="/img/icons/basic_book.svg" width="20" height="20" alt="Image" style="margin-right: 12px;"> <span style="position: relative; top: -2px;">Web QA Automation</span>
					</a>
				</li>
				<li class="item">
					<a href="#">
						<img src="/img/icons/basic_book.svg" width="20" height="20" alt="Image" style="margin-right: 12px;"> <span style="position: relative; top: -2px;">Almosafer web</span>
					</a>
				</li>
				<li class="item">
					<a href="#">
						<img src="/img/icons/basic_book.svg" width="20" height="20" alt="Image" style="margin-right: 12px;"> <span style="position: relative; top: -2px;">Mobile App Project</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>