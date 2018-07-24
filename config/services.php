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
        'client_id'     =>'705344553274-3vt83vof0os7v1q6cs0igbvula5qmvb2.apps.googleusercontent.com',
        'client_secret' => 'Ec0ZIMinl6CLCuvRc_jK007J',
        'redirect'      => 'https://caltex.appinventive.com/auth/google/callback',
    ],
'twitter' => [
        'client_id'     => 'DQFkwD2QRt0LuaD9ik64ETd1j',
        'client_secret' => 'xZeIc4o3lFYIvg2R7G79XVgZYVj317RHE9DwfWbh0GK6m0cNAq',
        'redirect'      => 'https://caltex.appinventive.com/auth/twitter/callback',
    ],
    'facebook' => [
        'client_id'     => '636385256729181',
        'client_secret' => '76c40fbff2848d782694a12e0f990a2d',
        'redirect'      => 'https://caltex.appinventive.com/auth/facebook/callback',
    ],
//     'yahoo' => [
//        'client_id'     => 'dj0yJmk9MWM3SmtuVzFYcFFhJmQ9WVdrOVlXNWhkMVpzTnpZbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD04Nw--',
//        'client_secret' => '89f8bac4efae22f878f4f5da25b65fc235d78aab',
//        'redirect'      => 'https://caltex.appinventive.com/auth/yahoo/callback',
//    ],
     'yahoo' => [
        'client_id'     => 'dj0yJmk9dEdCVDVodmhlTXlSJmQ9WVdrOWNXMVBPREJLTjJNbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD0xNg--',
        'client_secret' => '3f78038d5a4d6e86511aced0e080996c96087173',
        'redirect'      => 'https://caltex.appinventive.com/auth/yahoo/callback',
    ],
];
