<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color: #fdfdfd;">
    <div class="container">
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            @if(Auth::user())
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ route('dashboard') }}" style="padding-left: 0;">Home</a>
                    </li>
                    {{-- <li>
                        <div class="navbar-toggle show" id="menu-toggle" data-target="#menu-toggle" style="border: none; cursor: pointer; margin: 7px 0 0;">
                            <i class="fa fa-bars fa-lg"></i>
                        </div>
                    </li> --}}
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
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="fa fa-search" style="position: absolute; top: 17px; right: 23px; color: #e7e9ed;"></span>
                            </div>
                        </form>
                    </li>
                    <ul class="nav navbar-nav">
                        <li class="dropdown" title="Notifications">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-left: 10px; padding-right: 10px;"><i class="fa fa-inbox" style="font-size: 17px;"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" style="padding-left: 10px; padding-right: 10px;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-plus" style="font-size: 16px;"></i></a>
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