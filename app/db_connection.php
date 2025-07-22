<?php
ob_start();
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ./logout");
    exit();
}

require_once __DIR__ . '/config.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    error_log('Database connection failed: ' . $e->getMessage());
    http_response_code(500);
    exit('Internal Server Error');
}

//////////////////////////////////////////////////////////////////////////////////////
include_once('app_info.php');
//////////////////////////////////////////////////////////////////////////////////////
