<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_cre";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully. ";
}


// File upload handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Uid = $_POST['Uid'];
    $course = $_POST['course'];
    $file = $_FILES['photo']['tmp_name'];
    $fileSize = $_FILES['photo']['size'];
    $fileType = $_FILES['photo']['type'];

    // Validate file size and type
    if ($fileSize > 1048576) { // 1MB limit
        echo "File size exceeded the limit.";
        exit;
    }

    if ($fileType !== 'image/png') {
        echo "Only PNG files are allowed.";
        exit;
    }
    
    // Read the file content
    $content = file_get_contents($file);

    // Prepare and execute the database query
    $stmt = $conn->prepare("INSERT INTO Ans_sheet (Uid, course, File) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $Uid, $course, $content);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Answer Sheet uploaded and saved to the database successfully. ";
        
        // Move uploaded file to a directory
        $targetDir = "uploads/"; // Specify your target directory
        $fileName = basename($_FILES['photo']['name']);
        $targetPath = $targetDir . $fileName;
        
        if (move_uploaded_file($file, $targetPath)) {
            echo "File moved successfully.";
        } else {
            echo "Failed to move file.";
        }
    } else {
        echo "Failed to save file to the database.";
    }

    $stmt->close();
}

$conn->close();
?>
