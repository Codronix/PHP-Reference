<?php
include_once("connections/connection.php");
$con = connection();
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['UserLogin'])) {
    echo "Welcome " . $_SESSION['UserLogin'];
} else {
    echo "Welcome Guest";
}

$SqlCommand = SQLSelect("SELECT * FROM mock_data ORDER BY id DESC", $con);
// Gets the row read from the database.
$row = $SqlCommand->fetch_assoc();

if (isset($_POST['search'])) {
    $id_search = $_POST['txtSearch'];
    if ($id_search == '') {
        $SqlCommand = SQLSelect("SELECT * FROM mock_data ORDER BY id DESC", $con);
        // Gets the row read from the database.
        $row = $SqlCommand->fetch_assoc();
    } else {
        $SqlCommand = SQLSelect("SELECT * FROM mock_data WHERE id = '$id_search'", $con);
        // Gets the row read from the database.
        $row = $SqlCommand->fetch_assoc();
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
    <link rel="stylesheet" href="css/mystyles.css">
</head>

<body>
    <form action="" method="post">
        <div class="box_container">
            <h1>Student Management System</h1>
        </div>
        <br />
        <br />
        <div class="TopNavBar">
            <?php if (isset($_SESSION['UserLogin'])) { ?>
                <a class="a_Nav" href="logout.php">LOGOUT</a>
            <?php } else { ?>
                <a class="a_Nav" href="login.php">LOGIN</a>
            <?php } ?>
            <a class="a_Nav" href="add.php">ADD STUDENT</a>
            <input class="search-input" type="submit" name="search" value="Search">
            <input class="search-input" type="text" name="txtSearch" placeholder="Search ID">
        </div>

        <!-- Table where to display the data -->
        <table>
            <!-- thead means Table Header -->
            <thead>
                <tr>
                    <th></th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <!-- tbody means the Body of the Table (Columns and Cells) -->
            <tbody>
                <!-- A php tag to specify that this is a php code -->
                <?php do { ?>
                    <tr>
                        <td>
                            <a href="details.php?ID=<?php echo $row['id']; ?>" class="a_Nav">view details</a>
                            <a href="delete.php?ID=<?php echo $row['id']; ?>" class="a_Delete">delete</a>
                        </td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['gender'] ?></td>
                    </tr>
                    <!-- A php tag to specify that this is a php code -->
                <?php } while ($row = $SqlCommand->fetch_assoc()) ?>
            </tbody>
        </table>
    </form>
</body>

</html>