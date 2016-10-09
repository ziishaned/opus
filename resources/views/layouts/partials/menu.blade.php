<nav class="navbar navbar-default" role="navigation" style="border-radius: 0;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Wiki</a>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
            @if(Auth::user())
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Organizations <span class="badge">{{ $user->organizations->count()  }}</span> <i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu">
                            @foreach($user->organizations as $organization)
                                <li><a href="{{ url('/organizations/' . $organization->id)  }}">{{ $organization->name  }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @if(!ViewHelper::getCurrentRoute() === '/')
                        <li><a href="#">Wikis</a></li>
                    @endif
                </ul>
            @endif
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
            </form>
            <div class="spinner">
                <img src="/images/ajax-loader.gif" class="img-responsive" alt="Image">
            </div>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::user())
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Favourite <span class="badge">{{ $user->starWikis->count() + $user->starPages->count()  }}</span> <i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Wikis <span class="badge pull-right">{{ $user->starWikis->count() }}</span></a></li>
                            <li><a href="#">Pages <span class="badge pull-right">{{ $user->starPages->count()  }}</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Watch <span class="badge">{{ $user->watchWikis->count() + $user->watchPages->count() }}</span> <i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Wikis <span class="badge pull-right">{{ $user->watchWikis->count() }}</span></a></li>
                            <li><a href="#">Pages <span class="badge pull-right">{{ $user->watchPages->count() }}</span></a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell fa-lg"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-plus fa-lg"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('createOrganization') }}">Create Organization</a></li>
                            <li><a href="#">Create Personal Wiki</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="/images/default.png" width="20" class="img-responsive img-circle" alt="Image"></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Profile</a></li>
                            <li><a href="#">Settings</a></li>
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