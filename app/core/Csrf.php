<?php

class Csrf
{
    public static function token(): string
    {
        Session::start();

        if (!Session::has('_csrf_token')) {

            Session::set(
                '_csrf_token',
                bin2hex(random_bytes(32))
            );
        }

        return Session::get('_csrf_token');
    }

    public static function verify(
        ?string $token
    ): bool {

        if (!$token) {
            return false;
        }

        $sessionToken = Session::get('_csrf_token');

        return $sessionToken &&
            hash_equals(
                $sessionToken,
                $token
            );
    }
}