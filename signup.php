<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mini";
    $conn = mysqli_connect($servername,$username,$password,$dbname);
    if (!$conn) 
    {
         die("Connection failed: " . mysqli_connect_error());
    }
    $name=$_POST["u_name"];
    $email=$_POST["u_email"];
    $password=$_POST["u_password"];
    $role = $_POST["inlineRadioOptions"];
    $con = mysqli_connect("localhost","root","","mini");
    $stmt = $con->prepare("insert into users (u_name,u_email,u_pwd,u_role)
    values (?,?,?,?)");
    $stmt->bind_param("ssss",$name,$email,$password,$role);
    if ($stmt->execute()) {
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
?>
