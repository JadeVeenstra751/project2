<?php
//starts new session
session_start();
//includes db settings
require_once("settings.php");
//connects to 2nd db
$conn2 = mysqli_connect($host, $user, $pwd, $sql_db2);

//if conn2 unsuccessful
if (!$conn2){
    die("Connection failed: " . mysqli_connect_error());
}

//if post
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    //stores username and password input in login form
    $input_username = trim($_POST['username']);
    $input_password = trim($_POST['password']);
    
    // Prepare statement WITHOUT checking password here (we fetch hashed password first)
    $stmt = $conn2->prepare("SELECT * FROM user WHERE username = ?");
    if ($stmt) {
        $stmt->bind_param("s", $input_username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (!$user) {
            // No such user found
            echo "Incorrect credentials. Please <a href='./login.php'>login</a>.";
        } else {
            // Check if stored password is hashed
            if (strpos($user['password'], '$2y$') === 0) {
                // Password is hashed: verify with password_verify
                $valid = password_verify($input_password, $user['password']);
            } else {
                // Password stored in plain text (not recommended)
                $valid = ($input_password === $user['password']);
                
                // If valid, rehash password and update DB
                if ($valid) {
                    $newHash = password_hash($input_password, PASSWORD_DEFAULT);
                    $updateStmt = $conn2->prepare("UPDATE user SET password = ? WHERE username = ?");
                    $updateStmt->bind_param("ss", $newHash, $input_username);
                    $updateStmt->execute();
                    $updateStmt->close();
                }
            }

            if ($valid) {
                // Prevent session fixation attacks by regenerating session ID after login
                session_regenerate_id(true);

                // Set session variables
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Redirect to enhancements.php
                header("Location: ./enhancements.php");
                exit();
            } else {
                // Password incorrect
                echo "Incorrect credentials. Please <a href='./login.php'>login</a>.";
            }
        }
        $stmt->close();
    } else {
        die("Prepare failed: " . $conn2->error);
    }
}
?>