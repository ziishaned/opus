<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <ul class="nav nav-pills" id="organization-nav">
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'users/{id}') class="active" @endif><a href="{{ url('/users/' . $user->id)  }}">Profile</a></li>
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'users/{id}/wikis') class="active" @endif><a href="{{ url('/users/' . $user->id . '/wikis')  }}">Wikis <span class="badge">{{ $user->wikis->count()  }}</span></a></li>
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'users/{id}/organizations') class="active" @endif><a href="{{ url('/users/' . $user->id . '/organizations')  }}">Organizations <span class="badge">{{ $user->organizations->count()  }}</span></a></li>
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'users/{id}/followers') class="active" @endif><a href="{{ url('/users/' . $user->id  . '/followers')  }}">Followers <span class="badge">{{ $user->followers->count()  }}</span></a></li>
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'users/{id}/following') class="active" @endif><a href="{{ url('/users/' . $user->id . '/following')  }}">Following <span class="badge">{{ $user->following->count()  }}</span></a></li>
        </ul>
    </div>
</div>