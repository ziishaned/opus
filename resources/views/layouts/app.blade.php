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
    <link rel="stylesheet" href="/css/tinymce-lightgray.css">
    <link rel="stylesheet" href="/css/editor.css">
    <link rel="stylesheet" href="/js/fancytree-lion/ui.fancytree.min.css">
    <link rel="stylesheet" href="/js/themes/default/style.min.css">
    <link rel="stylesheet" href="/plugins/calendar-heatmap/calendar-heatmap.css">
    <link rel="stylesheet" href="/plugins/semantic-ui/transition.min.css">
    <link rel="stylesheet" href="/plugins/semantic-ui/dropdown.min.css">
    <script>
        var userSlug = "<?php if(Auth::user()) { echo Auth::user()->slug; } ?>";
    </script>
</head>
<body>
    <div id="wrapper">
        <div class="main-wrapper">
            @include('layouts.partials.menu')
        
            @if(Session::get('alert'))
                <div class="alert alert-{{Session::get('alert_type')}}" style="border-radius: 0; margin-bottom: 10px; margin-top: -15px;">
                    <div class="container">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('alert') }}
                    </div>
                </div>
            @endif

            <div class="main-body" id="page-content-wrapper">
                <div class="container">
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
<script src="/js/list.js"></script>
<script src="/js/timeago.js"></script>
<script src="/js/list.fuzzysearch.js"></script>
<script src="/plugins/calendar-heatmap/moment.min.js"></script>
<script src="/plugins/calendar-heatmap/d3.v3.min.js"></script>
<script src="/plugins/calendar-heatmap/calendar-heatmap.js"></script>
<script src="/plugins/semantic-ui/dropdown.js"></script>
<script src="/plugins/semantic-ui/transition.min.js"></script>
<script src="/js/prism.js"></script>
<script src="/js/app.js"></script>
<script src="/js/modules/view.js"></script>
<script src="/js/js.cookie.js"></script>

{{-- Syntax Highlighter --}}

<link rel="stylesheet" href="/plugins/sh/styles/shCoreDefault.css">
<!-- <script src="/plugins/sh/scripts/shCore.js"></script>
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
<script src="/plugins/sh/scripts/shBrushXml.js"></script> -->

{{-- ./Syntax Highlighter --}}

<script>
    new timeago().render(document.querySelectorAll('time.timeago'));
    $("#wrapper").toggleClass("toggled");
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    // SyntaxHighlighter.defaults.toolbar = false;
    // SyntaxHighlighter.all();
</script>
</body>
</html>