<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => '694930635551376',
        'client_secret' => '365c8ce2faac36a12b9af1b518477608',
        'redirect' => 'https://hikari-hr.com/login/facebook/callback',
    ],
    'google' => [
        'client_id' => '584156284032-1r0rejgk9ispiqku5f3erm67s3foorqb.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://hikari-hr.com/login/google/callback',
    ],
];
