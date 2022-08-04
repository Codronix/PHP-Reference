<?php
include_once("connections/connection.php");
$con = connection();
$student_id = $_GET['ID'];
SQL_DO("DELETE FROM mock_data WHERE id = '$student_id'", $con);
echo header("Location: index.php");
