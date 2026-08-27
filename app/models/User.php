<?php

class User extends Model
{
    public function findByEmail(string $email): ?array
    {
        return $this->fetch(
            "SELECT
                u.*,
                r.name AS role_name
             FROM users u
             INNER JOIN roles r
                ON r.id = u.role_id
             WHERE u.email = :email
             LIMIT 1",
            [
                'email' => $email
            ]
        );
    }
    public function findById(int $id): ?array
    {
        return $this->fetch(
            "SELECT
                u.*,
                r.name AS role_name
            FROM users u
            INNER JOIN roles r
                ON r.id = u.role_id
            WHERE u.id = :id
            LIMIT 1",
            [
                'id' => $id
            ]
        );
    }

    public function emailExists(string $email): bool
    {
        $user = $this->fetch(
            "SELECT id
             FROM users
             WHERE email = :email
             LIMIT 1",
            [
                'email' => $email
            ]
        );

        return $user !== null;
    }

    public function createClient(
        string $name,
        string $email,
        string $phone,
        string $password
    ): int {

        $hashedPassword = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $this->query(
            "INSERT INTO users
            (
                role_id,
                name,
                email,
                phone,
                password,
                status
            )
            VALUES
            (
                2,
                :name,
                :email,
                :phone,
                :password,
                'active'
            )",
            [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => $hashedPassword
            ]
        );

        return (int) $this->lastInsertId();
    }

    public function updateLastLogin(int $id): void
    {
        $this->query(
            "UPDATE users
             SET last_login = NOW()
             WHERE id = :id",
            [
                'id' => $id
            ]
        );
    }
}