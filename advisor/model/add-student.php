<?php 
require_once '../../config/config.php';
require_once APPROOT . '/database/db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $db = new Database();
    $conn = $db->connect();

    if (isset($_POST['uploadCSV'])) {
        $class = $_POST['studentClass'];
        $year = $_POST['studentYear'];
        $csvFile = $_FILES['csvFile']['tmp_name'];

        if (($handle = fopen($csvFile, 'r')) !== FALSE) {
            fgetcsv($handle); // Skip the first line (headers)

            // Get the last student ID for the class
            $stmt = $conn->prepare("SELECT MAX(student_id) AS max_id FROM student WHERE student_class = ? AND student_year = ?");
            $stmt->bind_param("ss", $class, $year);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $maxId = $row['max_id'];

            // Generate a new 9-digit ID if max_id is null or empty
            if (empty($maxId)) {
                $maxId = generateNewStudentId();
            }

            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $name = $data[0];
                $dob = $data[1];

                // Check if student already exists by name and class
                $query = "SELECT * FROM student WHERE student_name = ? AND student_class = ? AND student_year = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("sss", $name, $class, $year);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Update existing student record using student_id
                    $student = $result->fetch_assoc();
                    $studentId = $student['student_id'];
                    $updateQuery = "UPDATE student SET student_dob = ?, student_name = ? WHERE student_id = ?";
                    $updateStmt = $conn->prepare($updateQuery);
                    $updateStmt->bind_param("ssi", $dob, $name, $studentId);
                    $updateStmt->execute();
                } else {
                    // Generate new student ID
                    $newStudentId = ++$maxId;

                    // Insert new student record
                    $insertQuery = "INSERT INTO student (student_id, student_name, student_year, student_class, student_dob) VALUES (?, ?, ?, ?, ?)";
                    $insertStmt = $conn->prepare($insertQuery);
                    $insertStmt->bind_param("issss", $newStudentId, $name, $year, $class, $dob);
                    $insertStmt->execute();
                }
            }
            fclose($handle);
            echo "CSV file uploaded and processed successfully.";
        } else {
            echo "Error opening the CSV file.";
        }
    } elseif (isset($_POST['addStudent'])) {
        $name = $_POST['studentName'];
        $class = $_POST['studentClass'];
        $dob = $_POST['studentDOB'];
        $year = $_POST['studentYear'];

        // Get the last student ID for the class
        $stmt = $conn->prepare("SELECT MAX(student_id) AS max_id FROM student WHERE student_class = ? AND student_year = ?");
        $stmt->bind_param("ss", $class, $year);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $maxId = $row['max_id'];

        // Generate a new 9-digit ID if max_id is null or empty
        if (empty($maxId)) {
            $maxId = generateNewStudentId();
        }

        // Generate new student ID
        $newStudentId = ++$maxId;

        // Insert new student record
        $insertQuery = "INSERT INTO student (student_id, student_name, student_year, student_class, student_dob) VALUES (?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("issss", $newStudentId, $name, $year, $class, $dob);
        $insertStmt->execute();

        echo "Student added successfully.";
    }
}

$conn->close();

function generateNewStudentId() {
    // Generate a new 9-digit ID based on current timestamp
    $prefix = date('ymd'); // Use date prefix (YYMMDD)
    $suffix = sprintf("%04d", 1); // Start from 0001
    return intval($prefix . $suffix); // Concatenate and return as integer
}