<?php

class AdminMiddleware
{
    public static function handle(): void
    {
        if (!Auth::check()) {

            Response::redirect('/admin/login');
        }

        if (!Auth::isAdmin()) {

            Response::status(403);

            require BASE_PATH .
                '/app/views/errors/403.php';

            exit;
        }
    }
}