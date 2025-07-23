<?php
// Database connection
include_once('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_title = trim($_POST['task_title']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $staff_ids = $_POST['staff_ids'] ?? [];

    if (empty($task_title) || empty($start_date) || empty($end_date) || empty($staff_ids)) {
        die("All fields are required.");
    }

    // Insert task
    $stmt = $conn->prepare("INSERT INTO tasks (task_title, start_date, end_date) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $task_title, $start_date, $end_date);

    if ($stmt->execute()) {
        $task_id = $stmt->insert_id;
        $stmt->close();

        // Insert staff mapping
        $map_stmt = $conn->prepare("INSERT INTO task_staff_map (task_id, staff_id) VALUES (?, ?)");
        foreach ($staff_ids as $staff_id) {
            $map_stmt->bind_param("ii", $task_id, $staff_id);
            $map_stmt->execute();
        }
        $map_stmt->close();

        echo "<div class='alert alert-success'>Task successfully created and assigned!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error creating task: " . $stmt->error . "</div>";
    }
}

$conn->close();
