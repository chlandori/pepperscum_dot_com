<?php
namespace Chlandori\PepperscumDotCom\Service;

class Guestbook
{
    private \mysqli $db;

    public function __construct(\mysqli $mysqli)
    {
        $this->db = $mysqli;
    }

    public function addEntry(string $name, string $message): bool
    {
        if (strlen($name) > 50 || strlen($message) > 150) {
            return false; // or throw an exception
        }

        $stmt = $this->db->prepare(
            "INSERT INTO guestbook (name, message, created_at) VALUES (?, ?, NOW())"
        );
        $stmt->bind_param("ss", $name, $message);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function getEntries(): array
    {
        $result = $this->db->query(
            "SELECT id, name, message, created_at
             FROM guestbook
             ORDER BY created_at DESC"
        );

        $entries = [];
        while ($row = $result->fetch_assoc()) {
            $entries[] = $row;
        }
        $result->free();
        return $entries;
    }

    public function getEntryById(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT id, name, message, created_at
             FROM guestbook
             WHERE id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $entry  = $result->fetch_assoc() ?: null;
        $stmt->close();
        return $entry;
    }

    public function deleteEntry(int $id): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM guestbook WHERE id = ?"
        );
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
}
