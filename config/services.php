<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        //tam
        'client_id' => '378381004270-m1hevndhbo29792lpvuehk4jqtr8t6k1.apps.googleusercontent.com',
        'client_secret' => 'g2yR5nF1K84ahKj-8W4gllSg',
        'redirect' => 'http://localhost:8000/auth/google/callback',
        // 'redirect' => 'http://fbt.test/auth/google/callback',

        //vinh
        // 'client_id' => '785966318125-dmfjia9usbic1jqofcfg7b7pr7m543mp.apps.googleusercontent.com',
        // 'client_secret' => 'E1yXKvbYjGfik2ujlWfOAIQ6',
        // 'redirect' => 'http://localhost:8000/auth/google/callback',
    ],
];
