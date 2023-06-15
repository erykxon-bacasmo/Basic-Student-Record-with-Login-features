<?php

require "connection.php";
$conn = connection();

if(isset($_POST['delete'])){
    $id = $_POST['data_id'];

    $sql = "DELETE FROM student_record_db WHERE stud_id = '$id'";
    $conn->query($sql);

    header("location: index.php");
}


?>