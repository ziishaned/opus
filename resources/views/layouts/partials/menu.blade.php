<nav class="navbar navbar-default" role="navigation" style="border-radius: 0; margin-bottom: 0;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('dashboard') }}">Wiki</a>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
            @if(Auth::user())
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Organizations <span class="badge">{{ $loggedInUser->organizations->count()  }}</span> <i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu" @if($loggedInUser->organizations->count() == 0) style="background-color: #fafafa;" @endif>
                            @if($loggedInUser->organizations->count() > 0)
                                @foreach($loggedInUser->organizations as $organization)
                                    <li><a href="{{ route('organizations.show', $organization->slug) }}">{{ $organization->name  }}</a></li>
                                @endforeach
                            @else 
                                <li style="background-color: #fafafa; text-align: center; font-size: 14px; font-weight: 500;">Nothing Found!</li>
                            @endif
                        </ul>
                    </li>
                    @if(!ViewHelper::getCurrentRoute() === '/')
                        <li><a href="{{ url('/')  }}">Wikis</a></li>
                    @endif
                </ul>
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                </form>
            @endif
            <div class="spinner">
                <img src="/images/ajax-loader.gif" class="img-responsive" alt="Image">
            </div>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::user())
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Discover <i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-pencil"></i> Recently worked on</a></li>
                            <li><a href="#"><i class="fa fa-floppy-o"></i> Saved for latter</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Favourite <span class="badge">{{ $loggedInUser->starWikis->count() + $loggedInUser->starPages->count()  }}</span> <i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Wikis <span class="badge pull-right">{{ $loggedInUser->starWikis->count() }}</span></a></li>
                            <li><a href="#">Pages <span class="badge pull-right">{{ $loggedInUser->starPages->count()  }}</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Watch <span class="badge">{{ $loggedInUser->watchWikis->count() + $loggedInUser->watchPages->count() }}</span> <i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Wikis <span class="badge pull-right">{{ $loggedInUser->watchWikis->count() }}</span></a></li>
                            <li><a href="#">Pages <span class="badge pull-right">{{ $loggedInUser->watchPages->count() }}</span></a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-plus"></i> <i class="fa fa-caret-down" style="position: relative; left: 2px;"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('organizations.create') }}">Create Organization</a></li>
                            <li><a href="{{ route('wikis.create') }}">Create Wiki</a></li>
                        </ul>
                    </li>
                    <li class="dropdown" style="height: 50px;">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <ul class="list-inline list-unstyled">
                                <li style="padding: 0;"><img src="/images/default.png" width="20" class="img-responsive img-circle" alt="Image"></li>
                                <li style="padding: 0;"><i class="fa fa-caret-down" style="position: relative; top: -4px; left: 2px;"></i></li>
                            </ul>
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