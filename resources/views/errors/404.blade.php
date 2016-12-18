<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Wiki</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/app.css">
        <style>
            .error-template {
                padding: 40px 15px;
                text-align: center;
            }
            .error-actions {
                margin-top:15px;
                margin-bottom:15px;
            }
            .error-actions .btn { 
                margin-right:10px; 
            } .sad {
                background: 0px url(images/icons/sad.png) no-repeat;
                width: 75px;
                height: 70px;
                position: relative;
                background-size: 70px;
                left: 0px;
                display: inline-block;
                top: 25px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="error-template">
                    <div class="sad"></div>
                    <h1>Oops!</h1>
                    <h2>404 Not Found</h2>
                    <div class="error-details">
                        Sorry, an error has occured, Requested page not found!<br>
                    </div>
                    <div class="error-actions">
                        <a href="#" class="btn btn-primary">
                            <i class="fa fa-home"></i> Take Me Home 
                        </a>
                        <a href="#" class="btn btn-default">
                            <i class="fa fa-envelope"></i> Contact Support 
                        </a>
                    </div>
                </div>
            </div>
        </div>                      
    </body>
</html>