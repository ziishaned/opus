<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <ul class="nav nav-pills" id="organization-nav" style="display: flex; justify-content: center;">
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'users/{user_slug}') class="active" @endif><a href="{{ route('users.show', $user->slug)  }}">Activity</a></li>
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'users/{user_slug}/wikis') class="active" @endif><a href="{{ route('users.wikis', $user->slug)  }}">Wikis <span class="badge">{{ $user->wikis->count()  }}</span></a></li>
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'users/{user_slug}/organizations') class="active" @endif><a href="{{ route('users.organizations', $user->slug) }}">Organizations <span class="badge">{{ $user->organizations->count()  }}</span></a></li>
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'users/{user_slug}/followers') class="active" @endif><a href="{{ route('users.followers', $user->slug)  }}">Followers <span class="badge">{{ $user->followers->count()  }}</span></a></li>
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'users/{user_slug}/following') class="active" @endif><a href="{{ route('users.following', $user->slug)  }}">Following <span class="badge">{{ $user->following->count()  }}</span></a></li>
        </ul>
    </div>
</div>