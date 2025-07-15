<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'accounts' => [
        'twitter' => [
            'default' => [
                'consumer_key' => env('TWITTER_CONSUMER_KEY'),
                'consumer_secret' => env('TWITTER_CONSUMER_SECRET'),
                'access_token' => env('TWITTER_ACCESS_TOKEN'),
                'access_token_secret' => env('TWITTER_ACCESS_TOKEN_SECRET'),
                'bearer_token' => env('TWITTER_BEARER_TOKEN'),
                'account_id' => env('TWITTER_ACCOUNT_ID'),
            ],
            'brand_2' => [
                'consumer_key' => env('TWITTER_2_CONSUMER_KEY'),
                'consumer_secret' => env('TWITTER_2_CONSUMER_SECRET'),
                'access_token' => env('TWITTER_2_ACCESS_TOKEN'),
                'access_token_secret' => env('TWITTER_2_ACCESS_TOKEN_SECRET'),
                'bearer_token' => env('TWITTER_2_BEARER_TOKEN'),
                'account_id' => env('TWITTER_2_ACCOUNT_ID'),
            ],
        ],
        'instagram' => [
            'default' => [
                'client_id' => env('INSTAGRAM_CLIENT_ID'),
                'client_secret' => env('INSTAGRAM_CLIENT_SECRET'),
                'access_token' => env('INSTAGRAM_ACCESS_TOKEN'),
                'access_token_secret' => env('INSTAGRAM_ACCESS_TOKEN_SECRET'),
            ],
            'brand_2' => [
                'client_id' => env('INSTAGRAM_2_CLIENT_ID'),
                'client_secret' => env('INSTAGRAM_2_CLIENT_SECRET'),
                'access_token' => env('INSTAGRAM_2_ACCESS_TOKEN'),
                'access_token_secret' => env('INSTAGRAM_2_ACCESS_TOKEN_SECRET'),
            ],
        ],
        'facebook' => [
            'default' => [
                'app_id' => env('FACEBOOK_APP_ID'),
                'app_secret' => env('FACEBOOK_APP_SECRET'),
                'page_id' => env('FACEBOOK_PAGE_ID'),
                'page_token' => env('FACEBOOK_PAGE_TOKEN'),
            ],
            'brand_2' => [
                'app_id' => env('FACEBOOK_2_APP_ID'),
                'app_secret' => env('FACEBOOK_2_APP_SECRET'),
                'page_id' => env('FACEBOOK_2_PAGE_ID'),
                'page_token' => env('FACEBOOK_2_PAGE_TOKEN'),
            ],
        ],
    ],
];