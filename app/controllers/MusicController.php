<?php
require_once __DIR__ . '/../models/HitCounter.php'; // optional if you want footer hits
require_once __DIR__ . '/../config.php';
class MusicController
{
    private $db;
    private $hitCounter;

    public function __construct($db)
    {
        $this->db = $db;
        $this->hitCounter = new HitCounter($db);
    }

    public function index()
    {
        $hitCounter = $this->hitCounter;
        // Point to the view file
        $view = __DIR__ . '/../views/music/index.php';

        // Let layout.php handle injecting the view
        include __DIR__ . '/../views/layout.php';
    }
}