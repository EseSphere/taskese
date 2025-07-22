<?php
ob_start();
session_start();
if (isset($_GET['un986id'])) {
    $un986id = $_GET['un986id'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $verification = trim($_POST['verification']);

    $sql = "SELECT verification_code FROM users WHERE un986id = '$un986id' AND verified = 0";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $verCode = $row["verification_code"];
        if ($verification == $verCode) {
            $updateSql = "UPDATE users SET verified = 1 WHERE un986id = '$un986id'";
            if ($conn->query($updateSql) === TRUE) {
                $success = "Account verified successfully. You can now log in.";
                header("Location: ./");
                exit();
            } else {
                $error = "Error updating record: " . $conn->error;
            }
        } else {
            $error = "Invalid verification code.";
        }
    } else {
        echo "No records found.";
    }
}

$conn->close();
