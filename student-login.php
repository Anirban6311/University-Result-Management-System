<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="student.css">
    <style>
        .button {
            background: #00fc86;
            background-image: -webkit-linear-gradient(top, #00fc86, #38ad96);
            background-image: -moz-linear-gradient(top, #00fc86, #38ad96);
            background-image: -ms-linear-gradient(top, #00fc86, #38ad96);
            background-image: -o-linear-gradient(top, #00fc86, #38ad96);
            background-image: linear-gradient(to bottom, #00fc86, #38ad96);
            -webkit-border-radius: 28;
            -moz-border-radius: 28;
            border-radius: 28px;
            font-family: Arial;
            color: #ffffff;
            font-size: 16px;
            padding: 10px 20px 10px 20px;
            text-decoration: none;
        }

        .button:hover {
            background: #11edd3;
            text-decoration: none;
        }
    </style>
</head>
<body>
<?php
// Assuming you have already established a database connection
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_cre";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection Error");
}

$S_email = $_POST['S_email'];
$S_password = $_POST['S_password'];

// Query to fetch student's Uid from student_details table using login credentials
$loginQuery = "SELECT Uid FROM student_details WHERE Email = '$S_email' AND Password = '$S_password'";
$loginResult = mysqli_query($conn, $loginQuery);

if (!$loginResult || mysqli_num_rows($loginResult) === 0) {
    // Invalid login, display error message and stop execution
    echo "Invalid login. Please try again.";
    exit;
}

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
            <th>Subject Name</th>
            <th>Credits</th>
            <th>Marks Obtained</th>
            <th>View Sheets</th>
            <th>Error Request</th>
        </tr>
        <?php
        $row = mysqli_fetch_assoc($loginResult);
        $uid = $row['Uid'];
        $_SESSION['uid'] = $uid;
        $_SESSION['email'] = $S_email;
        $_SESSION['password'] = $S_password;
        $marksQuery = "SELECT course, marks FROM student_marks WHERE Uid = '$uid'";
        $marksResult = mysqli_query($conn, $marksQuery);
        while ($res = mysqli_fetch_assoc($marksResult)) {
            ?>
            <tr>
                <td><?php echo $res['course'] ?></td>
                <td>4</td>
                <td><?php echo $res['marks'] ?></td>
                <td><a href="view_sheet.php?course=<?php echo $res['course'] ?>" target="_blank"><button type="button" class="button">View Image</button></a></td>
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
