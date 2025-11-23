<?php
require_once __DIR__ . '/config.php';

echo "\n";
echo "=============================================\n";
echo "   PEPPERSCUM.COM MIGRATION CONSOLE v1.0     \n";
echo "=============================================\n";
echo ">> INITIATING MIGRATION SEQUENCE...\n\n";

// 🔽 LOADING BAR GOES HERE
for ($i = 0; $i <= 20; $i++) {
    echo "[" . str_repeat("=", $i) . str_repeat(" ", 20 - $i) . "]\r";
    usleep(100000); // 0.1s delay
}
echo "\n>> MIGRATION ENGINES ONLINE.\n\n";

// Now run your SQL
$sql = "
CREATE TABLE IF NOT EXISTS guestbook (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    message VARCHAR(150) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
";

if ($db->query($sql) === TRUE) {
    echo ">> Guestbook table migrated successfully.\n";
} else {
    echo "!! ERROR: " . $db->error . "\n";
}

$sqlAlter = "ALTER TABLE guestbook MODIFY message VARCHAR(150) NOT NULL;";
if ($db->query($sqlAlter) === TRUE) {
    echo ">> Column 'message' capped at 150 characters.\n";
} else {
    echo ">> Column already capped or alter failed: " . $db->error . "\n";
}

echo "\n";
echo "=============================================\n";
echo "   MIGRATION COMPLETE — SYSTEM STABLE         \n";
echo "=============================================\n";
echo ">> READY FOR NEXT COMMAND...\n";
