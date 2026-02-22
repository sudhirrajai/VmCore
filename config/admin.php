<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Route Prefix
    |--------------------------------------------------------------------------
    |
    | This is the URL prefix for all admin panel routes.
    | Change this value to move the admin panel to a different URL.
    |
    | Example: 'admin'       → http://yoursite.com/admin
    |          'dashboard'   → http://yoursite.com/dashboard
    |          'manage'      → http://yoursite.com/manage
    |
    */

    'prefix' => env('ADMIN_PREFIX', 'admin'),

    /*
    |--------------------------------------------------------------------------
    | Admin Route Name Prefix
    |--------------------------------------------------------------------------
    |
    | This prefix is added to all admin route names.
    | Must end with a dot (.) — e.g. 'admin.' gives route names like 'admin.dashboard-analytics'
    |
    */

    'name' => env('ADMIN_NAME', 'admin.'),

];
