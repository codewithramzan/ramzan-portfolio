<?php

declare(strict_types=1);

class Session
{
    /**
     * Start the application session securely.
     */
    public static function start(): void
    {
        if (session_status() !== PHP_SESSION_NONE) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Session Cookie Security
        |--------------------------------------------------------------------------
        */

        session_set_cookie_params([
            'lifetime' => 0,

            'path' => '/',

            /*
            | Secure cookies are required in production HTTPS.
            | Local HTTP development needs this disabled.
            */
            'secure' => !APP_DEBUG,

            /*
            | Prevent JavaScript from accessing the session cookie.
            */
            'httponly' => true,

            /*
            | Helps protect against CSRF while allowing normal navigation.
            */
            'samesite' => 'Lax'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Session Name
        |--------------------------------------------------------------------------
        |
        | Avoid exposing PHP's default session cookie name.
        |
        */

        session_name('RAMZAN_PORTFOLIO_SESSION');

        /*
        |--------------------------------------------------------------------------
        | Start Session
        |--------------------------------------------------------------------------
        */

        session_start();
    }

    /**
     * Store a session value.
     */
    public static function set(
        string $key,
        mixed $value
    ): void {

        self::start();

        $_SESSION[$key] = $value;
    }

    /**
     * Retrieve a session value.
     */
    public static function get(
        string $key,
        mixed $default = null
    ): mixed {

        self::start();

        return $_SESSION[$key] ?? $default;
    }

    /**
     * Check whether a session value exists.
     */
    public static function has(
        string $key
    ): bool {

        self::start();

        return array_key_exists(
            $key,
            $_SESSION
        );
    }

    /**
     * Remove a session value.
     */
    public static function remove(
        string $key
    ): void {

        self::start();

        unset($_SESSION[$key]);
    }

    /**
     * Destroy the current session completely.
     */
    public static function destroy(): void
    {
        self::start();

        /*
        |--------------------------------------------------------------------------
        | Clear Session Data
        |--------------------------------------------------------------------------
        */

        $_SESSION = [];

        /*
        |--------------------------------------------------------------------------
        | Delete Session Cookie
        |--------------------------------------------------------------------------
        */

        if (ini_get('session.use_cookies')) {

            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                [
                    'expires' => time() - 42000,
                    'path' => $params['path'] ?? '/',
                    'domain' => $params['domain'] ?? '',
                    'secure' => (bool) (
                        $params['secure'] ?? false
                    ),
                    'httponly' => (bool) (
                        $params['httponly'] ?? true
                    ),
                    'samesite' => $params['samesite'] ?? 'Lax'
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Destroy Server-Side Session
        |--------------------------------------------------------------------------
        */

        session_destroy();
    }

    /**
     * Store a flash message.
     */
    public static function flash(
        string $key,
        mixed $message
    ): void {

        self::set(
            '_flash_' . $key,
            $message
        );
    }

    /**
     * Retrieve and remove a flash message.
     */
    public static function getFlash(
        string $key
    ): mixed {

        $sessionKey = '_flash_' . $key;

        $message = self::get(
            $sessionKey
        );

        self::remove(
            $sessionKey
        );

        return $message;
    }
}