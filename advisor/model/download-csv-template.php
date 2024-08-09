<?php
    require_once '../../config/config.php';
    require_once APPROOT . '/database/db.php';

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="students_template.csv"');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        $class = $data['class'] ?? '';
        $year = $data['year'] ?? '';

        if (empty($class) || empty($year)) {
            echo 'Class/Academic year is required';
            exit;
        }

        // Database connection
        $db = new Database();
        $conn = $db->connect();

        // Fetch subjects for the class
        $subjectsQuery = "SELECT subject FROM class_subjects WHERE class = ?";
        $stmt = $conn->prepare($subjectsQuery);
        $stmt->bind_param("s", $class);
        $stmt->execute();
        $subjectsResult = $stmt->get_result();

        $subjects = [];
        while ($row = $subjectsResult->fetch_assoc()) {
            $subjects[] = $row['subject'];
        }
        $stmt->close();

        // Fetch students for the class and year
        $studentsQuery = "SELECT student_id, student_name FROM student WHERE student_class = ? AND student_year = ?";
        $stmt = $conn->prepare($studentsQuery);
        $stmt->bind_param("ss", $class, $year);
        $stmt->execute();
        $studentsResult = $stmt->get_result();

        if ($studentsResult->num_rows > 0) {
            $output = fopen('php://output', 'w');

            // Prepare CSV headers
            $headers = ['Student ID', 'Student Name'];
            foreach ($subjects as $subject) {
                $headers[] = "$subject CA";
                $headers[] = "$subject Exam";
            }
            fputcsv($output, $headers);

            // Prepare CSV rows
            while ($row = $studentsResult->fetch_assoc()) {
                $csvRow = [$row['student_id'], $row['student_name']];
                foreach ($subjects as $subject) {
                    $csvRow[] = ''; // CA score placeholder
                    $csvRow[] = ''; // Exam score placeholder
                }
                fputcsv($output, $csvRow);
            }

            fclose($output);
        } else {
            echo 'No students found';
        }

        $stmt->close();
        $conn->close();
    } else {
        echo 'Invalid request method';
    }