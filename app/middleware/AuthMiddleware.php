<?php

class AuthMiddleware
{
    public static function handle(): void
    {
        if (!Auth::check()) {

            Session::flash(
                'error',
                'Please login to continue.'
            );

            Response::redirect('/login');
        }
    }
}