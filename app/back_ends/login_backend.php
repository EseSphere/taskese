<?php
ob_start();
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $stmt = $conn->prepare("SELECT `id`, `username`, `password`, `un986id`, `comp_uniqueId`, `verified` FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                if ($user['verified'] == 1) {

                    // Update last login + IP
                    $ip_address = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
                    $last_login = date("Y-m-d H:i:s");

                    $updateStmt = $conn->prepare("UPDATE users SET last_login = ?, ip_address = ? WHERE id = ?");
                    $updateStmt->bind_param("ssi", $last_login, $ip_address, $user['id']);
                    $updateStmt->execute();
                    $updateStmt->close();

                    // Set session variables
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $email;
                    $_SESSION['un986id'] = $user['un986id'];
                    $_SESSION['comp_uniqueId'] = $user['comp_uniqueId'];

                    // Redirect to dashboard or home
                    header("Location: ./dashboard");
                    exit();
                } else {
                    $error = "Account not verified. Please check your email for the verification code.";
                }
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "No user found with that email.";
        }

        $stmt->close();
    }
}

$conn->close();
