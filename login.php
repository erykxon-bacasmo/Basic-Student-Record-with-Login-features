<?php

require "connection.php";
$conn = connection();

session_start();

if(isset($_POST['login'])){
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM user WHERE username = '$user' AND pass = '$pass'";
    $result = $conn->query($sql);
    $rows = $result->fetch_assoc();
    $data = $result->num_rows;

    if($data > 0){
        $_SESSION['id'] = $rows['user_id'];
        $_SESSION['name'] = $rows['full_name'];
        header("location: index.php");
    } else {?>
        <script>alert("Invalid Account!");</script>
    <?php }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <h1>LogIn</h1><br><br>
    <a href="index.php">Quick View?</a><br><br>
    <form action="" method="post">
        <Label>Username</Label>
        <input type="text" name="user" required><br><br>
        <Label>Password</Label>
        <input type="password" name="pass" required><br><br>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>