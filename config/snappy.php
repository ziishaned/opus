<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  => env('WKHTMLTOPDF_PATH', 'C:/wkhtmltopdf/bin/wkhtmltopdf.exe'),
        'timeout' => false,
        'options' => [],
        'env'     => [],
    ),


);
