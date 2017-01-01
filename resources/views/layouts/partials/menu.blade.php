<nav class="navbar navbar-default navbar-fixed-top header-menu" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse" style="border: none; background-color: #f8f8f8; cursor: pointer;">
                <i class="fa fa-bars fa-lg"></i>
            </button>
            <a class="navbar-brand hidden-lg hidden-md hidden-sm" href="#">Wiki Stack</a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            @if(Auth::user())
                <ul class="nav navbar-nav">
                    <li class="hidden-xs">
                        <a href="#" class="dropdown-toggle" data-organizationId="{{ $organization->id }}" data-appended="false" data-toggle="dropdown" id="get-wikis"><i class="fa fa-bars fa-lg"></i></a>
                        <ul class="dropdown-menu dropdown-menu-left" id="wikis-list" style="padding: 10px;">
                            <li>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div style="width: 270px;">
                                            <input class="form-control input-sm fuzzy-search" id="searchinput" type="search" placeholder="Find a wiki...">
                                            <span class="fa fa-search" style="position: absolute; top: 7px; right: 23px; color: #e7e9ed;"></span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li class="dropdown-header" style="padding: 0px;"><i class="fa fa-clock-o fa-fw"></i> Recent Wikis</li>
                            <li class="li-loader">
                                <span class="loader"></span> Loading
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('organizations.wikis.create', [$organization->slug]) }}" class="btn btn-default btn-block" style="padding-top: 5px; padding-bottom: 5px;">Create new wiki</a>
                            </li>
                        </ul>
                    </li>
                    <li class="organization-name">
                        <a href="{{ route('dashboard', [$organization->slug])  }}">{{ $organization->name }}</a>
                    </li>
                    <li>
                        <a href="{{ route('organizations.wikis', [$organization->slug, ]) }}">Wikis</a>
                    </li>
                    <li>
                        <a href="{{ route('organizations.categories.index', [$organization->slug, ]) }}">Categories</a>
                    </li>
                    <li>
                        <a href="{{ route('organizations.members', [$organization->slug, ]) }}">Members</a> 
                    </li>
                    <li>
                        <a href="{{ route('organizations.reports.index', [$organization->slug, ]) }}" title="user and wikis - jis nay zayada kam kiya hai">Reports</a> 
                    </li>
                </ul>
            @endif
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::user())    
                    <li class="hidden-xs hidden-sm">
                        <form class="navbar-form" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control input" placeholder="Search" style="width: 265px; padding-right: 30px;">
                                <span class="fa fa-search fa-fw" style="position: absolute; top: 17px; right: 23px; color: #adadad; font-weight: bold;"></span>
                            </div>
                        </form>
                    </li>
                    <li class="dropdown hidden-xs" title="Notifications">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-left: 10px; padding-right: 10px;"><i class="fa fa-inbox fa-fw"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>
                    <li class="dropdown hidden-xs" title="Notifications">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-left: 10px; padding-right: 10px;"><i class="fa fa-plus fa-fw"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('organizations.wikis.create', [$organization->slug]) }}">Create wiki</a></li>
                            <li><a href="{{ route('organizations.categories.create', [$organization->slug]) }}">Create category</a></li>
                            <li class="nav-divider"></li>
                            <li><a href="{{ route('invite.users', [$organization->slug, ]) }}">Invite user</a></li>
                        </ul>
                    </li>
                    <li class="dropdown hidden-xs" title="{{ Auth::user()->full_name }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            @if(empty(Auth::user()->profile_image))
                                <img src="/images/default.png" alt="" class="profile-img"> <i class="fa fa-caret-down"></i>
                            @else
                                <img src="/images/profile-pics/{{ Auth::user()->profile_image }}" alt="" class="profile-img"> <i class="fa fa-caret-down"></i>
                            @endif
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('users.show', [$organization->slug, $loggedInUser->slug]) }}">Profile</a></li>
                            <li><a href="{{ route('settings.profile', [$organization->slug, ]) }}">Settings</a></li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ url('/logout') }}" id="logout" 
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li class="hidden-lg hidden-md hidden-sm">
                        <form class="navbar-form" role="search" style="margin: 0; margin-bottom: 7px;">
                            <div class="form-group">
                                <input type="text" class="form-control input" placeholder="Search" style="padding-right: 30px;">
                                <span class="fa fa-search fa-fw" style="position: absolute; top: 20px; right: 23px; color: #adadad; font-weight: bold;"></span>
                            </div>
                        </form>
                    </li>
                    <li class="hidden-lg hidden-md hidden-sm"><a href="{{ route('users.show', [$organization->slug, $loggedInUser->slug]) }}">Profile</a></li>
                    <li class="hidden-lg hidden-md hidden-sm"><a href="{{ route('settings.profile', [$organization->slug, ]) }}">Settings</a></li>
                    <li class="hidden-lg hidden-md hidden-sm">
                        <a href="{{ url('/logout') }}" id="logout" 
                           onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @else
                    <li>
                        <a href="#">Pricing</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>