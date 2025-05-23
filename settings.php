<?php
$host = "localhost"; //server hostname
$user = "root";// username for SQL db
$pwd = "";// password for SQL user


$sql_db1 = "job_db";// name of db
//establish connection
$conn1 = mysqli_connect($host, $user, $pwd, $sql_db1);
//if connection unsuccessful, stop execution
if (!$conn1) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql_db2 = "userprofile";// name of db
//establish connection
$conn2 = mysqli_connect($host, $user, $pwd, $sql_db2);
//if connection unsuccessful, stop execution
if (!$conn2) {
    die("Connection failed: " . mysqli_connect_error());
}
?>