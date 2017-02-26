<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>OPUS</title>
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/app.css">
		<link rel="stylesheet" href="/css/font-awesome.min.css">
		<link rel="stylesheet" href="/plugins/jcrop/Jcrop.min.css">
		<link rel="stylesheet" href="/css/toastr.min.css">
		<link href="/plugins/ckeditor/plugins/codesnippet/lib/highlight/styles/github.css" rel="stylesheet">
		<link href="/plugins/vakata-jstree/dist/themes/default/style.css" rel="stylesheet">
		<link href="/plugins/atjs/jquery.atwho.min.css" rel="stylesheet">
	</head>
	<body>
		<div id="app">
			@if(Auth::user()) 
				@include('partials.menu')
				<div style="position: absolute; top: 62px; width: 100%; height: calc(100% - 62px);">
					@yield('content')
				</div>
			@else 
				@yield('content')
			@endif
			
		</div>

		<script type="text/javascript" src="/js/laroute.js"></script>
		<script type="text/javascript" src="/js/vue.js"></script>
		<script type="text/javascript" src="/js/jquery.js"></script>
		<script type="text/javascript" src="/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/plugins/jcrop/Jcrop.min.js"></script>
		<script type="text/javascript" src="/plugins/jquery-infinitescroll/jquery.infinitescroll.min.js"></script>
		<script type="text/javascript" src="/js/app.js"></script>
		<script type="text/javascript" src="/js/toastr.min.js"></script>
		<script type="text/javascript" src="/plugins/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="/js/moment.min.js"></script>
		<script type="text/javascript" src="/js/color-hash.js"></script>
		<script src="/plugins/ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js"></script>
		<script src="/plugins/vakata-jstree/dist/jstree.min.js"></script>
		<script src="/plugins/atjs/jquery.caret.min.js"></script>
		<script src="/plugins/atjs/jquery.atwho.min.js"></script>
		{{-- <script src="/js/autosize.min.js"></script> --}}
        <script>
            (function() {
                hljs.initHighlightingOnLoad();
            })();
        </script>
		@include('partials.toastr')
	</body>
</html>