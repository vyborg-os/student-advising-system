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
        $student_id = $_POST['student_id'];
        $academicYear = $_POST['academicYear'];
        $term = $_POST['term'];
    
        if (empty($student_id) || empty($academicYear) || empty($term)) {
            echo json_encode(['error' => 'All fields are required']);
        } else {
            $tableName = "results_" . str_replace("/", "_", $academicYear);
            $query = "SELECT student_id, student_name, student_class, subjects, academic_year, term FROM $tableName WHERE student_id = ? AND academic_year = ? AND term = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sss", $student_id, $academicYear, $term);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                $student = $result->fetch_assoc();
                // // Process the subjects field
                // $subjects_encoded = $student['subjects'];
                // $split_string = explode('bot', $subjects_encoded);
                // if (count($split_string) > 1) {
                //     $base64_part = $split_string[0];
                //     $decoded_array = json_decode(base64_decode($base64_part), true);
                //     // if (isset($decoded_array['subjects'])) {
                //     //     $decoded_subjects = json_decode(base64_decode($decoded_array['subjects']), true);
                //     //     $decoded_array['subjects'] = $decoded_subjects;
                //     // }
                //     // $student['subjects'] = $decoded_array;
                // } else {
                //     $student['subjects'] = 'Invalid subjects data';
                // }
                echo json_encode(['success' => true, 'data' => $student]);
            } else {
                echo json_encode(['success' => false, 'error' => 'No result found for this student']);
            }
            $stmt->close();
        }
        $conn->close();
    } else {
        echo json_encode(['error' => 'Invalid request method']);
    }