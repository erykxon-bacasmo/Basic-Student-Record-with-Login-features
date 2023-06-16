<?php

require "connection.php";
$conn = connection();

$id = $_GET['id'];
$sql = "SELECT * FROM student_record_db WHERE stud_id = '$id'";
$result = $conn->query($sql);
$rows = $result->fetch_assoc();

if(isset($_POST['edit'])){
    $name = $_POST['fname'];
    $age = $_POST['old'];
    $gender = $_POST['sex'];
    $year = $_POST['year'];

    $sql = "UPDATE student_record_db SET `full_name` = '$name', `age` = '$age', `gender` = '$gender', `year_level` = '$year' WHERE stud_id = '$id'";
    $conn->query($sql);

    header("location: profile.php?id=" .$id);
} elseif(isset($_POST['cancel'])){
    header("location: profile.php?id=" .$id);
}

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
    <title>Edit Record</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<div id="edit-modal" class="edit-modal">
        <div class="modal-content">
            <h2>Edit Record</h2><br><br>
            <form action="" method="post">
                <Label>Full Name:</Label>
                <input type="text" name="fname" value="<?php echo $rows['full_name']?>" required><br><br>
                <Label>Age:</Label>
                <input type="integers" name="old" value="<?php echo $rows['age']?>" required><br><br>
                <Label>Gender:</Label>
                <select name="sex" value="<?php echo $rows['gender']?>" required>
                    <option value="Male" <?php echo($rows['gender'] == "Male")? 'selected': '';?>>Male</option>
                    <option value="Female" <?php echo($rows['gender'] == "Female")? 'selected': '';?>>Female</option>
                </select><br><br>
                <Label>Year Level:</Label>
                <select name="year" value="<?php echo $rows['year_level']?>" required>
                    <option value="1st Yr" <?php echo($rows['year_level'] == "1st Yr")? 'selected': '';?>>1st Yr</option>
                    <option value="2nd Yr" <?php echo($rows['year_level'] == "2nd Yr")? 'selected': '';?>>2nd Yr</option>
                    <option value="3rd Yr" <?php echo($rows['year_level'] == "3rd Yr")? 'selected': '';?>>3rd Yr</option>
                    <option value="4th Yr" <?php echo($rows['year_level'] == "4th Yr")? 'selected': '';?>>4th Yr</option>
                </select><br><br>
                <button type="submit" name="edit">Edit</button>
                <button type="submit" name="cancel">Cancel</button>
            </form>
        </div>
    </div>
</body>
</html>