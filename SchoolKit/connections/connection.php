<?php
function connection()
{
    // Host variables
    $host = "localhost";
    $username = "root";
    $password = "root1234";
    $database = "student_system";

    // Database Connection
    $con = new mysqli($host, $username, $password, $database);

    // Check database connection if OK
    if ($con->connect_error) {
        echo $con->connect_error;
    } else {
        return $con;
    }
}
function SQLSelect($sql_query, $db_connection)
{
    // Same statement as 'Try Catch'.
    // Try if query is ok if not catch error.
    $sqlCommand = $db_connection->query($sql_query) or die($db_connection->error);
    return $sqlCommand;
}
function SQL_DO($sql_query, $db_connection)
{
    $db_connection->query($sql_query) or die($db_connection->error);
}
