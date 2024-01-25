<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Content Security Policy Header
    |--------------------------------------------------------------------------
    |
    | Enable or disable the Content Security Policy (CSP) header.
    |
    */

    'enabled' => env('CSP_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Content Security Policy Report Only
    |--------------------------------------------------------------------------
    |
    | If this option is enabled, no CSP headers are sent, but violations will
    | be reported to the browser console, or a URI you specify.
    |
    */

    'report_only' => env('CSP_REPORT_ONLY', false),

    /*
    |--------------------------------------------------------------------------
    | Content Security Policy (CSP)
    |--------------------------------------------------------------------------
    |
    | The values listed in the arrays are concatenated together to generate the
    | final directive values. See https://content-security-policy.com/ for
    | detailed information about each directive.
    |
    */

    'directives' => [
        'default-src' => ["'self'"],
        'script-src' => ["'self'", 'https://oauth.telegram.org/'], // Add the Telegram domain here
        'style-src' => ["'self'"],
        'img-src' => ["'self'", 'data:'],
        'font-src' => ["'self'", 'data:'],
        'form-action' => ["'self'"],
        'frame-ancestors' => ["'self'", 'https://oauth.telegram.org/'], // Add the Telegram domain here
    ],

    /*
    |--------------------------------------------------------------------------
    | Upgrade Insecure Requests
    |--------------------------------------------------------------------------
    |
    | This option will set the `upgrade-insecure-requests` CSP header. This
    | will instruct browsers to treat all of your insecure URLs as though
    | they have been replaced with secure URLs.
    |
    */

    'upgrade_insecure_requests' => env('CSP_UPGRADE_INSECURE_REQUESTS', false),

];
