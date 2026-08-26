<?php

class ClientMiddleware
{
    public static function handle(): void
    {
        if (!Auth::check()) {

            Response::redirect('/client/login');
        }

        if (!Auth::isClient()) {

            Response::status(403);

            require BASE_PATH .
                '/app/views/errors/403.php';

            exit;
        }
    }
}