<?php
include_once './sql/ConnectDB.php';
include_once './sql/verify.php';

$teacher_code = $_POST['teacher_code'];

$result = verify(2, $teacher_code); // function in verify.php, check that for detail

if ($result->num_rows == 0) 
{
    // Send user to login page if no code found
    header("Location: ./login.php");
    exit();
} 
else 
{
    $row = $result->fetch_assoc();

    session_start();

    // Store user data to current session if login success
    $_SESSION["id"] = $row["id"];
    $_SESSION["code"] = $row["teacher_code"];
    $_SESSION["name"] = $row["full_name"];
    $_SESSION["type"] = 2;

    header("Location: ./teacher_screen.php");
    exit();
}
