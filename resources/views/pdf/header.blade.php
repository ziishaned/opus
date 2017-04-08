<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page header</title>
    <style>
        * {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        }

        p {
            font-weight: 500;
            padding-bottom: 8px;
            border-bottom: 1px solid #eaecef;
            color: #c1c1c1;
        }

        h1 {
            padding-bottom: 8px;
        }
    </style>
</head>
<body>
<p>
    @if(isset($wiki))
        {{ $wiki->name }}
    @else
        {{ $page->name }}
    @endif
</p>
<h1></h1>
</body>
</html>