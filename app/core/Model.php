<?php

class Model
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    protected function query(string $sql, array $params = []): PDOStatement
    {
        $statement = $this->db->prepare($sql);
        $statement->execute($params);

        return $statement;
    }

    protected function fetch(string $sql, array $params = []): ?array
    {
        $statement = $this->query($sql, $params);

        $result = $statement->fetch();

        return $result ?: null;
    }

    protected function fetchAll(string $sql, array $params = []): array
    {
        return $this->query($sql, $params)->fetchAll();
    }

    protected function execute(string $sql, array $params = []): bool
    {
        return $this->query($sql, $params) !== false;
    }

    protected function lastInsertId(): string
    {
        return $this->db->lastInsertId();
    }
}