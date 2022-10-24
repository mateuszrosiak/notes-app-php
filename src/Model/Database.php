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

    public function getAllNotes(): array
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

    public function getSpecificNote(int $id): array  {
        try {
            $sql = "SELECT id, title, note FROM notes WHERE id={$id}";

            $result = $this->conn->prepare($sql);
            $result->execute();

            $note = $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }

        return $note;
    }

    public function addNote(array $data): void
    {
        $title = $data['title'];
        $note = $data['note'];
        $today = date("Y-m-d H:i:s");

        try {
            $sql = "INSERT INTO notes (title, note, creationDate) VALUES ('$title', '$note', '$today')";

            $result = $this->conn->prepare($sql);
            $result->execute();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function updateExistingNote(int $noteId, array $data): void {
        try {
            $title = $data['title'];
            $note = $data['note'];

            $sql = "UPDATE notes SET title = '$title', note = '$note' WHERE id={$noteId}";

            $result = $this->conn->prepare($sql);
            $result->execute();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }


}