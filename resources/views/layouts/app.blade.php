<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="cache-control" content="no-store" />
    <meta http-equiv="cache-control" content="must-revalidate" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <title>Wiki</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/prism.css">
    <link rel="stylesheet" href="/css/selectize.css">
    <link rel="stylesheet" href="/css/selectize.default.css">
    <link rel="stylesheet" href="/css/tinymce-lightgray.css">
    <link rel="stylesheet" href="/css/editor.css">
    <link rel="stylesheet" href="/css/simple-sidebar.css">
    <link rel="stylesheet" href="/js/fancytree-lion/ui.fancytree.min.css">
    <link rel="stylesheet" href="/js/themes/default/style.min.css">
    <link rel="stylesheet" href="/plugins/calendar-heatmap/calendar-heatmap.css">
    <script>
        var userSlug = "<?php if(Auth::user()) { echo Auth::user()->slug; } ?>";
    </script>
</head>
<body>
    <div id="wrapper">
        @if(Auth::user())
            <div id="sidebar-wrapper" style="margin-top: 50px;">
                <ul class="sidebar-nav">
                    <li style="position: absolute; top: -15px; right: 22px;">
                        <i class="fa fa-fw fa-thumb-tack fa-lg" id="pin-sidebar" style="color: #e4e4e4; cursor: pointer;" title="Pin sidebar"></i>
                    </li>
                    <li style="margin-top: 15px;">
                        <a href="{{ route('dashboard')  }}">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('users.organizations', Auth::user()->slug)  }}">Organizations <span class="count">{{ $loggedInUser->organizations->count()  }}</span></a>
                    </li>
                    <li>
                        <a href="#">Favourite <span class="count">{{ $loggedInUser->starWikis->count()  }}</span></a>
                    </li>
                    <li>
                        <a href="#">Watch <span class="count">{{ $loggedInUser->watchWikis->count() }}</span></a>
                    </li>
                    <li>
                        <a href="#">Discover</a>
                    </li>
                    <li>
                        <a href="{{ route('help') }}">Help</a>
                    </li>
                </ul>
            </div>
        @endif
        <div class="main-wrapper">
            @include('layouts.partials.menu')

            @if(Session::get('alert'))
                <div class="alert alert-{{Session::get('alert_type')}}" style="border-radius: 0; margin-top: 51px; margin-bottom: -40px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('alert') }}
                </div>
            @endif

            <div class="main-body" id="page-content-wrapper" style="margin-top: 50px;">
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
<script src="/js/keymaster.js"></script>
<script src="/js/keymaster.sequence.min.js"></script>
<script src="/js/app-shortcuts.js"></script>
<script src="/js/ajax-loading.js"></script>
<script src="/js/tinymce.min.js"></script>
<script src="/js/validator.min.js"></script>
{{-- <script src="/js/moment-with-locales.min.js"></script> --}}
<script src="/plugins/calendar-heatmap/moment.min.js"></script>
<script src="/plugins/calendar-heatmap/d3.v3.min.js"></script>
<script src="/plugins/calendar-heatmap/calendar-heatmap.js"></script>
<script src="/js/standalone/selectize.min.js"></script>
<script src="/js/prism.js"></script>
<script src="/js/app.js"></script>
<script src="/js/modules/view.js"></script>
<script src="/js/js.cookie.js"></script>

{{-- Syntax Highlighter --}}

<link rel="stylesheet" href="/plugins/sh/styles/shCoreDefault.css">
<script src="/plugins/sh/scripts/shCore.js"></script>
<script src="/plugins/sh/scripts/shLegacy.js"></script>
<script src="/plugins/sh/scripts/shAutoloader.js"></script>
<script src="/plugins/sh/scripts/shBrushXml.js"></script>
<script src="/plugins/sh/scripts/shBrushPhp.js"></script>
<script src="/plugins/sh/scripts/shBrushAppleScript.js"></script>
<script src="/plugins/sh/scripts/shBrushAS3.js"></script>
<script src="/plugins/sh/scripts/shBrushBash.js"></script>
<script src="/plugins/sh/scripts/shBrushColdFusion.js"></script>
<script src="/plugins/sh/scripts/shBrushCpp.js"></script>
<script src="/plugins/sh/scripts/shBrushCSharp.js"></script>
<script src="/plugins/sh/scripts/shBrushCss.js"></script>
<script src="/plugins/sh/scripts/shBrushDelphi.js"></script>
<script src="/plugins/sh/scripts/shBrushDiff.js"></script>
<script src="/plugins/sh/scripts/shBrushGroovy.js"></script>
<script src="/plugins/sh/scripts/shBrushJava.js"></script>
<script src="/plugins/sh/scripts/shBrushJavaFX.js"></script>
<script src="/plugins/sh/scripts/shBrushJScript.js"></script>
<script src="/plugins/sh/scripts/shBrushPerl.js"></script>
<script src="/plugins/sh/scripts/shBrushPlain.js"></script>
<script src="/plugins/sh/scripts/shBrushPowerShell.js"></script>
<script src="/plugins/sh/scripts/shBrushPython.js"></script>
<script src="/plugins/sh/scripts/shBrushRuby.js"></script>
<script src="/plugins/sh/scripts/shBrushSass.js"></script>
<script src="/plugins/sh/scripts/shBrushScala.js"></script>
<script src="/plugins/sh/scripts/shBrushSql.js"></script>
<script src="/plugins/sh/scripts/shBrushVb.js"></script>
<script src="/plugins/sh/scripts/shBrushXml.js"></script>

{{-- ./Syntax Highlighter --}}

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
    SyntaxHighlighter.defaults.toolbar = false;
    SyntaxHighlighter.all();
</script>
</body>
</html>