<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_title = $_POST['task_title'] ?? '';
    $start_date = $_POST['start_date'] ?? '';
    $end_date = $_POST['end_date'] ?? '';
    $comp_uniqueId = $_POST['comp_uniqueId'] ?? '';
    $un986id_array = $_POST['un986id'] ?? [];
    $username_array = $_POST['username'] ?? [];

    if (count($un986id_array) !== count($username_array)) {
        die("Mismatch in staff data.");
    }

    function generateTaskId()
    {
        return uniqid('task_', true);
    }

    $stmt = $conn->prepare("INSERT INTO tasks (username, task_title, description, start_date, end_date, task_Id, un986id, comp_uniqueId) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $description = null;

    for ($i = 0; $i < count($un986id_array); $i++) {
        $username = $username_array[$i];
        $un986id = $un986id_array[$i];
        $task_Id = generateTaskId();
        $stmt->bind_param("ssssssss", $username, $task_title, $description, $start_date, $end_date, $task_Id, $un986id, $comp_uniqueId);
        $stmt->execute();
    }

    $stmt->close();
    echo "Tasks successfully added!";
}
