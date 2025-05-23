<?php
session_start();
require_once("settings.php");
$conn2 = mysqli_connect($host, $user, $pwd, $sql_db2);

if (!$conn2){
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $input_username = trim($_POST['username']);
    $input_password = trim($_POST['password']);
    
    $query = "SELECT * FROM user WHERE username = '$input_username' AND password = '$input_password'";
    $result = mysqli_query($conn2, $query);
     if (!$result) {
        die("Query failed: " . mysqli_error($conn2));
    }
     $user = mysqli_fetch_assoc($result);

    if (!$user) {
        echo "Incorrect credentials. Please <a href='./login.php'>login</a>.";
    } else {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: ./enhancements.php");
        exit();
    }
}
?>