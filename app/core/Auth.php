<?php

class Auth
{
    /**
     * Store authenticated user information in the session.
     */
    public static function login(array $user): void
    {
        Session::start();

        /*
        |--------------------------------------------------------------------------
        | Prevent Session Fixation
        |--------------------------------------------------------------------------
        */

        session_regenerate_id(true);

        /*
        |--------------------------------------------------------------------------
        | Store Authentication Information
        |--------------------------------------------------------------------------
        */

        Session::set(
            'user_id',
            (int) $user['id']
        );

        Session::set(
            'role',
            $user['role_name']
        );

        Session::set(
            'user_name',
            $user['name']
        );

        Session::set(
            'user_email',
            $user['email']
        );
    }

    /**
     * Logout the current user.
     */
    public static function logout(): void
    {
        Session::destroy();
    }

    /**
     * Check whether a user is authenticated.
     */
    public static function check(): bool
    {
        return Session::has('user_id');
    }

    /**
     * Check whether the current user is a guest.
     */
    public static function guest(): bool
    {
        return !self::check();
    }

    /**
     * Get authenticated user's ID.
     */
    public static function id(): ?int
    {
        $id = Session::get('user_id');

        if ($id === null) {
            return null;
        }

        return (int) $id;
    }

    /**
     * Get authenticated user's role.
     */
    public static function role(): ?string
    {
        return Session::get('role');
    }

    /**
     * Check whether current user is an administrator.
     */
    public static function isAdmin(): bool
    {
        $roles = require BASE_PATH . '/config/roles.php';

        return self::role() === $roles['admin'];
    }

    /**
     * Check whether current user is a client.
     */
    public static function isClient(): bool
    {
        $roles = require BASE_PATH . '/config/roles.php';

        return self::role() === $roles['client'];
    }

    /**
     * Check whether current user has a specific role.
     */
    public static function hasRole(string $role): bool
    {
        return self::role() === $role;
    }
}