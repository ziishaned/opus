<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
	<div class="settings">
        <ul class="list-unstyled affix">
            <li class="@if(\App\Helpers\ViewHelper::getCurrentRoute() == 'users/{user_slug}') active @endif">
            	<a href="{{ route('users.show', [$organization->slug, $user->slug])  }}">Activity</a>
            </li>
        </ul>
    </div>
</div>