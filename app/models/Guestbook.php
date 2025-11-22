<?php
class Guestbook
{
    private $db;

    public function __construct($mysqli)
    {
        $this->db = $mysqli;
    }

    /**
     * Add a new guestbook entry
     */
    public function addEntry($name, $message)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO guestbook (name, message) VALUES (?, ?)"
        );
        $stmt->bind_param("ss", $name, $message);
        return $stmt->execute();
    }

    /**
     * Get all guestbook entries (newest first)
     */
    public function getEntries()
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
        return $entries;
    }

    /**
     * Find a single entry by ID
     */
    public function getEntryById($id)
    {
        $stmt = $this->db->prepare(
            "SELECT id, name, message, created_at
             FROM guestbook
             WHERE id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /**
     * Delete an entry by ID
     */
    public function deleteEntry($id)
    {
        $stmt = $this->db->prepare(
            "DELETE FROM guestbook WHERE id = ?"
        );
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
