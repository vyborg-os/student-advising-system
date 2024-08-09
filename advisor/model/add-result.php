<?php
require_once '../../config/config.php';
require_once APPROOT.'/database/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student = $_POST['studentName'] ?? '';
    // Explode the selected student to get ID and Name
    $studentParts = explode(" - ", $student);
    if (count($studentParts) !== 2) {
        echo json_encode(['success' => false, 'error' => 'Invalid student selection']);
        exit;
    }
    $studentId = $studentParts[0];
    $student_name = $studentParts[1];
    
    $subject = $_POST['subject'] ?? '';
    $score = $_POST['score'] ?? '';
    $class = $_POST['studentClass'] ?? '';
    $academicYear = $_POST['academicYear'] ?? '';
    $term = $_POST['term'] ?? '';

    if (empty($studentId) || empty($subject) || empty($score) || empty($class) || empty($academicYear) || empty($term)) {
        echo json_encode(['success' => false, 'error' => 'All fields are required']);
        exit;
    }

    $db = new Database();
    $conn = $db->connect();

    // Define the table name based on academic year
    $tableName = "results_" . str_replace("/", "_", $academicYear);

    // Check if the table exists and create it if not
    $createTableQuery = "
        CREATE TABLE IF NOT EXISTS $tableName (
            id INT AUTO_INCREMENT PRIMARY KEY,
            student_id INT NOT NULL,
            student_name VARCHAR(255) NOT NULL,
            student_class VARCHAR(255) NOT NULL,
            subject VARCHAR(255) NOT NULL,
            score VARCHAR(255) NOT NULL,
            academic_year VARCHAR(255) NOT NULL,
            term VARCHAR(255) NOT NULL,
            UNIQUE KEY unique_record (student_id, subject, academic_year, term)
        )";
    $conn->query($createTableQuery);

    // Insert or update records
    $query = "INSERT INTO $tableName (student_id, student_name, student_class, subject, score, academic_year, term) VALUES (?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE score = VALUES(score)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issssss", $studentId, $student_name, $class, $subject, $score, $academicYear, $term);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error adding result']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}