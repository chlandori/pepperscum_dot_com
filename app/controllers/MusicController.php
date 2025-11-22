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
        session_start();

        if (empty($_SESSION['hit_music'])) {
            $this->hitCounter->recordHit('music');
            $_SESSION['hit_music'] = true;
        }

        $hitCounter = $this->hitCounter;
        $pageName   = 'music'; // current page
        $view = __DIR__ . '/../views/music/index.php';
        include __DIR__ . '/../views/layout.php';
    }
}