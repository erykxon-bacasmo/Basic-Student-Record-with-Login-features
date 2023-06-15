<?php

require "connection.php";
$conn = connection();

session_start();
session_unset();
session_destroy();

header("location: login.php");

?>