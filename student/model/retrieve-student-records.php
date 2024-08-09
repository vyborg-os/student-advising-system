<?php
    require_once '../../config/config.php';
    require_once APPROOT . '/database/db.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');

    $db = new Database();
    $conn = $db->connect();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $academicYear = $_POST['academicYear'];
        $term = $_POST['term'];
        $studentClass = $_POST['studentClass'];

        if (empty($academicYear) || empty($term) || empty($studentClass)) {
            echo json_encode(['error' => 'All fields are required']);
        } else {
            $tableName = "results_" . str_replace("/", "_", $academicYear);
            $query = "SELECT student_id, student_name, student_class, academic_year, term FROM $tableName WHERE student_class = ? AND academic_year = ? AND term = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sss", $studentClass, $academicYear, $term);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $students = [];
                while ($row = $result->fetch_assoc()) {
                    $students[] = $row;
                }
                echo json_encode(['success' => true, 'data' => $students]);
            } else {
                echo json_encode(['success' => false, 'error' => 'No records found']);
            }
            $stmt->close();
        }
        $conn->close();
    } else {
        echo json_encode(['error' => 'Invalid request method']);
    }