<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="{{ public_path('/css/pdf.css') }}">
</head>
<body>
	@if(isset($wiki))
		{!! $wiki->description !!}
	@else
		{!! $page->description !!}
	@endif
</body>
</html>