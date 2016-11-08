<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="border-radius: 0; margin-bottom: 0;">
    <div class="container-fluid">
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            @if(Auth::user())
                <ul class="nav navbar-nav">
                    <li>
                        <div class="navbar-toggle show" id="menu-toggle" data-target="#menu-toggle" style="border: none; cursor: pointer; margin: 7px 0 0;">
                            <i class="fa fa-bars fa-lg"></i>
                        </div>
                    </li>
                @if(!ViewHelper::getCurrentRoute() === '/')
                        <li><a href="{{ url('/')  }}">Wikis</a></li>
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
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="fa fa-search" style="position: absolute; top: 17px; right: 23px; color: #e7e9ed;"></span>
                            </div>
                        </form>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-left: 10px; padding-right: 10px;"><i class="fa fa-bell"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-left: 10px; padding-right: 10px;"><i class="fa fa-plus"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('organizations.create') }}">Create Organization</a></li>
                            <li><a href="{{ route('wikis.create') }}">Create Wiki</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-left: 10px; padding-right: 10px;">
                            <div class="profile-img" style="margin-right: 3px; border-radius: 3px;"></div> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('users.show', $loggedInUser->slug) }}">Profile</a></li>
                            <li><a href="#">Settings</a></li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ url('/logout') }}"
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