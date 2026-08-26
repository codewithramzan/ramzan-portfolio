<?php

class Request
{
    public static function method(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
    }

    public static function uri(): string
    {
        return parse_url(
            $_SERVER['REQUEST_URI'] ?? '/',
            PHP_URL_PATH
        ) ?: '/';
    }

    public static function isPost(): bool
    {
        return self::method() === 'POST';
    }

    public static function input(
        string $key,
        mixed $default = null
    ): mixed {

        return $_POST[$key] ?? $default;
    }

    public static function all(): array
    {
        return $_POST;
    }

    public static function query(
        string $key,
        mixed $default = null
    ): mixed {

        return $_GET[$key] ?? $default;
    }

    public static function has(string $key): bool
    {
        return isset($_POST[$key]);
    }
}