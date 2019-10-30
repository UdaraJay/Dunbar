<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Proxy input: define the skip attribute
      |--------------------------------------------------------------------------
      |
      | When you call the proxy helper with this attribute set as true, the proxy calls
      | the uri directly without pass to oauth server.
      |
     */
    'skip_param' => 'skip',

     /*
      |--------------------------------------------------------------------------
      |  Proxy endpoint
      |--------------------------------------------------------------------------
      |
      | This is the endpoint that you would use to access the proxy.
      | By default the proxy endpoint will be your-domain.com/dunbar.
      |
     */
    'endpoint' => 'dunbar',

    /*
      |--------------------------------------------------------------------------
      | Set redirect URI
      |--------------------------------------------------------------------------
      |
      | Set a redirect URI to call when the cookie expires. If you don't specify
      | any URI, the proxy helper will return a 403 proxy_cookie_expired exception.
      |
     */
    'redirect_login' => '',

    /*
      |--------------------------------------------------------------------------
      |  Cookie configuration
      |--------------------------------------------------------------------------
      |
      | This is the cookie's configuration: name of cookie and expiration minutes.
      | If time is NULL the cookie doesn't expires.
      |
     */
    'cookie_info' => [
        'name' => 'dunbar',
        'time' => 7200
    ],

    /*
      |--------------------------------------------------------------------------
      |  Access token send into header
      |--------------------------------------------------------------------------
      |
      | If it is true the access_token was sent to oauth server into request's header.
      |
     */
    'use_header' => false,

    /*
      |--------------------------------------------------------------------------
      |  List of client secret
      |--------------------------------------------------------------------------
      |
      | Define secrets key for each clients you need.
      |
     */
    'client_secrets' => [
        'client_1' => 'abc123',
        'client_2' => 'def456'
    ],
];
