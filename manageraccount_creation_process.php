<?php
require_once("settings.php");

$conn2 = mysqli_connect($host, $user, $pwd, $sql_db2);
if (!$conn2) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = trim($_POST['username']);
$password = trim($_POST['password']);
$role = trim($_POST['role']);

echo "Received role: $role<br>";

if ($role !== 'user' && $role !== 'manager') {
    die("Invalid role selected.");
}

// Password validation
if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,}$/', $password)) {
    die("Password must be at least 8 characters long and include at least one letter, one number, and one special character.");
}

// Check if username exists
$check_query = "SELECT * FROM user WHERE username = ?";
$check_stmt = mysqli_prepare($conn2, $check_query);
mysqli_stmt_bind_param($check_stmt, "s", $username);
mysqli_stmt_execute($check_stmt);
mysqli_stmt_store_result($check_stmt);

if (mysqli_stmt_num_rows($check_stmt) > 0) {
    echo "Username already taken.";
    exit;
}
mysqli_stmt_close($check_stmt);

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$insert_query = "INSERT INTO user (username, password, role) VALUES (?, ?, ?)";
$insert_stmt = mysqli_prepare($conn2, $insert_query);
mysqli_stmt_bind_param($insert_stmt, "sss", $username, $hashed_password, $role);

//if successful the execute
if (mysqli_stmt_execute(($insert_stmt))) {
    //display message and let the return to manager page
    echo "Signup successful! You can now  You can now return to the <a href='./enhancements.php'>Manager page</a>.";
} else {
    //display message if unsuccessful
    echo "Signup failed. Try again.";
}

// closes connections
mysqli_stmt_close(($insert_stmt));
mysqli_close($conn2);
?>