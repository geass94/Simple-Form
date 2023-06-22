<?php

namespace Model;

use Database\Database;
use PDO;

class EntryModel
{
    private $db;
    public function __construct() {
        $this->db = Database::getInstance();
    }
    public function saveEntry($data): int
    {
        $stmt = $this->db->prepare('INSERT INTO entries (data) VALUES (?)');
        $stmt->bindValue(1, $data, PDO::PARAM_STR);
        $stmt->execute();

        return $this->db->lastInsertId();
    }

    public function getEntry(int $id)
    {
        $stmt = $this->db->prepare('SELECT data FROM entries WHERE id = ?');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchColumn();
    }
}