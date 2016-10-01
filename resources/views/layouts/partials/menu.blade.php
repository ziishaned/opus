<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Wiki') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Wikis <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="#">Hello World</a>
                        </li>
                        <li>
                            <a href="#">Welcome to Wiki</a>
                        </li>
                        <li>
                            <a href="#">Just added a new One</a>
                        </li>
                        <li>
                            <a href="#">New Wiki</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">Create Wiki</a>
                        </li>
                    </ul>
                </li>
                <li><a href="/people">People</a></li>
                <li>
                    <p class="navbar-btn">
                        <a href="#" class="btn btn-success" style="border-radius: 0px;">Create Wiki</a>
                    </p>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group input-find">
                            <input type="text" class="form-control" style="margin-right: -20px;">
                            <span style="position: relative; left: -10px;"><i class="fa fa-search"></i></span></div>
                    </form>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-question-circle-o fa-lg"></i> <span class="caret"></span> </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Quick help</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="text-transform: capitalize;"><i class="fa fa-inbox fa-lg"></i></a>
                        <div class="dropdown-menu" role="menu" style="width: 345px !important;">
                            <div class="container-fluid">
                                <h3 style="text-align: center; margin-top: 5px; font-size: 15px;">Notifications</h3>
                                <div class="notification-item" style="border-radius: 0px 4px 4px 0px; cursor: pointer; background-color: white; margin-bottom: 10px;">
                                    <a class="content" href="#" style="text-decoration: none;">
                                        <div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <img src="/images/default.png" class="img-responsive" alt="Image">
                                            </div>
                                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="padding-left: 0;">
                                                <h5 class="item-title" style="margin: 0;">John Doe</h5>
                                                <p class="item-info" style="font-size: 12px; margin: 0;">Can you plaese look at the laravel wiki.</p>
                                                <p style="color: #777; font-size: 12px; margin: 0;">10 hours ago</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="notification-item" style="border-radius: 0px 4px 4px 0px; cursor: pointer; background-color: white;">
                                    <a class="content" href="#" style="text-decoration: none;">
                                        <div class="row">
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <img src="/images/default.png" class="img-responsive" alt="Image">
                                            </div>
                                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="padding-left: 0;">
                                                <h5 class="item-title" style="margin: 0;">Jane Doe</h5>
                                                <p class="item-info" style="font-size: 12px; margin: 0;">Lorem ipsum dolor sit amet, consectetur.</p>
                                                <p style="color: #777; font-size: 12px; margin: 0;">Today at 2:45 PM</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="loader-con" style="margin-top: 10px; margin-bottom: 5px;">
                                    <button class="btn btn-primary btn-block" style="border-radius: 0px;">Load More</button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="text-transform: capitalize;">
                            <img src="/images/default.png" class="img-responsive" alt="Image" style="display: inline-block; width: 20px;"> <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Add personal wiki</a></li>
                            <li><a href="#">Recent Activities</a></li>
                            <li class="nav-divider"></li>
                            <li><a href="#">Profile</a></li>
                            <li><a href="#">Watches</a></li>
                            <li><a href="#">Saved for later</a></li>
                            <li><a href="#">Setting</a></li>
                            <li class="nav-divider"></li>
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
                @endif
            </ul>
        </div>
    </div>
</nav>