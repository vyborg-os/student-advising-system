<?php
require_once '../../config/config.php';
require_once APPROOT.'/database/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $class = $data['class'] ?? '';
    $year = $data['year'] ?? '';

    if (empty($class) || empty($year)) {
        echo json_encode(['success' => false, 'error' => 'Class/Academic year is required']);
        exit;
    }

    // Database connection
    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT student_id, student_name FROM student WHERE student_class = ? AND student_year = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $class, $year);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = ['id' => $row['student_id'], 'name' => $row['student_name']];
        }
        echo json_encode(['success' => true, 'students' => $students]);
    } else {
        echo json_encode(['success' => false, 'error' => 'No students found']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}