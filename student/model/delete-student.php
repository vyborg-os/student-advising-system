<?php
require_once '../../config/config.php';
require_once APPROOT . '/database/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentId = $_POST['id'] ?? '';

    if (empty($studentId)) {
        echo json_encode(['error' => 'Student ID is required']);
        exit;
    }

    $db = new Database();
    $conn = $db->connect();

    $query = "DELETE FROM student WHERE student_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $studentId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to delete student']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Invalid request method']);
}