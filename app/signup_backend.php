<?php
ob_start();
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $verified = 0;

    function generateUniqueId($length = 12)
    {
        return bin2hex(random_bytes($length));
    }

    $unique_id = generateUniqueId(8);
    $random = bin2hex(random_bytes(8));
    $initials = strtoupper(substr($username, 0, 1)) . strtoupper(substr($email, 0, 1));
    $id = random_int(10000000, 99999999);

    $sql = "SELECT COUNT(*) as total FROM users";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        $totalRows = $row['total'] ?? 0;
        $un986id = $unique_id . '-' . $random . '-' . $initials . 'i045' . ($totalRows + 1);
        $comp_uniqueId = $unique_id . '-' . $random . '-' . $id . '-' . $initials . 'i95' . ($totalRows + 1);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format.";
        } elseif (strlen($password) < 6) {
            $error = "Password must be at least 6 characters.";
        } else {
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $error = "Email already registered.";
            } else {
                $verification_code = random_int(100000, 999999);
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (`username`, `email`, `verified`, `verification_code`, `password`, `un986id`, `comp_uniqueId`) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssiisss", $username, $email, $verified, $verification_code, $hashed_password, $un986id, $comp_uniqueId);
                if ($stmt->execute()) {
                    $_SESSION['email'] = $email;
                    $_SESSION['un986id'] = $un986id;
                    $_SESSION['comp_uniqueId'] = $comp_uniqueId;

                    $subject = "Verify Your Account";
                    $message = "Your verification code is: " . $verification_code;
                    $headers = "From: no-reply@yourdomain.com\r\n";
                    mail($email, $subject, $message, $headers);

                    $success = "Registration successful. Verification code sent to your email.";
                    header("Location: ./verify?un986id=" . urlencode($un986id));
                    exit();
                } else {
                    $error = "Something went wrong. Please try again.";
                }
            }

            $stmt->close();
        }
    } else {
        $error = "Database query failed.";
    }
}

$conn->close();
