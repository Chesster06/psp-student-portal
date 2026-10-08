<?php

$isLive = !in_array($_SERVER['HTTP_HOST'] ?? 'localhost', ['localhost', '127.0.0.1'], true)
          && strpos($_SERVER['HTTP_HOST'] ?? '', 'localhost:') !== 0;

if ($isLive) {
    $dbHost = getenv('DB_HOST') ?: 'sql309.infinityfree.com';
    $dbUser = getenv('DB_USER') ?: 'if0_43120448';
    $dbPass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : 'PSPPortal123';
    $dbName = getenv('DB_NAME') ?: 'if0_43120448_psp_portal';
    $dbPort = getenv('DB_PORT') ?: '3306';
} else {
    $dbHost = getenv('DB_HOST') ?: 'localhost';
    $dbUser = getenv('DB_USER') ?: 'root';
    $dbPass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
    $dbName = getenv('DB_NAME') ?: 'psp_portal';
    $dbPort = getenv('DB_PORT') ?: '3307';
}

define('DB_HOST', $dbHost);
define('DB_USER', $dbUser);
define('DB_PASS', $dbPass);
define('DB_NAME', $dbName);
define('DB_PORT', $dbPort);

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $this->conn = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
