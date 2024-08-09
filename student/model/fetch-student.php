<?php
    // require_once '../../config/config.php';
    // require_once APPROOT . '/database/db.php';

    // // Check if class is provided
    // if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //     // Database connection
    //     $db = new Database();
    //     $conn = $db->connect();
        
    //     $msg = array();
    //     $students = array();

    //     if (isset($_POST['submit'])) {
    //         $year = $_POST['year'];
    //         $class = $_POST['class'];

    //         if (empty($class) || empty($year)) {
    //             $msg['error'] = "Cannot pass an empty value";
    //             echo json_encode($msg);
    //             exit;
    //         } else {
    //             // Prepare and execute query to fetch students by class
    //             $query = "SELECT * FROM student WHERE student_class = ? AND student_year = ?";
    //             $stmt = $conn->prepare($query);
    //             $stmt->bind_param("ss", $class, $year);
    //             $stmt->execute();
    //             $result = $stmt->get_result();

    //             if ($result->num_rows > 0) {
    //                 while ($row = $result->fetch_assoc()) {
    //                     // Adjust fields as per your database structure
    //                     $student = array(
    //                         'sid' => $row['student_id'],
    //                         'name' => $row['student_name'],
    //                         'date' => $row['date_created'],
    //                         'year' => $row['student_year'],
    //                         'class' => $row['student_class'],
    //                         'dob' => $row['student_dob']
    //                     );
    //                     $students[] = $student;
    //                 }

    //                 // Return JSON response
    //                 echo json_encode($students);
    //             } else {
    //                 $msg['error'] = "No record found!";
    //                 echo json_encode($msg);
    //             }
    //             exit;          
    //         } 
    //     } else {
    //         // Handle case where class is not provided
    //         $msg['error'] = "Invalid operation";
    //         echo json_encode($msg);
    //         exit;
    //     }
    // } else {
    //     $msg['error'] = "Invalid request method";
    //     echo json_encode($msg);
    //     exit;
    // }


require_once '../../config/config.php';
require_once APPROOT . '/database/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class = $_POST['class'] ?? '';
    $year = $_POST['year'] ?? '';

    if (empty($class) || empty($year)) {
        echo json_encode(['error' => 'Class and academic session are required']);
        exit;
    }

    $db = new Database();
    $conn = $db->connect();
    $msg = array();

    $query = "SELECT * FROM student WHERE student_class = ? AND student_year = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $class, $year);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }

        echo json_encode($students);
    }else{
        $msg['error'] = "No record found!";
        echo json_encode($msg);
    }
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Invalid request method']);
}