<?php
namespace Chlandori\PepperscumDotCom\Controller;

use Chlandori\PepperscumDotCom\Service\Guestbook;
use Chlandori\PepperscumDotCom\Service\HitCounter;

class GuestbookController
{
    private $guestbook;
    private $hitCounter;

    public function __construct(Guestbook $guestbook, HitCounter $hitCounter)
    {
        $this->guestbook  = $guestbook;
        $this->hitCounter = $hitCounter;
    }

    public function index(): void
    {
        session_start();

        if (empty($_SESSION['hit_guestbook'])) {
            $this->hitCounter->recordHit('guestbook');
            $_SESSION['hit_guestbook'] = true;
        }

        $entries  = $this->guestbook->getEntries();
        $pageName = 'guestbook';

        $hitCounter = $this->hitCounter;
        $view = __DIR__ . '/../../app/views/guestbook/index.php';
        include __DIR__ . '/../../app/views/layout.php';
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name    = trim($_POST['name']);
            $message = trim($_POST['message']);

            if (!empty($name) && !empty($message)) {
                $this->guestbook->addEntry($name, $message);
                header("Location: /public/index.php?page=guestbook");
                exit;
            } else {
                $error = "Name and message are required.";
                $pageName = 'guestbook';
                $entries  = $this->guestbook->getEntries();
                $hitCounter = $this->hitCounter;
                $view = __DIR__ . '/../../app/views/guestbook/index.php';
                include __DIR__ . '/../../app/views/layout.php';
            }
        }
    }

    public function delete(int $id): void
    {
        session_start();
        if (empty($_SESSION['is_admin'])) {
            die("Unauthorized");
        }

        $this->guestbook->deleteEntry($id);
        header("Location: /public/index.php?page=guestbook");
        exit;
    }
}
