<?php

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['Access']) && $_SESSION['Access'] == "admin") {
    echo "Welcome " . $_SESSION['UserLogin'];
} else {
    echo header("Location: index.php");
}

include_once("connections/connection.php");
$con = connection();
$student_id = $_GET['ID'];
$sql = "SELECT * FROM mock_data WHERE id = '$student_id'";
$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <h2><?php echo $row['first_name']; ?> <?php echo $row['last_name'] ?></h2>
    <h4>Gender: <?php echo $row['gender'] ?></h4>
</body>

</html>