<?php
$host = "localhost"; //server hostname
$user = "root";// username for SQL db
$pwd = "";// password for SQL user

// databases
//$sql_db1 = "job_db";
$sql_db2 = "userprofile";

// connect to job_db db
//establish connection
//$conn1 = mysqli_connect($host, $user, $pwd, $sql_db1);
//if (!$conn1) {
    //if connection unsuccessful, stop execution
    //die("Connection to job_db failed: " . mysqli_connect_error());
//}

// connect to userprofile db
//establish connection
$conn2 = mysqli_connect($host, $user, $pwd, $sql_db2);
if (!$conn2) {
    //if connection unsuccessful, stop execution
    die("Connection to userprofile failed: " . mysqli_connect_error());
}
?>