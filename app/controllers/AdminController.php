<?php
require_once __DIR__ . '/../models/HitCounter.php';
require_once __DIR__ . '/../config.php';

class AdminController
{
    private $hitCounter;

    public function __construct($db)
    {
        $this->hitCounter = new HitCounter($db);
    }

    public function login()
    {
        $hitCounter = $this->hitCounter; // make available to layout
        $view = __DIR__ . '/../views/admin/login.php';
        include __DIR__ . '/../views/layout.php';
    }

    public function authenticate()
    {
        session_start();
        $password = $_POST['password'] ?? '';

        if ($password === ($_ENV['ADMIN_PASSWORD'] ?? '')) {
            $_SESSION['is_admin'] = true;
            header("Location: /public/index.php?page=guestbook");
            exit;
        } else {
            $error = "Invalid password.";
            $hitCounter = $this->hitCounter;
            $view  = __DIR__ . '/../views/admin/login.php';
            include __DIR__ . '/../views/layout.php';
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();

        $hitCounter = $this->hitCounter;
        $view = __DIR__ . '/../views/admin/logout.php';
        include __DIR__ . '/../views/layout.php';
    }
}
