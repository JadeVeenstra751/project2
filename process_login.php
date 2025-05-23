<?php
session_start();
require_once("settings.php");
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $input_username = trim($_POST['username']);
    $input_password = trim($_POST['password']);
    
    $query = "SELECT * FROM user WHERE username = '$input_username' AND password = '$input_password'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

if ($user) {
  $_SESSION['username'] = $user['username'];
  header("Location: profile.php");
  exit();
} else {
  echo "Incorrect credentials. Please <a href='login.php'>login</a>.";
}
}
?>