<?php

namespace App\Model;

use PDO;
use PDOException;

class Database
{
    public function __construct(array $config)
    {
        try {
            $this->createConnection($config);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    private function createConnection(array $config): void
    {
        $dsn
            = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8";

        $this->conn = new PDO(
            $dsn, $config['username'], $config['password'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]
        );
    }

    public function getAttNotes(): array
    {
        try {
            $sql = "SELECT id,title,note,creationDate FROM notes";

            $result = $this->conn->prepare($sql);
            $result->execute();

            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
}