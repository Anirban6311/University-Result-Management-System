<?php
    $A_email=$_POST['A_email'];
    $A_password=$_POST['A_password'];
    $con= new mysqli("localhost","root","","admin_cre");
    if($con->connect_error)
    {
        die("Failed to connect :" .$con->connect_error);
    }
    else{
        $stmt=$con->prepare("select * from admin_cre where Email = ?");
        $stmt->bind_param("s",$A_email);
        $stmt->execute();
        $stmt_result=$stmt->get_result();
        if($stmt_result->num_rows>0)
        {
             $data=$stmt_result->fetch_assoc();
             if($data['Password']==$A_password && $data['Email']==$A_email)
             {
                    header('location: admin.html');
             }
             else{
                echo "Invalid login";
             }
        }
        else{
            echo "invalid";
        }
    }
?>