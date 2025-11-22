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

switch ($page) {
    case 'guestbook':
        $controller = new GuestbookController($db);
        $controller->index();
        break;

    case 'music':
        $controller = new MusicController($db);
        $controller->index();
        break;

    default:
        $controller = new HomeController($db);
        $controller->index();
        break;
}