<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    <style>
        body {
            font-family: 'segoe ui', 'Open Sans', 'source sans pro', sans-serif;
        }
        .btn {
            border-radius: 0px;
        }
        p {
            margin: 0 0 10px;
        }
        .btn-success {
            color: #fff;
            background-color: #5cb85c;
            border-color: #4cae4c;
        }
        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div style="width: 580px;">
            <div style="margin-bottom: 15px;">
                <img src="http://opus.dev/img/home-logo.png" width="74" alt="">
            </div>
            <p>Hello {{ $email }}!</p>
            <p style="margin-bottom: 18px;">Someone has requested a link to change your password. You can do this through the link below.</p>
            <a href="{{ url('/password/reset/'.$token) }}" class="btn btn-success" style="text-decoration: none; border-radius: 0px; margin-bottom: 18px;">Change my password</a>
            <p>If you did't request this, please ignore this email.</p>
            <p>Your password won't change until you access the above and create a new one.</p>
        </div>
    </div>
</body>
</html>