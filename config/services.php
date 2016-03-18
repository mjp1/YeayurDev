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
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => Yeayurdev\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id' => '142379134467-t8pkccm0ifuuoq99iglbcapj80ugl30g.apps.googleusercontent.com',
        'client_secret' => 'OVMaHyrOwmBYFdNuYLtOH3wD',
        'redirect' => 'http://yeayur.app:8000/oauth_authorization/google/callback',
    ],

    'youtube' => [
        'client_id' => '142379134467-t8pkccm0ifuuoq99iglbcapj80ugl30g.apps.googleusercontent.com',
        'client_secret' => 'OVMaHyrOwmBYFdNuYLtOH3wD',
        'redirect' => 'http://yeayur.app:8000/oauth_authorization/youtube/callback', 
    ],

    'twitch' => [
    'client_id' => 'ahzjn6ad7b5c44i7k83ow0321criih8',
    'client_secret' => 'qjs8dlmnm7h92np949z5zifiuk01fcf',
    'redirect' => 'http://staging.yeayur.com/oauth_authorization/twitch/callback',  
],

];
