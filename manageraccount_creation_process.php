<!--by jade veenstra!-->
<?php
require_once("settings.php");

$conn2 = mysqli_connect($host, $user, $pwd, $sql_db2);

// check connection
if (!$conn2) {
    // if connection failed, stop execution and output error message
    die("Connection failed: " . mysqli_connect_error());
}

// get and sanitise form data through post
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$role = isset($_POST['role']) ? $_POST['role'] : 'user';

//(CHAT.GPT assistance)
// Server-side password rule: min 8 chars, at least one letter and one number
if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,}$/', $password)) {
    die("Password must be at least 8 characters long and include at least one letter, one number, and one special character.");
}

// checks if username already exists
$check_query = "SELECT * FROM user WHERE username = ?";
$check_stmt = mysqli_prepare($conn2, $check_query);
//binds user param to prepared statement to prevent sql injections
mysqli_stmt_bind_param($check_stmt, "s", $username);
//executes statement
mysqli_stmt_execute($check_stmt);
//stores result
mysqli_stmt_store_result($check_stmt);

//if the username already exists then display message and stop
if (mysqli_stmt_num_rows($check_stmt) > 0) {
    echo "Username already taken. Please choose another.";
    exit;
}
//(CHAT.GPT assistance ends here)

//closes statement 
mysqli_stmt_close($check_stmt);

// hashes the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// prepares sql statement to insert new user details   
$query = "INSERT INTO user (username, password, role) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn2, $query);
//binds param to sql query 
mysqli_stmt_bind_param($stmt, "sss", $username, $hashed_password, $role);

//if successful the execute
if (mysqli_stmt_execute($stmt)) {
    //display message and let the return to manager page
    echo "Signup successful! You can now  You can now return to the <a href='./enhancements.php'>Manager page</a>.";
} else {
    //display message if unsuccessful
    echo "Signup failed. Try again.";
}

// closes connections
mysqli_stmt_close($stmt);
mysqli_close($conn2);
?>