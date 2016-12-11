<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
	<div class="settings">        
        <ul class="list-unstyled affix">
            <li class="@if(\App\Helpers\ViewHelper::getCurrentRoute() == 'users/{user_slug}') active @endif">
            	<a href="{{ route('users.show', $user->slug)  }}">Activity</a>
            </li>
	        <li class="@if(\App\Helpers\ViewHelper::getCurrentRoute() == 'users/{user_slug}/wikis') active @endif">
	        	<a href="{{ route('users.wikis', $user->slug)  }}">Wikis</a>
	        </li>
	        <li class="@if(\App\Helpers\ViewHelper::getCurrentRoute() == 'users/{user_slug}/organizations') active @endif">
	        	<a href="{{ route('users.organizations', $user->slug) }}">Organizations</a>
	        </li>
	        <li class="@if(\App\Helpers\ViewHelper::getCurrentRoute() == 'users/{user_slug}/followers') active @endif">
	        	<a href="{{ route('users.followers', $user->slug)  }}">Followers</a>
	        </li>
	        <li class="@if(\App\Helpers\ViewHelper::getCurrentRoute() == 'users/{user_slug}/following') active @endif">
	        	<a href="{{ route('users.following', $user->slug)  }}">Following</a>
	        </li>
        </ul>
    </div>
</div>