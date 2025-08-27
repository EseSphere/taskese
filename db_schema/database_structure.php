<?php
$host = "localhost";   // your database host
$user = "root";        // your database username
$pass = "";            // your database password
$dbname = "taskese"; // your database name

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create enhanced users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,

    -- Verification & account status
    verified TINYINT(1) DEFAULT 0,
    verification_code VARCHAR(255) DEFAULT NULL,
    status ENUM('active','inactive','banned') DEFAULT 'active',

    -- Unique IDs
    un986id VARCHAR(100) DEFAULT NULL,
    comp_uniqueId VARCHAR(100) DEFAULT NULL,

    -- Profile details
    first_name VARCHAR(100) DEFAULT NULL,
    last_name VARCHAR(100) DEFAULT NULL,
    phone VARCHAR(20) DEFAULT NULL,
    profile_image VARCHAR(255) DEFAULT NULL,

    -- Metadata
    role ENUM('user','admin','moderator') DEFAULT 'user',
    ip_address VARCHAR(45) DEFAULT NULL, -- supports both IPv4 and IPv6
    last_login DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created successfully with extra columns";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
