<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'clientId'                => env('OAUTH_APP_ID'),
    'clientSecret'            => env('OAUTH_APP_PASSWORD'),
    'redirectUri'             => env('OAUTH_REDIRECT_URI'),
    'urlAuthorize'            => env('OAUTH_AUTHORITY').env('OAUTH_AUTHORIZE_ENDPOINT'),
    'urlAccessToken'          => env('OAUTH_AUTHORITY').env('OAUTH_TOKEN_ENDPOINT'),
    'urlResourceOwnerDetails' => '',
    'scopes'                  => env('OAUTH_SCOPES')
];