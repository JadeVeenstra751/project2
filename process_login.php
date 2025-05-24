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
    die("Connection failed: " . mysqli_connect_error());
}

//if post
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    //stores username and password input in login form
    $input_username = trim($_POST['username']);
    $input_password = trim($_POST['password']);
    
    // prepares statement without checking password
    $stmt = $conn2->prepare("SELECT * FROM user WHERE username = ?");
    if ($stmt) {
        $stmt->bind_param("s", $input_username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        //assistance from CHAT.GPT and week 11 modules
        if (!$user) {
            // if login fails
            echo "Incorrect credentials. Please <a href='./login.php'>login</a>.";
        } else {
            // else if correct, check password
            if (strpos($user['password'], '$2y$') === 0) {
                // if password is hashed, verify with password_verify
                $valid = password_verify($input_password, $user['password']);
            } else {
                // otherwise password stored in plain text
                $valid = ($input_password === $user['password']);
                
                // if valid, rehash password and update db
                if ($valid) {
                    $newHash = password_hash($input_password, PASSWORD_DEFAULT);
                    $updateStmt = $conn2->prepare("UPDATE user SET password = ? WHERE username = ?");
                    $updateStmt->bind_param("ss", $newHash, $input_username);
                    $updateStmt->execute();
                    $updateStmt->close();
                }
            }
            //CHAT.GPT assistance ends here

            if ($valid) {
                // prevents session fixation attacks by regenerating session id
                session_regenerate_id(true);

                // setting session variables
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // redirects to enhancements.php
                header("Location: ./enhancements.php");
                exit();
            } else {
                // fail if password is incorrected
                echo "Incorrect credentials. Please <a href='./login.php'>login</a>.";
            }
        }
        //close statement
        $stmt->close();
    } else {
        //otherwise fail and show error
        die("Prepare failed: " . $conn2->error);
    }
}
?>