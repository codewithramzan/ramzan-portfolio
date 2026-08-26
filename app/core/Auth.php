<?php

class Auth
{
    public static function login(array $user): void
    {
        Session::start();

        session_regenerate_id(true);

        Session::set('user_id', $user['id']);
        Session::set('role_id', $user['role_id']);
        Session::set('user_name', $user['name']);
        Session::set('user_email', $user['email']);
    }

    public static function logout(): void
    {
        Session::destroy();
    }

    public static function check(): bool
    {
        return Session::has('user_id');
    }

    public static function guest(): bool
    {
        return !self::check();
    }

    public static function id(): ?int
    {
        $id = Session::get('user_id');

        return $id !== null ? (int) $id : null;
    }

    public static function roleId(): ?int
    {
        $role = Session::get('role_id');

        return $role !== null ? (int) $role : null;
    }

    public static function isAdmin(): bool
    {
        return self::roleId() === 1;
    }

    public static function isClient(): bool
    {
        return self::roleId() === 2;
    }
}