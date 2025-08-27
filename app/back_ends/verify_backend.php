<?php
ob_start();
session_start();
// Get un986id from URL
$un986id = $_GET['un986id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $un986id) {
    $verification = trim($_POST['verification']);

    // Fetch verification code securely
    $stmt = $conn->prepare("SELECT verification_code FROM users WHERE un986id = ? AND verified = 0");
    $stmt->bind_param("s", $un986id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $verCode = $row["verification_code"];

        if ($verification == $verCode) {
            // Update user as verified
            $updateStmt = $conn->prepare("UPDATE users SET verified = 1 WHERE un986id = ?");
            $updateStmt->bind_param("s", $un986id);

            if ($updateStmt->execute()) {
                $success = "Account verified successfully. You can now log in.";
                header("Location: ./");
                exit();
            } else {
                $error = "Error updating record. Please try again.";
            }

            $updateStmt->close();
        } else {
            $error = "Invalid verification code.";
        }
    } else {
        $error = "No pending verification found for this account.";
    }

    $stmt->close();
}

$conn->close();
