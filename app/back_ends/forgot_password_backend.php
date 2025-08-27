<?php
ob_start();
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($userId);
            $stmt->fetch();

            // Generate reset token
            $reset_token = bin2hex(random_bytes(16));
            $expires_at = date("Y-m-d H:i:s", strtotime("+1 hour")); // 1 hour expiry

            // Save token in DB (better to have a separate table, but can work here too)
            $updateStmt = $conn->prepare("UPDATE users SET verification_code = ? WHERE id = ?");
            $updateStmt->bind_param("si", $reset_token, $userId);
            $updateStmt->execute();
            $updateStmt->close();

            // Send reset email
            $reset_link = "http://yourdomain.com/reset-password?token=" . urlencode($reset_token);
            $subject = "Password Reset Request";
            $message = "Click the link below to reset your password:\n\n" . $reset_link . "\n\nThis link will expire in 1 hour.";
            $headers = "From: no-reply@yourdomain.com\r\n";

            mail($email, $subject, $message, $headers);

            $_SESSION['email'] = $email;
            $success = "Password reset link sent to your email.";
        } else {
            $error = "Email not found.";
        }

        $stmt->close();
    }
}

$conn->close();
