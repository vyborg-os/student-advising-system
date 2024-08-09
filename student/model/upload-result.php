<?php
    require_once '../../config/config.php';
    require_once APPROOT.'/database/db.php';

    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $class = $_POST['studentClass'] ?? '';
        $academicYear = $_POST['academicYear'] ?? '';
        $term = $_POST['term'] ?? '';

        if (empty($class) || empty($academicYear) || empty($term)) {
            echo json_encode(['success' => false, 'error' => 'All fields are required']);
            exit;
        }

        if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['csvFile']['tmp_name'];
            $file = fopen($fileTmpPath, 'r');

            // Skip header row
            fgetcsv($file);

            $db = new Database();
            $conn = $db->connect();

            // Define the table name based on academic year
            $tableName = "results_" . str_replace("/", "_", $academicYear);

            // Check if the table exists and create it if not
            $createTableQuery = "
                CREATE TABLE IF NOT EXISTS $tableName (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    student_id INT NOT NULL,
                    student_class VARCHAR(255) NOT NULL,
                    subject VARCHAR(255) NOT NULL,
                    score VARCHAR(255) NOT NULL,
                    academic_year VARCHAR(255) NOT NULL,
                    term VARCHAR(255) NOT NULL,
                    UNIQUE KEY unique_record (student_id, subject, academic_year, term)
                )";
            $conn->query($createTableQuery);

            // Insert or update records
            while (($data = fgetcsv($file, 1000, ',')) !== FALSE) {
                $studentId = $data[0];
                $subject = $data[2];
                $score = $data[3];

                $query = "INSERT INTO $tableName (student_id, student_class, subject, score, academic_year, term) VALUES (?, ?, ?, ?, ?, ?)
                        ON DUPLICATE KEY UPDATE score = VALUES(score)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("isssss", $studentId, $class, $subject, $score, $academicYear, $term);
                $stmt->execute();
            }

            fclose($file);
            $stmt->close();
            $conn->close();

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error uploading file']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    }
