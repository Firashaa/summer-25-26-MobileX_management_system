<?php
// ================================================================
// CONFIG - database connection, session setup and app settings
// Uses the supplied shop_db schema. Nothing is auto-created/seeded.
// ================================================================

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'shop_db');
define('DB_PORT', 3306);

define('APP_NAME', 'MobiTrackk');
define('SESSION_TIMEOUT', 1800);

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

$db_error = '';
$conn = null;

if (!extension_loaded('mysqli')) {
    $db_error = 'mysqli extension is not enabled.';
} else {
    mysqli_report(MYSQLI_REPORT_OFF);
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    if (!$conn) {
        $db_error = 'Database connection failed. Import database.sql into shop_db and check config/config.php. MySQL: ' . mysqli_connect_error();
    } else {
        mysqli_set_charset($conn, 'utf8mb4');
    }
}
