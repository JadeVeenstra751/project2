<?php
require_once("settings.php");

$conn2 = mysqli_connect($host, $user, $pwd, $sql_db2);

// check connection
if (!$conn2) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get and sanitize form data
$username = trim($_POST['username']);
$password = trim($_POST['password']);

// (CHAT.GPT assistance) checks if username already exists
$check_query = "SELECT * FROM user WHERE username = ?";
$check_stmt = mysqli_prepare($conn2, $check_query);
mysqli_stmt_bind_param($check_stmt, "s", $username);
mysqli_stmt_execute($check_stmt);
mysqli_stmt_store_result($check_stmt);

if (mysqli_stmt_num_rows($check_stmt) > 0) {
    echo "Username already taken. Please choose another.";
    exit;
}
mysqli_stmt_close($check_stmt);

// hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// prepared statement to prevent SQL injection
$query = "INSERT INTO user (username, password) VALUES (?, ?)";
$stmt = mysqli_prepare($conn2, $query);
mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);

// execute the query
if (mysqli_stmt_execute($stmt)) {
    //if successful redirect to login page
    echo "Signup successful! You can now <a href='./login.php'>login</a>.";
} else {
    //else prompt the user to try again.
    echo "Signup failed. Try again.";
}

// closes connections
mysqli_stmt_close($stmt);
mysqli_close($conn2);
?>