<?php

class AdminMiddleware
{
    public static function handle(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Authentication Check
        |--------------------------------------------------------------------------
        */

        if (Auth::guest()) {

            Session::flash(
                'error',
                'Please login as an administrator.'
            );

            Response::redirect('/admin/login');
        }

        /*
        |--------------------------------------------------------------------------
        | Authorization Check
        |--------------------------------------------------------------------------
        */

        if (!Auth::isAdmin()) {

            Response::status(403);

            require BASE_PATH .
                '/app/views/errors/403.php';

            exit;
        }
    }
}