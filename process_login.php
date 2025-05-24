<!--by jade veenstra!-->
<?php
//starts new session
session_start();
//includes db settings
require_once("settings.php");
//connects to 2nd db
$conn2 = mysqli_connect($host, $user, $pwd, $sql_db2);

//if conn2 unsuccessful
if (!$conn2){
    //then fail and show error
    die("Connection failed: " . mysqli_connect_error());
}

//if post
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    //stores username and password input in login form
    $input_username = trim($_POST['username']);
    $input_password = trim($_POST['password']);
    
    //preparing SQLusing conn2
    $stmt = $conn2->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
    if ($stmt) {
    $stmt->bind_param("ss", $input_username, $input_password);
    $stmt->execute();
    //gets result and gets user data
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    }
}

    if ($user) {
    // Check password hashing etc (your existing code here)
    if (strpos($user['password'], '$2y$') === 0) {
        $valid = password_verify($input_password, $user['password']);
    } else {
        $valid = ($input_password === $user['password']);
        if ($valid) {
            $newHash = password_hash($input_password, PASSWORD_DEFAULT);
            $updateStmt = $conn2->prepare("UPDATE user SET password = ? WHERE username = ?");
            $updateStmt->bind_param("ss", $newHash, $input_username);
            $updateStmt->execute();
            $updateStmt->close();
        }
    }

    if ($valid) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: ./enhancements.php");
        exit();
    } else {
        echo "Incorrect credentials. Please <a href='./login.php'>login</a>.";
        exit();
    }

} else {
    // user not found
    echo "Incorrect credentials. Please <a href='./login.php'>login</a>.";
       exit();
}