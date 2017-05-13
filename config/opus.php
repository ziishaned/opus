<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mail Sending Information
    |--------------------------------------------------------------------------
    |
    | This value determines the email address transactional email will be sent from
    |
    */

	'mail_sender_address' => env('OPUS_MAIL_SENDER_ADDRESS', 'opus@info.com'),
	'mail_sender_name' => env('OPUS_MAIL_SENDER_NAME', 'Opus'),

];