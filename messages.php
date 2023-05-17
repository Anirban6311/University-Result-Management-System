<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Requests</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="messages.css">
    <style>
     
    </style>
</head>
<body>
<?php
// Assuming you have already established a database connection


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_cre";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection Error");
}


// Query to fetch student's Uid from student_details table using login credentials


?>
<header>
    <h1>Student Requests</h1>
    
</header>
<section>
    <h2>Messages</h2>
    <table>
        <tr>
            <th>Uid</th>
            <th>Course</th>
            <th>Issue</th>
        </tr>
        <?php
         $marksQuery = "SELECT Uid, course,reason FROM rectification";
         $marksResult = mysqli_query($conn, $marksQuery);
         while ($res = mysqli_fetch_assoc($marksResult)) {
             ?>
             <tr>
                 <td><?php echo $res['Uid'] ?></td>
                 <td><?php echo $res['course'] ?></td>
                 <td><?php echo $res['reason'] ?></td>
                 
             </tr>
         <?php
         }
         ?>
        </table>
    </section>
    <footer>
    <p><a href="https://www.cuchd.in/">&copy; 2023 Chandigarh University Admin Portal</a></p>
    </footer>
</body>
</html>
