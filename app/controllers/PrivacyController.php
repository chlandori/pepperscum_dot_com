<?php
require_once __DIR__ . '/../models/HitCounter.php'; // optional if you want footer hits
require_once __DIR__ . '/../config.php';
class PrivacyController
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

        if (empty($_SESSION['hit_privacy'])) {
            $this->hitCounter->recordHit('privacy');
            $_SESSION['hit_privacy'] = true;
        }

        $hitCounter = $this->hitCounter;
        $pageName   = 'privacy'; // current page
        $view = __DIR__ . '/../views/privacy/index.php';
        include __DIR__ . '/../views/layout.php';
    }
}