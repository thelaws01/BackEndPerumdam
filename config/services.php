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
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'firebase' => [
        'api_key' => 'AIzaSyB5sUnXQnFU9gbGVCsbccoOCR82oLXCvBY', // Only used for JS integration
        'auth_domain' => 'toyotaastra-adb61.firebaseapp.com', // Only used for JS integration
        'database_url' => 'https://toyotaastra-adb61.firebaseio.com/',
        'secret' => 'PWiEvwjVpYIOOF3vZL3F2ZF3gWsau72e6ZsLnDNl',
        'storage_bucket' => 'STORAGE_BUCKET', // Only used for JS integration
    ]

    // apiKey: "AIzaSyB5sUnXQnFU9gbGVCsbccoOCR82oLXCvBY",
    // authDomain: "toyotaastra-adb61.firebaseapp.com",
    // databaseURL: "https://toyotaastra-adb61.firebaseio.com",
    // projectId: "toyotaastra-adb61",
    // storageBucket: "toyotaastra-adb61.appspot.com",
    // messagingSenderId: "886904233701",
    // appId: "1:886904233701:web:31d508c84d6100ae9b7e0c"

];
