<?php

declare(strict_types=1);

class AuthToken extends Model
{
    public function createPasswordReset(
        int $userId,
        string $tokenHash,
        string $expiresAt
    ): void {
        $this->invalidatePasswordResets($userId);

        $this->query(
            "INSERT INTO password_reset_tokens
            (
                user_id,
                token_hash,
                expires_at
            )
            VALUES
            (
                :user_id,
                :token_hash,
                :expires_at
            )",
            [
                'user_id' => $userId,
                'token_hash' => $tokenHash,
                'expires_at' => $expiresAt,
            ]
        );
    }

    public function findValidPasswordReset(
        string $tokenHash
    ): ?array {
        return $this->fetch(
            "SELECT *
             FROM password_reset_tokens
             WHERE token_hash = :token_hash
             AND used_at IS NULL
             AND expires_at > NOW()
             LIMIT 1",
            ['token_hash' => $tokenHash]
        );
    }

    public function markPasswordResetUsed(int $id): void
    {
        $this->query(
            "UPDATE password_reset_tokens
             SET used_at = NOW()
             WHERE id = :id",
            ['id' => $id]
        );
    }

    public function invalidatePasswordResets(int $userId): void
    {
        $this->query(
            "UPDATE password_reset_tokens
             SET used_at = NOW()
             WHERE user_id = :user_id
             AND used_at IS NULL",
            ['user_id' => $userId]
        );
    }

    public function createVerification(
        int $userId,
        string $tokenHash,
        string $expiresAt
    ): void {
        $this->query(
            "UPDATE email_verification_tokens
             SET verified_at = NOW()
             WHERE user_id = :user_id
             AND verified_at IS NULL",
            ['user_id' => $userId]
        );

        $this->query(
            "INSERT INTO email_verification_tokens
            (
                user_id,
                token_hash,
                expires_at
            )
            VALUES
            (
                :user_id,
                :token_hash,
                :expires_at
            )",
            [
                'user_id' => $userId,
                'token_hash' => $tokenHash,
                'expires_at' => $expiresAt,
            ]
        );
    }

    public function findValidVerification(
        string $tokenHash
    ): ?array {
        return $this->fetch(
            "SELECT *
             FROM email_verification_tokens
             WHERE token_hash = :token_hash
             AND verified_at IS NULL
             AND expires_at > NOW()
             LIMIT 1",
            ['token_hash' => $tokenHash]
        );
    }

    public function markVerificationUsed(int $id): void
    {
        $this->query(
            "UPDATE email_verification_tokens
             SET verified_at = NOW()
             WHERE id = :id",
            ['id' => $id]
        );
    }
}
