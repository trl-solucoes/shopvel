<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model' => Shoppvel\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id'     => '817596185063583',
        'client_secret' => '02794c3dbb30fe4212f9e0995b3aaceb',
        'redirect'      => 'http://localhost:8000/facebook',
    ],
    'google' => [
        'client_id'     => '41733499716-1gr2bp4neq69he8hqdlsnlmjbkfhhguh.apps.googleusercontent.com',
        'client_secret' => 'htoYts3Tpe_R8GVOc3_xB8XP',
        'redirect'      => 'http://localhost:8000/google',
    ],

    
];
