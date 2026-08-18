<?php

$hostName = "localhost";
$db_name = "student_management";
$userName = "root";
$password = "coderby@";

$connection = mysqli_connect($hostName, $userName, $password, $db_name);

if (!$connection) {
    die("❌ Database Connection Failed: " . mysqli_connect_error());

}

// echo "✅ Database Connected Successfully";


?>