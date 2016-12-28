Integrate Infinite AJAX Scroll with Wordpress
=============================================

In this cookbook we install Infinite AJAX Scroll into the default Twenty Twelve theme.

1) Download [jquery-ias.min.js](http://infiniteajaxscroll.com/download.html).

2) Copy `jquery-ias.min.js` into the folder `wp-content/themes/twentytwelve/js`

3) Open `wp-content/themes/twentytwelve/header.php` in your editor

4) Add jQuery to the theme. To do so, paste the following code before the line with "`</head>`":

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

5) Paste the following code before the line with "`</head>`":

    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ias.min.js" type="text/javascript"></script>

6) Now paste the following code before the line with "`</head>`":
  
     <script type="text/javascript">
       var ias = $.ias({
         container: "#content",
         item: ".post",
         pagination: ".navigation",
         next: ".nav-previous a",
       });
       
       ias.extension(new IASTriggerExtension({offset: 2}));
       ias.extension(new IASSpinnerExtension());
       ias.extension(new IASNoneLeftExtension());
     </script>

Done. Happy scrolling!
