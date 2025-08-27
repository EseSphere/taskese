<?php
ob_start();
session_start();

// Reset password using token from email
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $confirm = $_POST['cpassword'];
    $token = $_GET['token'] ?? null;

    if ($password !== $confirm) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } elseif (!$token) {
        $error = "Invalid or missing reset token.";
    } else {
        // Verify token
        $stmt = $conn->prepare("SELECT id, email FROM users WHERE verification_code = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $email = $user['email'];
            $userId = $user['id'];

            // Hash new password
            $hashed = password_hash($password, PASSWORD_DEFAULT);

            // Update password & clear reset token
            $updateStmt = $conn->prepare("UPDATE users SET password = ?, verification_code = NULL WHERE id = ?");
            $updateStmt->bind_param("si", $hashed, $userId);

            if ($updateStmt->execute()) {
                $success = "Password has been reset. You may now sign in.";
                // Optionally clear session
                session_unset();
            } else {
                $error = "Failed to update password. Please try again.";
            }

            $updateStmt->close();
        } else {
            $error = "Invalid or expired reset link.";
        }

        $stmt->close();
    }
}

$conn->close();
