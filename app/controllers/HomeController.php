<?php
require_once __DIR__ . '/../models/HitCounter.php'; // optional if you want footer hits
require_once __DIR__ . '/../config.php';

class HomeController
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

        if (empty($_SESSION['hit_home'])) {
            $this->hitCounter->recordHit('home');
            $_SESSION['hit_home'] = true;
        }

        $hitCounter = $this->hitCounter;
        $pageName   = 'home'; // current page
        $view = __DIR__ . '/../views/home/index.php';
        include __DIR__ . '/../views/layout.php';
    }
}