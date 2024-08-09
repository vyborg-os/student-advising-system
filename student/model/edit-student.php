<?php
require_once '../../config/config.php';
require_once APPROOT . '/database/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentId = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $dob = $_POST['dob'] ?? '';

    if (empty($studentId) || empty($name) || empty($dob)) {
        echo json_encode(['success' => false, 'error' => 'All fields are required']);
        exit;
    }

    $db = new Database();
    $conn = $db->connect();

    $query = "UPDATE student SET student_name = ?, student_dob = ? WHERE student_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $name, $dob, $studentId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to update student']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Invalid request method']);
}