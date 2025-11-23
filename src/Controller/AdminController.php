<?php
namespace Chlandori\PepperscumDotCom\Controller;

use Chlandori\PepperscumDotCom\Service\HitCounter;

class AdminController
{
    private $db;
    private $hitCounter;

    public function __construct(\mysqli $db, HitCounter $hitCounter)
    {
        $this->db        = $db;
        $this->hitCounter = $hitCounter;
    }

    public function login(): void
    {
        $hitCounter = $this->hitCounter;
        $pageName   = 'admin';
        $view       = __DIR__ . '/../../app/views/admin/login.php';
        include __DIR__ . '/../../app/views/layout.php';
    }

    public function authenticate(): void
    {
        session_start();
        $password = $_POST['password'] ?? '';

        if ($password === ($_ENV['ADMIN_PASSWORD'] ?? '')) {
            $_SESSION['is_admin'] = true;
            header("Location: /public/index.php?page=guestbook");
            exit;
        } else {
            $error      = "Invalid password.";
            $hitCounter = $this->hitCounter;
            $pageName   = 'admin';
            $view       = __DIR__ . '/../../app/views/admin/login.php';
            include __DIR__ . '/../../app/views/layout.php';
        }
    }

    public function logout(): void
    {
        session_start();
        session_destroy();

        $hitCounter = $this->hitCounter;
        $pageName   = 'admin';
        $view       = __DIR__ . '/../../app/views/admin/logout.php';
        include __DIR__ . '/../../app/views/layout.php';
    }

    public function panel(): void
    {
        session_start();
        if (empty($_SESSION['is_admin'])) {
            die("Unauthorized");
        }

        // Gather stats
        $entriesCount      = $this->getEntriesCount();
        $homeHitsCount     = $this->hitCounter->getHits('home');
        $musicHitsCount    = $this->hitCounter->getHits('music');
        $guestbookHitsCount= $this->hitCounter->getHits('guestbook');
        $privacyHitsCount  = $this->hitCounter->getHits('privacy');

        $hitCounter = $this->hitCounter;
        $pageName   = 'admin';
        $view = __DIR__ . '/../../app/views/admin/panel.php';
        include __DIR__ . '/../../app/views/layout.php';
    }

    private function getEntriesCount(): int
    {
        $stmt = $this->db->query("SELECT COUNT(*) AS cnt FROM guestbook");
        $row  = $stmt->fetch_assoc();
        return (int)($row['cnt'] ?? 0);
    }
}
