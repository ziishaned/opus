<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>404 - Not Found</title>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
	<style type="text/css">
		.error-template {position: absolute; left: calc(50% - 15%); top: 21%; padding: 40px 15px; text-align: center;}
		.error-actions {margin-top:15px;margin-bottom:15px;}
		.error-actions .btn { margin-right:10px; }
	</style>
</head>
<body>
    <div class="error-template">
	    <h1 style="font-size: 52px; font-weight: 700; margin-bottom: 28px;">Oops!</h1>
	    <div style="padding-bottom: 15px; width: 380px; margin: auto;">
		    <h2 style="margin-bottom: 5px;">404 Not Found</h2>
		    <div class="error-details" style="font-size: 18px;">
				Sorry, an error has occured, Requested page not found!<br>
		    </div>
	    </div>
	    <div class="error-actions">
			<a href="{{ route('home') }}" class="btn btn-primary" style="font-family: 'Open Sans'; height: 45px; line-height: 45px; text-decoration: none; color: white; font-size: 18px; border-radius: 4px; width: 200px; text-align: center; font-weight: 400; box-shadow: 0px 5px 0px #235986; border: none; padding: 0;">
			    <i class="fa fa-home fa-fw"></i> Take Me Home 
			</a>
			<a href="mailto:opus@info.com" class="btn btn-default" style="font-family: 'Open Sans'; height: 45px; line-height: 45px; text-decoration: none; font-size: 18px; border-radius: 4px; width: 200px; text-align: center; font-weight: 400; padding: 0; box-shadow: 0px 5px 0px #d0d0d0; background-color: #f1f1f1; border: none;">
			    <i class="fa fa-envelope-o fa-fw"></i> Contact Support 
			</a>
	    </div>
	</div>
</body>
</html>