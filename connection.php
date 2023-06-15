<?php

function connection(){
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "student_record";

    $conn = new mysqli($host, $user, $pass, $db);

    if($conn->connect_error){
        echo $conn->connect_error;
    } else {
        return $conn;
    }
}

?>