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
    <h1>Student Record Database</h1><br><br>


    <?php
    
    if(isset($_POST['add'])){
        $name = $_POST['fname'];
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $sql = "INSERT INTO user(`full_name`, `username`, `pass`) VALUES('$name', '$user', '$pass')";
        $conn->query($sql);

        echo "<script>alert('Add User Successfully!')</script>";
        echo "<script>window.location = 'login.php'</script>";
    }
    
    ?>
    <!-- pop up modal -->
    <div id="add-modal" class="add-modal">
        <div class="modal-content">
            <h2>Create Account</h2><br><br>
            <form action="" method="post">
                <Label>Full Name:</Label>
                <input type="text" name="fname" id="full_name" required><br><br>
                <Label>Username</Label>
                <input type="text" name="user" required><br><br>
                <Label>Password</Label>
                <input type="password" name="pass" required><br><br>
                <button type="submit" name="add">Register</button>
                <button id="cancel-add">Cancel</button>
            </form>
        </div>
    </div>
    <div class="form-login">    
        <h2>Login Form</h2>
        <form action="" method="post">
            <Label>Username</Label>
            <input type="text" name="user" placeholder="Enter your username" required><br><br>
            <Label>Password</Label>
            <input type="password" name="pass" placeholder="Enter your password" required><br><br>
            <button type="submit" name="login">Login</button>
        </form>
    </div><br><br>
    <div class="menu-login">
        <a href="index.php" type="button">Quick View?</a>&nbsp;
        <button id="add-btn">Create User</button><br><br>
    </div>
    <script src="main.js"></script>
</body>
</html>