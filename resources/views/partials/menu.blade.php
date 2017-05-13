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
					<a href="{{ route('dashboard', [ Auth::user()->getTeam()->slug ]) }}" style="font-size: 13px;">
						@if($team->team_logo)
                            <img src="/img/avatars/{{ $team->team_logo }}" alt="" width="155" height="155" class="media-object" style="border-radius: 3px;">
                        @else
                            <img src="/img/no-image.png" alt="" width="155" height="155" class="media-object" style="border-radius: 3px;">
                        @endif
                        {{ $team->name }}
					</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<form class="navbar-form navbar-left dropdown" role="search">
					<div class="form-group with-icon dropdown-toggle" data-toggle="dropdown" >
						<input type="text" class="form-control overall-search-input" placeholder="Search...">
						<i class="fa fa-search icon"></i>
					</div>
					<ul class="dropdown-menu dropdown-menu-right" id="overall-search-output" onClick="event.stopPropagation();" style="margin-top: 4px; margin-right: 15px; width: 250px; padding: 4px 5px; max-height: 250px; overflow: auto;">
                   		<li style="font-style: italic; text-align: center; font-size: 13px;">Type something.</li>
                    </ul>
				</form>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-right: 9px; padding-left: 9px;"><i class="fa fa-plus fa-fw"></i></a>
					<ul class="dropdown-menu dropdown-menu-right" style="margin-top: -3px; margin-right: -6px; margin-top: -3px; padding: 4px 5px;">
                        <li><a href="{{ route('wikis.create', [ $team->slug ]) }}" style="padding: 5px 6px;">Create wiki</a></li>
                        <li><a href="{{ route('spaces.create', [ $team->slug ]) }}" style="padding: 5px 6px;">Create space</a></li>
                        <li class="divider" style="margin: 0px;"></li>
                        <li><a href="{{ route('teams.settings.members', [$team->slug,]) }}" style="padding: 5px 6px;">Invite user</a></li>
                    </ul>
              	</li>
              	<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-right: 9px; padding-left: 9px; position: relative;">
						<i class="fa fa-bell fa-fw"></i>
						@if($notifications->count() > 0)
							<span class="unread-notification" style="background-color: #03A9F4; height: 11px; width: 11px; display: inline-block; border-radius: 50%; position: absolute; top: 13px; right: 8px; border: 2px solid #fbfbfb;"></span>
						@endif
					</a>
					<div class="dropdown-menu dropdown-menu-right" onClick="event.stopPropagation();" style="margin-top: -3px; margin-right: -6px; width: 420px; padding: 0;">
                        <div class="menu-notifications">
                        	<div class="notification-head" style="padding: 12px 15px;">
                        		<div class="pull-left" style="height: 18px; display: flex; align-items: center;">
                        			<h2 style="font-size: 12px; color: #777;">Notifications</h2>
                        		</div>
                        		<div class="pull-right" style="height: 18px; display: flex; align-items: center;">
                        			@if($notifications->count() > 0)
	                        			<a href="{{ route('notifications.readall', [$team->slug, Auth::user()->slug]) }}"><i class="fa fa-eye fa-fw icon" data-toggle="tooltip" data-position="top" title="Mark all as read"></i></a>
	                        		@endif
                        		</div>
                        		<div class="clearfix"></div>
                        	</div>
                        	<div class="notification-body" style="max-height: 260px; overflow: auto; margin-bottom: 15px;">
                        		@if($notifications->count() > 0)
                        			<ul class="list-unstyled notifications-list" style="margin-bottom: 0;">
	                        			@foreach($notifications as $notification)
	                        				<li>
	                        					<a href="{{ $notification->url }}">
			                        				<div class="media">
			                        				    <div class="pull-left event-user-image" href="">
				                        				    <?php $user_image = \App\Models\User::find($notification->from_id)->profile_image; ?>
				                        				    @if($user_image)
										                        <img class="media-object" style="border-radius: 3px;" src="/img/avatars/{{ $user_image }}" width="42" height="42" alt="Image">
										                    @else
										                        <img class="media-object" style="border-radius: 3px;" src="/img/no-image.png" width="44" height="44" alt="Image">
										                    @endif
			                        				    </div>
			                        				    <div class="media-body">
		                    				                <div class="pull-left event-icon" style="margin-right: 7px;">
											                    <?php $notificationCategory = $notification->category->name; ?>
											                    @if($notificationCategory === 'wiki.updated' || $notificationCategory === 'page.updated') 
																	<i class="fa fa-save fa-fw fa-lg icon"></i>
											                    @elseif($notificationCategory === 'wiki.deleted' || $notificationCategory === 'page.deleted')
												                    <i class="fa fa-trash-o fa-fw fa-lg icon"></i>
												                @elseif($notificationCategory === 'page.created')
																	<i class="fa fa-file-text-o fa-fw fa-lg icon"></i>
												                @endif
											                </div>
											                <div class="pull-left" style="position: relative; top: -3px; width: 89%;">
											                    {{ $notification->text }}
											                </div>
											                <div class="clearfix"></div>
			                        				        <p class="text-muted" style="font-size: 13px; color: #b7b7b7;">{{ $notification->created_at->diffForHumans() }}</p>
			                        				    </div>
			                        				</div>
	                        					</a>
	                        				</li>
	                        			@endforeach
                        			</ul>
                        		@else 
	                        		<div style="font-size: 12px; text-align: center; padding: 2px 15px 20px; color: #777;">
	                        			<i class="fa fa-bell-o" style="transform: rotate(24deg); font-size: 14px; margin-right: 4px; position: relative; top: -2px;"></i>
	                        			No unread notification.
	                        		</div>
                        		@endif
                        	</div>
                        </div>
                    </div>
                </li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }} <i class="fa fa-caret-down fa-fw"></i></a>
					<ul class="dropdown-menu dropdown-menu-right" style="margin-top: -3px; padding: 4px 5px;">
                        <li><a href="{{ route('users.show', [$team->slug, Auth::user()->slug]) }}" style="padding: 5px 6px;">Profile</a></li>
                        <li><a href="{{ route('settings.profile', [$team->slug, Auth::user()->slug]) }}" style="padding: 5px 6px;">Settings</a></li>
                        <li class="divider" style="margin: 0px; background-color: #eee;"></li>
                        <li><a href="{{ route('logout') }}" style="padding: 5px 6px;">Logout </a></li>
                    </ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
