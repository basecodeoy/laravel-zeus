<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Zeus\AccessToken;

return [
    /*
    |--------------------------------------------------------------------------
    | Access Token Model Class
    |--------------------------------------------------------------------------
    |
    | This value controls the access token model class used when interacting
    | with the database. The chosen class will handle the management and
    | operations for access tokens stored in the database.
    |
    */
    'model' => AccessToken::class,

    /*
    |--------------------------------------------------------------------------
    | Default Values for Access Tokens
    |--------------------------------------------------------------------------
    |
    | This value controls the default values for access tokens that are
    | created by your application. These are only applied if you use
    | the `PendingAccessToken::defaults()` method when creating your
    | access tokens.
    |
    */
    'defaults' => [
        /*
        |--------------------------------------------------------------------------
        | Default Abilities for Access Tokens
        |--------------------------------------------------------------------------
        |
        | This value controls the default abilities. These abilities will be used
        | on all access tokens that are created by your application unless a
        | different abilities is specified when the token is created.
        |
        */
        'abilities' => ['*'],

        /*
        |--------------------------------------------------------------------------
        | Default Domains for Access Tokens
        |--------------------------------------------------------------------------
        |
        | This value controls the default domains. These domains will be used on
        | all access tokens that are created by your application unless a
        | different domains is specified when the token is created.
        |
        */
        'domains' => ['*'],

        /*
        |--------------------------------------------------------------------------
        | Default Expiration for Access Tokens
        |--------------------------------------------------------------------------
        |
        | This value controls the number of minutes until an issued token will
        | be considered expired. This will override any values set in the token's
        | "expires_at" attribute, but first-party sessions are not affected.
        |
        */
        'expiration' => null,

        /*
        |--------------------------------------------------------------------------
        | Default Access Token Prefix
        |--------------------------------------------------------------------------
        |
        | This value controls the default access token prefix. This prefix will be
        | used on all access tokens that are created by your application unless a
        | different prefix is specified when the token is created.
        |
        */
        'prefix' => 'pat',

        /*
        |--------------------------------------------------------------------------
        | Default Access Token Type
        |--------------------------------------------------------------------------
        |
        | This value controls the default access token type. This type will be
        | used on all access tokens that are created by your application unless a
        | different type is specified when the token is created.
        |
        */
        'type' => 'personal_access_token',
    ],
];
