<nav class="navbar navbar-default navbar-fixed-top header-menu" role="navigation" style="margin-bottom: 0;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse" style="border: none; background-color: #f8f8f8; cursor: pointer;">
                <i class="fa fa-bars fa-lg"></i>
            </button>
            @if(!Auth::user())
                <a href="{{ route('dashboard', [$organization->slug])  }}" class="navbar-brand">Opus</a>
            @endif
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav header-controls">
                @if(Auth::user())
                    <li>
                        <a href="{{ route('dashboard', [$organization->slug])  }}"><i class="fa fa-home fa-fw"></i> {{ $organization->name }}</a>
                    </li>
                    <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'organizations/{organization_slug}/categories') class="active" @endif>
                        <a href="{{ route('organizations.categories', [$organization->slug, ]) }}">Categories</a>
                    </li>
                    <li>
                        <a href="{{ route('organizations.members', [$organization->slug, ]) }}">Members</a> 
                    </li>
                    <li>
                        <a href="{{ route('organizations.reports.index', [$organization->slug, ]) }}" title="user and wikis - jis nay zayada kam kiya hai">Reports</a> 
                    </li>
                    {{-- @if(isset($wiki) && isset($category)) 
                        <li>
                            <a href="{{ route('pages.create', [$organization->slug, $category->slug, $wiki->slug]) }}" class="btn btn-default" style="padding: 6px 10px; position: relative; top: 7px; left: 12px;">Create page</a>
                        </li>
                    @endif --}}
                @else 
                    <li>
                        <a href="{{ url('/') }}" class="navbar-brand">Opus</a>
                    </li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::user())
                    <li>
                        <form class="navbar-form" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control input" placeholder="Search" style="width: 255px;">
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
    </div>
</nav>