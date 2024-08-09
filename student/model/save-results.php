<?php
    require_once '../../config/config.php';
    require_once APPROOT . '/database/db.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');

    $db = new Database();
    $conn = $db->connect();

    // Check if the request is for bulk upload
    if (isset($_POST['submit'])) {
        $student_id = $_POST['student_id'];
        $student_name = $_POST['student_name'];
        $student_class = $_POST['student_class'];
        $subjects = $_POST['subjects'];
        $academicYear = $_POST['academicYear'];
        $term = $_POST['term'];

        if (empty($student_id) || empty($student_name) || empty($student_class) || empty($subjects) || empty($academicYear) || empty($term)) {
            echo json_encode(['error' => 'All fields are required']);
        } else {
            $tableName = "results_" . str_replace("/", "_", $academicYear);
            // Check if the table exists and create it if not
            $createTableQuery = "
                CREATE TABLE IF NOT EXISTS $tableName (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    student_id VARCHAR(255) NOT NULL,
                    student_name VARCHAR(255) NOT NULL,
                    student_class VARCHAR(255) NOT NULL,
                    subjects TEXT NOT NULL,
                    academic_year VARCHAR(255) NOT NULL,
                    term VARCHAR(255) NOT NULL,
                    UNIQUE KEY unique_record (student_id, student_class, academic_year, term)
                )";
            $conn->query($createTableQuery);

            $query = "INSERT INTO $tableName(student_id, student_name, student_class, subjects, academic_year, term) VALUES (?, ?, ?, ?, ?, ?)
                        ON DUPLICATE KEY UPDATE student_name = VALUES(student_name), subjects = VALUES(subjects)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssss", $student_id, $student_name, $student_class, $subjects, $academicYear, $term);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['error' => 'An error occurred while trying to submit student data']);
            }
            $stmt->close();
            $conn->close();
        } 
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid request']);
    }