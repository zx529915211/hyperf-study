<?php
declare(strict_types=1);



return [
    'default' => [
        'mail_smtp_username' => env('MAIL_SMTP_USERNAME', 'username'),
        'mail_smtp_password' => env('MAIL_SMTP_PASSWORD', ''),
        'mail_from_address' => env('MAIL_FROM_ADDRESS', ''),
        'mail_from_name' => env('MAIL_FROM_NAME', ''),
    ],
];
