<?php

require "connection.php";
$conn = connection();

$id = $_GET['id'];

$sql = "SELECT * FROM student_record_db WHERE stud_id = '$id'";
$result = $conn->query($sql);
$rows = $result->fetch_assoc();

session_start();

if(!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')){
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM user WHERE user_id = '$id'";
    $conn->query($sql);
    
    header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $rows['full_name']?> Profiles</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <h1>Welcome user <?php echo $rows['full_name']?></h1><br><br>
    <a href="index.php">Back</a> &nbsp; &nbsp;
    <a href="edit.php?id= <?php echo $rows['stud_id']?>">Edit Record</a>
</body>
</html>