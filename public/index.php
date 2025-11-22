<?php
// Autoload controllers and models
spl_autoload_register(function ($class) {
    $paths = ['../app/controllers/', '../app/models/'];
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Load config (creates $db)
require_once __DIR__ . '/../app/config.php';

// Basic routing
$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ??'';
switch ($page) {
    case 'admin':
        $controller = new AdminController($db);
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
        $controller = new GuestbookController($db);
        if ($action === 'store') {
            $controller->store();
        } elseif ($action === 'delete' && !empty($id)) {
            $controller->delete($id);
        } else {
            $controller->index();
        }
        break;

    case 'music':
        $controller = new MusicController($db);
        $controller->index();
        break;
    case 'privacy':
        $controller = new PrivacyController($db);
        $controller->index();
        break;
    default:
        $controller = new HomeController($db);
        $controller->index();
        break;
}