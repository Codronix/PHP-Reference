<?php
include_once("connections/connection.php");
$con = connection();
$isExisting = false;
if (isset($_POST['add'])) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gender = $_POST['gender'];

    $SQL_Select = SQLSelect("SELECT * FROM mock_data", $con);
    $row = $SQL_Select->fetch_assoc();

    do {
        if ($fname == $row['first_name']) {
            $isExisting = True;
            break;
        }
    } while ($row = $SQL_Select->fetch_assoc());

    if ($isExisting) {
        echo '<script>alert("Student is already in the system.")</script>';
    } else {
        SQL_DO("INSERT INTO `mock_data`(`first_name`, `last_name`,`gender`) 
                   VALUES ('$fname','$lname','$gender')", $con);
        echo header("Location: index.php");
    }
}
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
    <form action="" method="post">
        <label>First Name</label>
        <input type="text" name="firstname" id="txtfirstname">

        <label>Last Name</label>
        <input type="text" name="lastname" id="txtlastname">

        <label>Gender</label>
        <select name="gender" id="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        <input type="submit" name="add" value="Submit Form">
    </form>
</body>

</html>