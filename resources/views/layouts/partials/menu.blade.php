<nav class="navbar navbar-default navbar-fixed-top header-menu" role="navigation" style="margin-bottom: 0;">
    {{-- <div class="container"> --}}
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse" style="border: none; cursor: pointer; float: left; margin-left: 8px;">
                <i class="fa fa-bars fa-lg"></i>
            </button>
            @if(!Auth::user())
                <a href="{{ url('/') }}" class="navbar-brand pull-right" style="margin-right: 8px;">Opus</a>
            @endif
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            @if(Auth::user())
                <ul class="nav navbar-nav header-controls">
                    <li>
                        <a href="{{ route('dashboard', [$organization->slug])  }}"><i class="fa fa-home fa-fw"></i> {{ $organization->name }}</a>
                    </li>
                    <li>
                        <a href="{{ route('organizations.wikis', [$organization->slug, ]) }}">Wikis</a>
                    </li>
                    <li>
                        <a href="{{ route('organizations.members', [$organization->slug, ]) }}">Members</a> 
                    </li>
                </ul>
            @endif
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::user())
                    <li>
                        <form class="navbar-form" role="search">
                            <div class="form-group with-icon">
                                <input type="text" class="form-control input" placeholder="Search" style="width: 255px;">
                                <i class="fa fa-search icon"></i>
                            </div>
                        </form>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-left: 10px; padding-right: 10px;"><i class="fa fa-plus fa-fw"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('organizations.wikis.create', [$organization->slug]) }}">Create wiki</a></li>
                            <li><a href="#create-category-modal" data-toggle="modal">Create category</a></li>
                            <li class="nav-divider"></li>
                            <li><a href="{{ route('invite.users', [$organization->slug, ]) }}">Invite user</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }} <i class="fa fa-caret-down fa-fw"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('users.show', [$organization->slug, $loggedInUser->slug]) }}"><span class="glyphicon glyphicon-user" style="width: 1.28571429em;"></span> Profile</a></li>
                            <li>
                                <a href="{{ route('users.readlist', [$organization->slug, Auth::user()->slug]) }}"><i class="fa fa-newspaper-o fa-fw"></i> Read list</a>
                            </li>
                            <li><a href="{{ route('settings.profile', [$organization->slug, ]) }}"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-power-off fa-fw"></i> Logout </a></li>
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="#">Pricing</a>
                    </li>
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="{{ route('organizations.login') }}" class="btn btn-default nav-btn">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    {{-- </div> --}}
</nav>