<?php

declare(strict_types=1);

class LoginAttempt extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Configuration
    |--------------------------------------------------------------------------
    */

    private const MAX_ATTEMPTS = 5;

    private const WINDOW_MINUTES = 15;


    /**
     * Determine whether login attempts are currently blocked.
     *
     * We check BOTH:
     *
     * 1. Email + IP combination
     * 2. IP address
     *
     * This prevents a user from bypassing the protection simply by
     * changing the email address repeatedly.
     */
    public function isBlocked(
        string $email,
        string $ipAddress,
        string $role
    ): bool {

        $emailAttempts = $this->countRecentAttempts(
            $email,
            $ipAddress,
            $role,
            true
        );

        if ($emailAttempts >= self::MAX_ATTEMPTS) {
            return true;
        }

        $ipAttempts = $this->countRecentAttempts(
            $email,
            $ipAddress,
            $role,
            false
        );

        return $ipAttempts >= self::MAX_ATTEMPTS;
    }


    /**
     * Record a failed login attempt.
     */
    public function record(
        string $email,
        string $ipAddress,
        string $role
    ): void {

        $this->query(
            "INSERT INTO login_attempts
            (
                email,
                ip_address,
                role,
                attempted_at
            )
            VALUES
            (
                :email,
                :ip_address,
                :role,
                NOW()
            )",
            [
                'email' => $email,
                'ip_address' => $ipAddress,
                'role' => $role
            ]
        );
    }


    /**
     * Clear previous failed attempts after successful login.
     */
    public function clear(
        string $email,
        string $ipAddress,
        string $role
    ): void {

        $this->query(
            "DELETE FROM login_attempts
             WHERE email = :email
             AND ip_address = :ip_address
             AND role = :role",
            [
                'email' => $email,
                'ip_address' => $ipAddress,
                'role' => $role
            ]
        );
    }


    /**
     * Count recent attempts.
     *
     * When $matchEmail is true:
     *     email + IP + role are checked.
     *
     * When false:
     *     only IP + role are checked.
     */
    private function countRecentAttempts(
        string $email,
        string $ipAddress,
        string $role,
        bool $matchEmail
    ): int {

        if ($matchEmail) {

            $result = $this->fetch(
                "SELECT COUNT(*) AS total
                 FROM login_attempts
                 WHERE email = :email
                 AND ip_address = :ip_address
                 AND role = :role
                 AND attempted_at >= (
                     NOW() - INTERVAL "
                     . self::WINDOW_MINUTES .
                     " MINUTE
                 )",
                [
                    'email' => $email,
                    'ip_address' => $ipAddress,
                    'role' => $role
                ]
            );

        } else {

            $result = $this->fetch(
                "SELECT COUNT(*) AS total
                 FROM login_attempts
                 WHERE ip_address = :ip_address
                 AND role = :role
                 AND attempted_at >= (
                     NOW() - INTERVAL "
                     . self::WINDOW_MINUTES .
                     " MINUTE
                 )",
                [
                    'ip_address' => $ipAddress,
                    'role' => $role
                ]
            );
        }

        return (int) (
            $result['total'] ?? 0
        );
    }
}