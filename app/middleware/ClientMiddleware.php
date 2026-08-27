<?php

class ClientMiddleware
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
                'Please login to continue.'
            );

            Response::redirect('/client/login');
        }

        /*
        |--------------------------------------------------------------------------
        | Authorization Check
        |--------------------------------------------------------------------------
        */

        if (!Auth::isClient()) {

            Response::status(403);

            require BASE_PATH .
                '/app/views/errors/403.php';

            exit;
        }
    }
}