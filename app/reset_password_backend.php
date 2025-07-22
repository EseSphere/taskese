<?php
ob_start();
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $confirm = $_POST['cpassword'];

    if ($password !== $confirm) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } elseif (!isset($_SESSION['email'])) {
        $error = "Session expired. Please restart the reset process.";
    } else {
        $email = $_SESSION['email'];

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE `users` SET `password` = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashed, $email);

        if ($stmt->execute()) {
            $success = "Password has been reset. You may now sign in.";
            // Optionally, clear the session email
            unset($_SESSION['email']);
        } else {
            $error = "Failed to update password. Please try again.";
        }

        $stmt->close();
    }
}
