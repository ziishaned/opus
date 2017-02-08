<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Opus Wiki</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/plugins/tinymce/tinymce-lightgray.css">
    <link rel="stylesheet" href="/plugins/tinymce/editor.css">
    <link rel="stylesheet" href="/plugins/vakata-jstree/dist/themes/default/style.css" />
    <link rel="stylesheet" href="/plugins/jcrop/Jcrop.min.css">
</head>
<body>
    @include('layouts.partials.modals')
    <div style="{{ Auth::user() ? 'min-height: 50px' : 'min-height: 53px;' }}">
        @include('layouts.partials.menu')
    </div>

    @if(Session::get('alert'))
        <div class="alert alert-{{Session::get('alert_type')}} no-stroke" style="border-radius: 0; margin-bottom: 0px; margin-top: -2px; font-size: 13px;">
            <div class="container">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('alert') }}
            </div>
        </div>
    @endif

    @yield('content')
    
<script src="/js/jquery.js"></script>
{{-- <script src="/js/jquery-ui.min.js"></script> --}}
<script src="/js/bootstrap.min.js"></script>
<script src="/plugins/tinymce/tinymce.min.js"></script>
<script src="/js/moment.min.js"></script>
<script src="/plugins/vakata-jstree/dist/jstree.min.js"></script>
<script src="/js/app.js"></script>
<script src="/plugins/jcrop/Jcrop.min.js"></script>
<script src="/plugins/jquery-infinitescroll/jquery.infinitescroll.min.js"></script>
<script src="/js/laroute.js"></script>
<script src="/js/laravel-delete-req.js"></script>

{{-- <link rel="stylesheet" href="/plugins/sh/styles/shCoreDefault.css">
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
<script src="/plugins/sh/scripts/shBrushXml.js"></script> --}}

<script>
    // SyntaxHighlighter.defaults.toolbar = false;
    // SyntaxHighlighter.all();
</script>
</body>
</html>