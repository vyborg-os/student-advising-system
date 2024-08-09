<?php
    require_once '../../config/config.php';
    require_once APPROOT . '/database/db.php';

    header('Content-Type: application/json');

    $class = $_POST['class'] ?? '';
    $year = $_POST['year'] ?? '';

    if (empty($class) || empty($year)) {
        echo json_encode(['error' => 'Class and academic session are required']);
        exit;
    }

    $db = new Database();
    $conn = $db->connect();

    $students = [];
    $subjects = [];

    // Fetch students
    $query = "SELECT student_id, student_name, student_class FROM student WHERE student_class = ? AND student_year = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $class, $year);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }

    // Fetch subjects
    $query = "SELECT subject FROM class_subjects WHERE class = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $class);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $subjects[] = $row['subject'];
    }

    $stmt->close();
    $conn->close();

    echo json_encode(['students' => $students, 'subjects' => $subjects]);