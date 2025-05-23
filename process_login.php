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
    $users = mysqli_fetch_assoc($result);

if ($user) {
  $_SESSION['username'] = $user['username'];
  $_SESSION['role'] = $user['role'];
  header("Location: leafbyte_settings.php");
  exit();
} else {
  echo "Incorrect credentials. Please <a href='./login.php'>login</a>.";
}
}
?>