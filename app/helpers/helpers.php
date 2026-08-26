<?php

function e(mixed $value): string
{
    return htmlspecialchars(
        (string) $value,
        ENT_QUOTES,
        'UTF-8'
    );
}

function asset(string $path): string
{
    return '/assets/' . ltrim($path, '/');
}

function url(string $path = ''): string
{
    $config = require BASE_PATH .
        '/config/config.php';

    return rtrim(
        $config['app_url'],
        '/'
    ) . '/' . ltrim($path, '/');
}