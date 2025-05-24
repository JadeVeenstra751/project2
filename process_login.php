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

    if (!$user) {
        //failed login
        echo "Incorrect credentials. Please <a href='./login.php'>login</a>.";
    } else {
        //else if login successful, go to enhancements.php
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: ./enhancements.php");
        exit();
    }
    
    //closes statement
       $stmt->close();
    } else {
        //prepare error
        die("Prepare failed: " . $conn2->error);
    }
}
?>