<?php

class Autoloader
{
    public static function register(): void
    {
        spl_autoload_register(function (string $class): void {

            $directories = [
                BASE_PATH . '/app/core/',
                BASE_PATH . '/app/controllers/',
                BASE_PATH . '/app/models/',
                BASE_PATH . '/app/middleware/',
                BASE_PATH . '/app/helpers/'
            ];

            foreach ($directories as $directory) {

                $file = $directory . $class . '.php';

                if (file_exists($file)) {
                    require_once $file;
                    return;
                }
            }
        });
    }
}