<?php
require_once '../../config/config.php';
require_once APPROOT.'/database/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $class = $data['class'] ?? '';
    $subjects = $data['subjects'] ?? [];

    if (empty($class) || empty($subjects)) {
        echo json_encode(['success' => false, 'error' => 'Class and subjects are required']);
        exit;
    }

    $db = new Database();
    $conn = $db->connect();

    $existingSubjects = [];
    $newSubjects = [];

    // Check existing subjects for the class
    $selectQuery = "SELECT subject FROM class_subjects WHERE class = ?";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("s", $class);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $existingSubjects[] = $row['subject'];
    }

    $stmt->close();

    // Insert new subjects
    $insertQuery = "INSERT INTO class_subjects (class, subject) VALUES (?, ?)";
    $stmt = $conn->prepare($insertQuery);

    foreach ($subjects as $subject) {
        if (in_array($subject, $existingSubjects)) {
            continue;
        }
        $stmt->bind_param("ss", $class, $subject);
        if ($stmt->execute()) {
            $newSubjects[] = $subject;
        } else {
            echo json_encode(['success' => false, 'error' => 'Error adding subject: ' . $subject]);
            $stmt->close();
            $conn->close();
            exit;
        }
    }

    $stmt->close();
    $conn->close();

    $message = [
        'success' => true,
        'existingSubjects' => $existingSubjects,
        'newSubjects' => $newSubjects
    ];

    echo json_encode($message);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
