<?php
// config/db.php
$config = require __DIR__ . '/config.php';
$db = $config['db'];

try {
    $pdo = new PDO(
        "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8",
        $db['user'],
        $db['pass'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    // In production, you would log this instead of echoing
    die('Database connection failed: ' . $e->getMessage());
}

// helper used with prepared statements
function safeQuery($pdo, $sql, $params = []) {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt;
}
