<?php

class Database
{
    private string $host = "db";
    private string $db_name = "FINDMYPAW_DB";
    private string $username = "root";
    private string $password = "root";

    public function connect(): PDO
    {
        $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";

        $pdo = new PDO(
            $dsn,
            $this->username,
            $this->password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );

        return $pdo;
    }
}