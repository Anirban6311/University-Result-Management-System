<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="Answer_sheetDisplay.css">
    <style>
    </style>
</head>
<body>
<?php
// Assuming you have already established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_cre";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection Error");
}

$S_email = $_SESSION['S_email'];
$S_password = $_SESSION['S_password'];


// Query to fetch student's Uid from student_details table using login credentials
$loginQuery = "SELECT Uid FROM student_details WHERE Email = '$S_email' AND Password = '$S_password'";
$loginResult = mysqli_query($conn, $loginQuery);

if (!$loginResult || mysqli_num_rows($loginResult) === 0) {
    // Invalid login, display error message and stop execution
    echo "Invalid login. Please try again.";
    exit;
}

// Valid login, proceed to load the student portal
?>
<header>
    <h1>Student Portal</h1>
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            
        </ul>
    </nav>
</header>
<section>
    <h2>Semester Details</h2>
    <table>
        <tr>
            <th>Sno.</th>
            <th>Course</th>
            <th>Credits</th>
            <th>Answer Script</th>
        </tr>
        <?php
        $row = mysqli_fetch_assoc($loginResult);
        $uid = $row['Uid'];
        $marksQuery = "SELECT course, marks FROM student_marks WHERE Uid = '$uid'";
        $marksResult = mysqli_query($conn, $marksQuery);
        while ($res = mysqli_fetch_assoc($marksResult)) {
            ?>
            <tr>
                <td><?php echo $res['course'] ?></td>
                <td>4</td>
                <td><?php echo $res['marks'] ?></td>
                <td><a href="#"><button type="button" class="button">Request Rectification</button></a></td>
            </tr>
        <?php
        }
        ?>
        </table>
    </section>
    <footer>
        <p>&copy; 2023 Chandigarh University Student Portal</p>
    </footer>
</body>
</html>
