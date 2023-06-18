<?php

require "connection.php";
$conn = connection();

$sql = "SELECT * FROM student_record_db";
$result = $conn->query($sql);

session_start();

if(isset($_SESSION['id'])){?>
<?php echo $_SESSION['name'];?>&nbsp;

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Record</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <!-- log out button -->
    <?php
        if(isset($_SESSION['id'])){?>
            <a href="logout.php">Logout</a>
        <?php }
    ?>
    <h1>Student Record</h1><br><br>
    <button id="add-btn">Add Record</button><br><br>
    <?php
    
    if(isset($_POST['add'])){
        $name = $_POST['fname'];
        $age = $_POST['old'];
        $gender = $_POST['sex'];
        $year = $_POST['year'];

        $sql = "INSERT INTO student_record_db (`full_name`, `age`, `gender`, `year_level`) VALUES ('$name', '$age', '$gender', '$year')";
        $conn->query($sql);

        header("location: index.php");
    }
    
    ?>
    <!-- Pop Up Modal -->
    <div id="add-modal" class="add-modal">
        <div class="modal-content">
            <h2>Add Record</h2><br><br>
            <form action="" method="post">
                <Label>Full Name:</Label>
                <input type="text" name="fname" required><br><br>
                <Label>Age:</Label>
                <input type="integers" name="old" required><br><br>
                <Label>Gender:</Label>
                <select name="sex" id="gender" required>
                    <option value="" hidden></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select><br><br>
                <Label>Year Level:</Label>
                <select name="year" required>
                    <option value="" hidden></option>
                    <option value="1st Yr">1st Yr</option>
                    <option value="2nd Yr">2nd Yr</option>
                    <option value="3rd Yr">3rd Yr</option>
                    <option value="4th Yr">4th Yr</option>
                </select><br><br>
                <button type="submit" name="add">Add</button>
                <button id="cancel-add">cancel</button>
            </form>
        </div>
    </div>
    <br><br>

    <!-- data table -->
    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Year Level</th>
                <th>More Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($data = $result->num_rows > 0){
                    while($rows = $result->fetch_assoc()){?>
                    <tr>
                        <td><?php echo $rows['full_name']?></td>
                        <td><?php echo $rows['age']?></td>
                        <td><?php echo $rows['gender']?></td>
                        <td><?php echo $rows['year_level']?></td>
                        <td>
                            <form action="delete.php" method="post">
                                <a href="profile.php?id= <?php echo $rows['stud_id']?>">View</a>
                                <button type="submit" name="delete" id="delete">Delete</button>
                                <input type="hidden" name="data_id" value="<?php echo $rows['stud_id']?>">
                                <script>
                                    var del = document.getElementById("delete");

                                    del.onclick = function(){
                                        alert("Deleted Successfully!");
                                    }
                                </script>
                            </form>
                        </td>
                    </tr>
                    <?php }
                } else { ?>
                    <tr><td colspan="5">No Data Record Here!</td></tr>
                <?php }
            ?>
        </tbody>
    </table>
    <script src="main.js"></script>
</body>
</html>

<?php } else { ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Record</title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        <h1>Student Record</h1><br><br>
        <a href="login.php">Wants to login?</a><br><br>

        <!-- Data table -->
        <table>
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Year Level</th>
                    <th>More Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($data = $result->num_rows > 0){
                        while ($rows = $result->fetch_assoc()){?>
                        <tr>
                            <td><?php echo $rows['full_name']?></td>
                            <td><?php echo $rows['age']?></td>
                            <td><?php echo $rows['gender']?></td>
                            <td><?php echo $rows['year_level']?></td>
                            <td>
                                <a href="profile.php?id= <?php echo $rows['stud_id']?>">View</a>
                            </td>
                        </tr>
                        <?php }
                    } else { ?>
                        <tr><td colspan="5">No Data Record Here!</td></tr>
                    <?php }
                ?>
            </tbody>
        </table>
    </body>
    </head>    
<?php }

?>
