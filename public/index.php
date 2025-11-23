<?php
// Use Composer autoload
require_once __DIR__ . '/../vendor/autoload.php';

// Load config (creates $db)
require_once __DIR__ . '/../app/config.php';

use Chlandori\PepperscumDotCom\Controller\{
    AdminController,
    GuestbookController,
    HomeController,
    MusicController,
    PrivacyController
};
use Chlandori\PepperscumDotCom\Service\{
    HitCounter,
    Guestbook
};

// Shared services
$hitCounter = new HitCounter($db);
$guestbook  = new Guestbook($db);

// Routing
$page   = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? 'index';
$id     = $_GET['id'] ?? '';

switch ($page) {
    case 'admin':
        $controller = new AdminController($db, $hitCounter);
        if ($action === 'authenticate') {
            $controller->authenticate();
        } elseif ($action === 'logout') {
            $controller->logout();
        } elseif ($action === 'panel') {
            $controller->panel();
        } else {
            $controller->login();
        }
        break;

    case 'guestbook':
        $controller = new GuestbookController($guestbook, $hitCounter);
        if ($action === 'store') {
            $controller->store();
        } elseif ($action === 'delete' && !empty($id)) {
            $controller->delete((int)$id);
        } else {
            $controller->index();
        }
        break;

    case 'music':
        $controller = new MusicController($hitCounter);
        $controller->index();
        break;

    case 'privacy':
        $controller = new PrivacyController($hitCounter);
        $controller->index();
        break;

    default:
        $controller = new HomeController($hitCounter);
        $controller->index();
        break;
}
