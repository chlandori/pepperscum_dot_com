<?php
class HitCounter
{
    private $db;

    public function __construct($mysqli)
    {
        $this->db = $mysqli;
    }

    public function increment($page)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO hit_counter (page, hits) VALUES (?, 1)
             ON DUPLICATE KEY UPDATE hits = hits + 1, last_hit = CURRENT_TIMESTAMP"
        );
        $stmt->bind_param("s", $page);
        $stmt->execute();
    }

    public function getHits($page)
    {
        $stmt = $this->db->prepare(
            "SELECT hits FROM hit_counter WHERE page = ?"
        );
        $stmt->bind_param("s", $page);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result ? $result['hits'] : 0;
    }
}