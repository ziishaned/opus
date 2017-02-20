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
					<img src="/img/icons/basic_notebook.svg" width="24" height="24" class="icon">
					<span class="item-name">Wikis</span>
				</a>
			</li>
			<li class="item">
				<a href="{{ route('wikis.create', [ $team->slug ]) }}">
					<img src="/img/icons/basic_notebook_pen.svg" width="24" height="24" class="icon">
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
						<div class="media">
							<div class="pull-left">
								<img class="media-object" src="/img/icons/basic_book.svg" width="24" height="24" alt="Image">
							</div>
							<div class="media-body">
								<p class="wiki-name">Demonstration Space</p>
							</div>
						</div>
					</a>
				</li>
				<li class="item">
					<a href="#">
						<div class="media">
							<div class="pull-left">
								<img class="media-object" src="/img/icons/basic_book.svg" width="24" height="24" alt="Image">
							</div>
							<div class="media-body">
								<p class="wiki-name">Web QA Automation</p>
							</div>
						</div>
					</a>
				</li>
				<li class="item">
					<a href="#">
						<div class="media">
							<div class="pull-left">
								<img class="media-object" src="/img/icons/basic_book.svg" width="24" height="24" alt="Image">
							</div>
							<div class="media-body">
								<p class="wiki-name">Almosafer web</p>
							</div>
						</div>
					</a>
				</li>
				<li class="item">
					<a href="#">
						<div class="media">
							<div class="pull-left">
								<img class="media-object" src="/img/icons/basic_book.svg" width="24" height="24" alt="Image">
							</div>
							<div class="media-body">
								<p class="wiki-name">Mobile App Project</p>
							</div>
						</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>