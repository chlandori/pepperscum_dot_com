<?php
namespace Chlandori\PepperscumDotCom\Service;

class HitCounter
{
    private $db;

    public function __construct($mysqli)
    {
        $this->db = $mysqli;
    }

    public function recordHit($page)
    {
        // Try to update existing row
        $stmt = $this->db->prepare("UPDATE hit_counter 
                                    SET hits = hits + 1, last_hit = NOW() 
                                    WHERE page = ?");
        $stmt->bind_param("s", $page);
        $stmt->execute();

        // If no rows updated, insert a new one
        if ($stmt->affected_rows === 0) {
            $stmt = $this->db->prepare("INSERT INTO hit_counter (page, hits, last_hit) VALUES (?, 1, NOW())");
            $stmt->bind_param("s", $page);
            $stmt->execute();
        }

        $stmt->close();
    }

    public function getHits($page)
    {
        $stmt = $this->db->prepare(
            "SELECT hits FROM hit_counter WHERE page = ?"
        );
        $stmt->bind_param("s", $page);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result ? $result['hits'] : 0;
    }
}
