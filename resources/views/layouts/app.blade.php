<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wiki</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/prism.css">
    <link rel="stylesheet" href="/css/selectize.css">
    <link rel="stylesheet" href="/css/selectize.default.css">
    <link rel="stylesheet" href="/css/simple-sidebar.css">
    <link rel="stylesheet" href="/js/fancytree-lion/ui.fancytree.min.css">
    <link rel="stylesheet" href="/js/themes/default/style.min.css">
</head>
<body>
    <div id="wrapper">
        @if(Auth::user())
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li>
                        <a href="{{ route('dashboard')  }}">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('users.organizations', Auth::user()->slug)  }}">Organizations <span class="count">{{ $loggedInUser->organizations->count()  }}</span></a>
                    </li>
                    <li>
                        <a href="#">Favourite <span class="count">{{ $loggedInUser->starWikis->count() + $loggedInUser->starPages->count()  }}</span></a>
                    </li>
                    <li>
                        <a href="#">Watch <span class="count">{{ $loggedInUser->watchWikis->count() + $loggedInUser->watchPages->count() }}</span></a>
                    </li>
                    <li>
                        <a href="#">Discover</a>
                    </li>
                    <li>
                        <a href="#">Help</a>
                    </li>
                    <li>
                        <a href="#">Profile Settings</a>
                    </li>
                </ul>
            </div>
        @endif
        <div class="main-wrapper">
            @include('layouts.partials.menu')

            @if(Session::get('alert'))
                <div class="alert alert-{{Session::get('alert_type')}}" style="border-radius: 0;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('alert') }}
                </div>
            @endif

            <div class="main-body" id="page-content-wrapper" style="padding-top: 10px;">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

<script src="/js/jquery.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script src="/js/jquery.fancytree-all.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/ajax-loading.js"></script>
<script src="/js/tinymce.min.js"></script>
<script src="/js/validator.min.js"></script>
<script src="/js/moment-with-locales.min.js"></script>
<script src="/js/standalone/selectize.min.js"></script>
<script src="/js/prism.js"></script>
<script src="/js/app.js"></script>
<script src="/js/modules/view.js"></script>
<script>
    $(window).load(function() {
        $("body").fadeIn('slow');
        $('time.timeago').each(function(index, val) {
            var timestamp = $(val).attr('datetime');
            $(val).text(moment.utc(timestamp).fromNow());
        });
    });
    window.setInterval(function(){
        $('time.timeago').each(function(index, val) {
            var timestamp = $(val).attr('datetime');
            $(val).text(moment.utc(timestamp).fromNow());
        });
    }, 60000);
    $("#wrapper").toggleClass("toggled");
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
</body>
</html>