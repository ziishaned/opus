<nav class="navbar navbar-default navbar-fixed-top header-menu" role="navigation">
    <div class="container" style="padding-left: 0px; padding-right: 0px;">
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            @if(Auth::user())
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#" class="dropdown-toggle" data-appended="false" data-toggle="dropdown" id="get-organizations"><i class="fa fa-bars"></i></a>
                        <ul class="dropdown-menu" id="organizations-list" style="margin-left: -15px;">
                            <li class="li-loader">
                                <span class="loader"></span> Loading
                            </li>
                        </ul>
                    </li>
                    @if(preg_match('/organizations/', ViewHelper::getCurrentRoute())) 
                        <li style="padding: 15px;">
                            <i class="fa fa-question fa-fw fa-lg"></i> {{ $organization->name }}
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-organizationId="{{ $organization->id }}" data-appended="false" data-toggle="dropdown" id="get-wikis">Wikis <i class="fa fa-caret-down fa-fw"></i></a>
                            <ul class="dropdown-menu" id="wikis-list">
                                <li class="dropdown-header" style="font-size: 15px;">Recent Wikis</li>
                                <li class="li-loader">
                                    <span class="loader">Loading</span>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">Create wiki</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Members</a> 
                        </li>
                    @endif
                </ul>
            @endif
            <div class="spinner">
                <img src="/images/ajax-loader.gif" class="img-responsive" alt="Image">
            </div>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::user())
                        
                    <li>
                        <form class="navbar-form" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search" style="width: 265px; border-radius: 2px; padding-right: 30px;">
                                <span class="fa fa-search fa-fw" style="position: absolute; top: 16px; right: 23px; color: #e7e9ed;"></span>
                            </div>
                        </form>
                    </li>
                    <ul class="nav navbar-nav">
                        <li class="dropdown" title="Notifications">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-left: 10px; padding-right: 10px;"><i class="fa fa-inbox"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" style="padding-left: 10px; padding-right: 10px;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-plus"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('organizations.create') }}" title="Create organization">Create organization</a></li>
                                <li><a href="{{ route('wikis.create') }}" title="Create wiki">Create wiki</a></li>
                            </ul>
                        </li>
                    </ul>
                    <li class="dropdown" title="{{ Auth::user()->full_name }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            @if(empty(Auth::user()->profile_image))
                                <img src="/images/default.png" alt="" class="profile-img"> <i class="fa fa-caret-down"></i>
                            @else
                                <img src="/images/profile-pics/{{ Auth::user()->profile_image }}" alt="" class="profile-img"> <i class="fa fa-caret-down"></i>
                            @endif
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('users.show', $loggedInUser->slug) }}">Profile</a></li>
                            <li><a href="{{ route('settings.profile') }}">Settings</a></li>
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
                @else
                    <li @if(ViewHelper::getCurrentRoute() === 'login') class="active" @endif><a href="{{ url('login')  }}">Login</a></li>
                    <li @if(ViewHelper::getCurrentRoute() === 'register') class="active" @endif><a href="{{ url('register')  }}">Register</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>