<?php
require_once __DIR__ . '/../models/Guestbook.php';
require_once __DIR__ . '/../models/HitCounter.php'; // optional if you want footer hits
require_once __DIR__ . '/../config.php';

class GuestbookController
{
    private $db;
    private $guestbook;
    private $hitCounter;

    public function __construct($db)
    {
        $this->db = $db;
        $this->guestbook  = new Guestbook($db);
        $this->hitCounter = new HitCounter($db); // make available to footer
    }

    /**
     * Show all guestbook entries
     */
    public function index()
    {
        session_start(); // resume session

        if (empty($_SESSION['hit_guestbook'])) {
            $this->hitCounter->recordHit('guestbook');
            $_SESSION['hit_guestbook'] = true;
        }

        $entries    = $this->guestbook->getEntries();
        $hitCounter = $this->hitCounter; // pass into layout/footer
        $pageName   = 'guestbook'; // current page
        $view       = __DIR__ . '/../views/guestbook/index.php';

        include __DIR__ . '/../views/layout.php';
    }

    /**
     * Handle new entry submission
     */
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name    = trim($_POST['name']);
            $message = trim($_POST['message']);

            if (!empty($name) && !empty($message)) {
                $this->guestbook->addEntry($name, $message);
                header("Location: index.php?page=guestbook");
                exit;
            } else {
                $error      = "Name and message are required.";
                $hitCounter = $this->hitCounter;
                $view       = __DIR__ . '/../views/guestbook/index.php';

                include __DIR__ . '/../views/layout.php';
            }
        }
    }

    /**
     * Show a single entry
     */
    public function show($id)
    {
        $entry      = $this->guestbook->getEntryById($id);
        $hitCounter = $this->hitCounter;
        $view       = __DIR__ . '/../views/guestbook/show.php';

        include __DIR__ . '/../views/layout.php';
    }

    /**
     * Delete an entry
     */
    public function delete($id)
    {
        session_start();
        if (empty($_SESSION['is_admin'])) {
            die("Unauthorized");
        }

        $this->guestbook->deleteEntry($id);
        header("Location: index.php?page=guestbook");
        exit;
    }
}
