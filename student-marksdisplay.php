<?php
// Assuming you have already established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_cre";

// Create a new PDO instance
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  

// Retrieve the login credentials (e.g., from a form or session)
$email = $_POST['S_email'];  // Assuming you are using POST method
$password = $_POST['password'];

// Prepare and execute the query to fetch the UID
$stmt = $conn->prepare("SELECT uid FROM student_details WHERE Email = :email AND Password = :password");
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);
$stmt->execute();

// Check if the login credentials are valid
if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $uid = $row['uid'];

    // Prepare and execute the query to fetch all rows from student_marks table
    $stmt_marks = $conn->prepare("SELECT * FROM student_marks WHERE Uid = :Uid");
    $stmt_marks->bindParam(':Uid', $Uid);
    $stmt_marks->execute();

    // Fetch all rows from the result set
    $result = $stmt_marks->fetchAll(PDO::FETCH_ASSOC);

    // Display the rows
    if ($stmt_marks->rowCount() > 0) {
        foreach ($result as $row) {
            // Access the columns by their names
            echo "UID: " . $row['uid'] . "<br>";
            echo "Marks: " . $row['marks'] . "<br>";
            echo "<br>";
        }
    } else {
        echo "No rows found.";
    }
} else {
    echo "Invalid email or password.";
}

// Close the database connection
$conn = null;
?>