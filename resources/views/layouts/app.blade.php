<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wiki</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/selectize.css">
    <link rel="stylesheet" href="/css/selectize.default.css">
</head>
<body>
<header>
    @include('layouts.partials.menu')

    <div class="alert alert-danger hide" style="border-radius: 0;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Title!</strong> Alert body ...
    </div>

    <div class="main-body">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/ajax-loading.js"></script>
<script src="/js/standalone/selectize.min.js"></script>
<script src="/js/app.js"></script>
</body>
</html>