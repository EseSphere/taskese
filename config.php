<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {
    http_response_code(403);
    exit('Access denied');
}

define('DB_HOST', 'localhost');
define('DB_USER', 'root');      // Replace with your database username
define('DB_PASS', '');      // Replace with your database password
define('DB_NAME', 'taskese');      // Replace with your database name
