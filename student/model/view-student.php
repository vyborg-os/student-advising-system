<?php
require_once '../../config/config.php';
require_once APPROOT . '/database/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentId = $_POST['id'] ?? '';
    $class = $_POST['class'] ?? '';
    $year = $_POST['year'] ?? '';

    if (empty($studentId)) {
        echo json_encode(['error' => 'Student ID is required']);
        exit;
    }

    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT * FROM student WHERE student_id = ? AND student_class = ? AND student_year = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $studentId, $class, $year);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if ($student) {
        echo json_encode(['success' => true, 'student' => $student]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Student not found']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Invalid request method']);
}