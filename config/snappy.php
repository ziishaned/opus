<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  => env('SNAPPY_BINARY', 'C:/wkhtmltopdf/bin/wkhtmltopdf.exe'),
        'timeout' => false,
        'options' => [],
        'env'     => [],
    ),


);
