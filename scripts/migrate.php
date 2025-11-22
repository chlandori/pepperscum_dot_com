<?php
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Connect using environment variables
$mysqli = new mysqli(
    $_ENV['DB_HOST'],
    $_ENV['DB_USER'],
    $_ENV['DB_PASS'],
    $_ENV['DB_NAME']
);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Guestbook table
$guestbook = "
CREATE TABLE IF NOT EXISTS guestbook (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
";

// Hit counter table
$hitcounter = "
CREATE TABLE IF NOT EXISTS hit_counter (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page VARCHAR(255) NOT NULL,
    hits INT DEFAULT 0,
    last_hit TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;
";

// Run migrations
if ($mysqli->query($guestbook) === TRUE) {
    echo "Guestbook table ready.\n";
} else {
    echo "Error creating guestbook: " . $mysqli->error . "\n";
}

if ($mysqli->query($hitcounter) === TRUE) {
    echo "Hit counter table ready.\n";
} else {
    echo "Error creating hit counter: " . $mysqli->error . "\n";
}

$mysqli->close();
?>