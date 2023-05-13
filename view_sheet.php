<?php
session_start();
// Assuming you have already established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_cre";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection Error");
}

$course = $_GET['course'];
$uid = $_SESSION['uid']; 


$imageQuery = "SELECT File FROM ans_sheet WHERE course = '$course' AND Uid = '$uid'";
$imageResult = mysqli_query($conn, $imageQuery);

if (!$imageResult || mysqli_num_rows($imageResult) === 0) {
    // Image not found, display error message or redirect to an error page
    echo "Image not found.";
    exit;
}

$row = mysqli_fetch_assoc($imageResult);
$imageData = $row['File'];

// Display the image
header("Content-type: image/png");
echo $imageData;
?>
