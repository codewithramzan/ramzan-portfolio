<?php

class LoginAttempt extends Model
{
    public function record(
        string $email,
        string $ip,
        bool $successful
    ): void {

        $this->query(
            "INSERT INTO login_attempts
            (
                email,
                ip_address,
                successful
            )
            VALUES
            (
                :email,
                :ip,
                :successful
            )",
            [
                'email' => $email,
                'ip' => $ip,
                'successful' => $successful ? 1 : 0
            ]
        );
    }

    public function recentFailures(
        string $email,
        string $ip
    ): int {

        $result = $this->fetch(
            "SELECT COUNT(*) AS total
             FROM login_attempts
             WHERE email = :email
             AND ip_address = :ip
             AND successful = 0
             AND attempted_at >=
                 DATE_SUB(NOW(), INTERVAL 15 MINUTE)",
            [
                'email' => $email,
                'ip' => $ip
            ]
        );

        return (int) ($result['total'] ?? 0);
    }
}